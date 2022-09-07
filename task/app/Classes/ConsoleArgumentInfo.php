<?php

namespace App\Classes;

class ConsoleArgumentInfo {
    private string $option;
    private array $values;
    private bool $success;
    private string $message;

    function __construct() {}

    public function getOption() {
        return $this->option;
    }

    public function getValues() {
        return $this->values;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setOption(string $option) {
        $this->option = $option;
    }

    public function setValues(array $values) {
        $this->values = $values;
    }

    public function setSuccess(bool $success) {
        $this->success = $success;
    }

    public function setMessage(string $message) {
        $this->message = $message;
    }
}
