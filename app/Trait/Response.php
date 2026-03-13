<?php

namespace App\Trait;

trait Response
{
    public function SuccessResponse($status = 'Success', string $msg , $data , $code)
    {
        return response()->json([
            'Status'  => __($status),
            'message' => __($msg),
            'data'    => $data
        ], $code);
    }

    public function ErrorResponse($status = 'Error' , string $msg, $data = null , $code)
    {
        return response()->json([
            'Status' => __($status),
            'message'=> __($msg),
            'data'    => $data
        ], $code);
    }
}
