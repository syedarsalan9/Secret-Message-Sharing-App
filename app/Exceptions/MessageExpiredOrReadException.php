<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class MessageExpiredOrReadException extends Exception
{
    public function render($request)
    {
        // Return a custom response with a 404 status code
        return response()->json([
            'error' => 'Message has expired or already read'
        ], Response::HTTP_NOT_FOUND);
    }
}
