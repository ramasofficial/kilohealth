<?php

namespace App\Classes;

use App\Classes\ConsoleArgumentInfo;

// using this structure to return data from parsing functions (like a simple tuple)
class ParsedNumberTuple {
    public $success;
    public $number;

    function __construct(bool $success, $number) {
        $this->success = $success;
        $this->number = $number;
    }
}

/*
 * The main parser class that takes $argv and:
 *      1. decides whether the number of arguments is correct
 *      2. reads one of three possible options (count_by_price_range, count_by_vendor_id,
 *         count_by_keyword)
 *      3. parses the numbers (floats, integers) that are passed in along with the option
 *      4. prepares a message corresponding to the result (an error message or a success
 *         message)
 * ConsoleArgumentParser::parse returns a ConsoleArgumentInfo object containing the success
 * state, message (error or success), parsed values and option type.
 */
class ConsoleArgumentParser {
    /*
     * Main function that outputs ConsoleArgumentInfo given the command line arguments.
     */
    public function parse (array $argv): ConsoleArgumentInfo {
        $console_arg_info = new ConsoleArgumentInfo();

        if (count($argv) < 2) {
            $console_arg_info->setOption("undefined");
            $console_arg_info->setSuccess(false);
            return $console_arg_info;
        }

        $console_arg_info->setOption($this->readOption($argv[1]));
        $console_arg_info->setSuccess(true); // set temporarily

        if ($console_arg_info->getOption() === "price") {

            // if argument number does not match, or if the arguments are not floats, or if their order is incorrect
            if (count($argv) !== 4 || !($this->parsePositiveFloat($argv[2])->success && $this->parsePositiveFloat($argv[3])->success) || $this->parsePositiveFloat($argv[2])->number > $this->parsePositiveFloat($argv[3])->number) {
                $console_arg_info->setSuccess(false);
            }

            if ($console_arg_info->getSuccess()) {
                $console_arg_info->setValues([
                    "price_from" => floatval($argv[2]),
                    "price_to" => floatval($argv[3])
                ]);
                $console_arg_info->setMessage("Console arguments successfully parsed. Program will count offers by price range.\n");
            } else {
                $console_arg_info->setMessage("\nError: 'count_by_price_range' requires two positive number arguments in ascending order:\n\tphp run.php count_by_price_range <lower_price_number> <higher_price_number>\n");
            }
        }

        if ($console_arg_info->getOption() === "vendor") {

            // if argument number is incorrect, or if argument is not an integer
            if (count($argv) !== 3 || !$this->parseNonNegativeInt($argv[2])->success) {
                $console_arg_info->setSuccess(false);
            }

            if ($console_arg_info->getSuccess()) {
                $console_arg_info->setValues(["vendor_id" => $this->parseNonNegativeInt($argv[2])->number]);
                $console_arg_info->setMessage("Console arguments successfully parsed. Program will count offers by vendor ID.\n");
            } else {
                $console_arg_info->setMessage("\nError: 'count_by_vendor_id' requires one non-negative integer argument:\n\tphp run.php count_by_vendor_id <non_negative_integer>\n");
            }
        }

        if ($console_arg_info->getOption() === "keyword") {

            // if argument number is incorrect
            if (count($argv) !== 3) {
                $console_arg_info->setSuccess(false);
            }

            if ($console_arg_info->getSuccess()) {
                $console_arg_info->setValues(["keyword" => $argv[2]]);
                $console_arg_info->setMessage("Console arguments successfully parsed. Program will count offers with the given keyword in the title.\n");
            } else {
                $console_arg_info->setMessage("\nError: 'count_by_keyword' requires one string argument:\n\tphp run.php count_by_keyword <keyword_string>\n");
            }
        }

        if ($console_arg_info->getOption() === "unsupported") {
            $console_arg_info->setSuccess(false);
            $console_arg_info->setMessage("\nError: the script requires one of the following command line arguments:\n\tphp run.php count_by_price_range <lower_price_number> <higher_price_number>\n\tphp run.php count_by_vendor_id <positive_integer>\n\tphp run.php count_by_keyword <keyword_string>\n");
        }

        return $console_arg_info;
    }

    /*
     *  Used to simplify the option names.
     */
    private function readOption (string $arg): string {
        switch ($arg) {
            case "count_by_price_range":
                return "price";
                break;
            case "count_by_vendor_id":
                return "vendor";
                break;
            case "count_by_keyword":
                return "keyword";
                break;
            default:
                return "unsupported";
                break;
        }
    }

    /*
     * floatval() is not reliable, because it cannot handle zeros and, for example,
     * floatval('150abc35') === 150 which is undesired.
     * parsePositiveFloat successfully parses '1.5', '11.456789', '3' values, but
     * not the ones that contain anything else than digits or a period.
     */
    private function parsePositiveFloat(string $str): ParsedNumberTuple {
        $float = 0;
        $has_encoutered_decimal_point = false;
        $past_decimal_point_divisor = 10;

        for ($i = 0; $i < strlen($str); $i++) {

            if ($str[$i] === '.') {
                // safeguard to only allow a single period (e.g. '150.210.14' should not be successful)
                if (!$has_encoutered_decimal_point) {
                    $has_encoutered_decimal_point = true;
                } else {
                    return new ParsedNumberTuple(false, 0);
                }
                continue;
            }

            // drop ASCII value by 48 (48 is '0' char)
            $char_int_val = ord($str[$i]) - 48;

            if ($char_int_val >= 0 && $char_int_val <= 9) {
                if (!$has_encoutered_decimal_point) {
                    $float = $float * 10 + $char_int_val;
                } else {
                    $float = $float + $char_int_val / $past_decimal_point_divisor;
                    $past_decimal_point_divisor *= 10;
                }
            } else {
                return new ParsedNumberTuple(false, 0);
            }

        }

        return new ParsedNumberTuple(true, $float);
    }

    /*
     * intval() is not reliable as it cannot handle zeroes, and
     * intval("10abc99") === 10 which is undesired. This is a pure
     * non-negative integer parsing function.
     */
    private function parseNonNegativeInt(string $str): ParsedNumberTuple {
        $int = 0;

        for ($i = 0; $i < strlen($str); $i++) {

            // drop ASCII value by 48 (48 is '0' char)
            $char_int_val = ord($str[$i]) - 48;

            if ($char_int_val >= 0 && $char_int_val <= 9) {
                $int = $int * 10 + $char_int_val;
            } else {
                return new ParsedNumberTuple(false, 0);
            }

        }

        return new ParsedNumberTuple(true, $int);
    }

}
