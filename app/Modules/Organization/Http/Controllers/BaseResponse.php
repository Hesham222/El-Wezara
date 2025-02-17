<?php

namespace Organization\Http\Controllers;

use App\Http\Controllers\Controller;

class BaseResponse extends Controller
{
    public function response($code, $message, $statusCode, $validations = [], $item = 0, $object = null)
    {
        return response()->json(['code' => $code, 'message' => $message, 'validation' => $validations,
            'item' => $item, 'data' => $object], $statusCode);
    }
}
