<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class InvalidDecryptionKeyException extends Exception
{
    public function render($request)
    {
        // Return a custom response with a 403 status code
        return response()->json([
            'error' => 'Invalid decryption key'
        ], Response::HTTP_FORBIDDEN);
    }
}

