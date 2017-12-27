<?php
/**
 * Created by IntelliJ IDEA.
 * User: jasontriche
 * Date: 12/27/17
 * Time: 8:59 AM
 */

class EventEmitter {

    public $data;
    public $callback;

    public function __construct() {
        $this->data = array();
        $this->callback = array();
    }

    public function emit($tag,$message) {
        $this->data = $message;
        if($this->callback[$tag]) {
            call_user_func($this->callback[$tag], $this->data);
        }
    }

    public function subscribe($tag,$callback_function) {
        $this->callback[$tag] = $callback_function;
    }

}

$emitter = new EventEmitter;

$error_callback = function($data) {
    echo "Error 1. {$data["message"]} \n";
};

$error_callback2 = function($data) {
    echo "Error 2. {$data["message"]} \n";
};

$success_callback = function($data) {
    echo "SUCCESS! {$data["message"]} \n";
};

$emitter->emit("error", ["message" => "Error one."]);

$emitter->subscribe("error", $error_callback);
$emitter->emit("error", ["message" => "Second error."]);

$emitter->subscribe("error", $error_callback);
$emitter->emit("error", ["message" => "Yet another error."]);

$emitter->subscribe("error", $error_callback2);
$emitter->emit("error", ["message" => "Yet another error."]);

$emitter->subscribe("success", $success_callback);
$emitter->emit("success", ["message" => "Great success!."]);

// Expected output:

// Error 1. Second error.
// Error 1. Yet another error.
// Error 2. Yet another error.
// SUCCESS! Great success!
