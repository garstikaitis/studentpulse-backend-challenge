<?php

namespace App\Http\Controllers;

use Throwable;
use App\Traits\UserValidation;
use App\Http\Requests\TwoNumbersRequest;

class CalculatorController extends Controller
{
    use UserValidation;
    public function addTwoNumbers(TwoNumbersRequest $request) {
        // @TODO: implement add two numbers logic
        // @TODO: implement user validation. Could also be middleware
    }

    public function subtractTwoNumbers(TwoNumbersRequest $request) {
        // @TODO: implement subtract two numbers logic
        // @TODO: implement user validation. Could also be middleware
    }

    public function multiplyTwoNumbers(TwoNumbersRequest $request) {
        // @TODO: implement multiply two numbers logic
        // @TODO: implement user validation. Could also be middleware
    }

    public function divideTwoNumbers(TwoNumbersRequest $request) {
        // @TODO: implement divide two numbers logic
        // @TODO: implement user validation. Could also be middleware
        // @TODO: catch and handle division by zero exception
        // @TODO: write a test to make sure division by zero is not possible
    }
}
