<?php

namespace App\Http\Controllers;

use App\Http\Requests\TwoNumbersRequest;

class CalculatorController extends Controller
{
    public function addTwoNumbers(TwoNumbersRequest $request) {
        $a = $request['a'];
        $b = $request['b'];
        $result = $a + $b;
        return response()->json(['success' => true, 'data' => $result]);
    }

    public function subtractTwoNumbers(TwoNumbersRequest $request) {
        $a = $request['a'];
        $b = $request['b'];
        $result = $a - $b;
        return response()->json(['success' => true, 'data' => $result]);
    }

    public function multiplyTwoNumbers(TwoNumbersRequest $request) {
        $a = $request['a'];
        $b = $request['b'];
        $result = $a * $b;
        return response()->json(['success' => true, 'data' => $result]);
    }

    public function divideTwoNumbers(TwoNumbersRequest $request) {
        $a = $request['a'];
        $b = $request['b'];
        try {
            $result = $a / $b;
        } catch (\Exception $exception) { // Using generic exception because PHP 7 only throws DivisionByZeroError on integer division (intdiv or %)
            return response()->json(['success' => false, 'message' => 'Division by zero']);
        }
        return response()->json(['success' => true, 'data' => $result]);
    }
}
