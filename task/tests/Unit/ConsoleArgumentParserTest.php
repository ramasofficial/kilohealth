<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Classes\ConsoleArgumentParser;

class ConsoleArgumentParserTest extends TestCase
{

    public function testParsesTwoAppropriateFloatsSuccessfully()
    {
        $parser = new ConsoleArgumentParser();
        $argv = [
            0 => "blank",
            1 => "count_by_price_range",
            2 => "105.13",
            3 => "107.75"
        ];
        $console_arg_info = $parser->parse($argv);

        $this->assertEquals(true, $console_arg_info->getSuccess());
        $this->assertEquals(105.13, $console_arg_info->getValues()["price_from"]);
        $this->assertEquals(107.75, $console_arg_info->getValues()["price_to"]);
    }

    public function testParsesFloatsUnsuccessfullyWhenTheyContainIllegalCharacters()
    {
        $parser = new ConsoleArgumentParser();
        $argv = [
            0 => "blank",
            1 => "count_by_price_range",
            2 => "10;aBC.19",
            3 => "13.14"
        ];
        $console_arg_info = $parser->parse($argv);

        $this->assertEquals(false, $console_arg_info->getSuccess());
    }

    public function testParsesFloatsUnsuccessfullyWhenArgumentsAreInTheWrongOrder()
    {
        $parser = new ConsoleArgumentParser();
        $argv = [
            0 => "blank",
            1 => "count_by_price_range",
            2 => "100.15",
            3 => "80.35"
        ];
        $console_arg_info = $parser->parse($argv);

        $this->assertEquals(false, $console_arg_info->getSuccess());
    }

    public function testParsesAppropriateIntSuccessfully()
    {
        $parser = new ConsoleArgumentParser();
        $argv = [
            0 => "blank",
            1 => "count_by_vendor_id",
            2 => "346",
        ];
        $console_arg_info = $parser->parse($argv);

        $this->assertEquals(true, $console_arg_info->getSuccess());
        $this->assertEquals(346, $console_arg_info->getValues()["vendor_id"]);
    }

    public function testParsesIntContainingIllegalCharactersUnsuccessfully()
    {
        $parser = new ConsoleArgumentParser();
        $argv = [
            0 => "blank",
            1 => "count_by_vendor_id",
            2 => "346abc",
        ];
        $console_arg_info = $parser->parse($argv);

        $this->assertEquals(false, $console_arg_info->getSuccess());
    }

}
