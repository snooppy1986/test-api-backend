<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;

class ItemNotFoundException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render()
    {
        return response(
            content: [
                "success" => false,
                "message" => $this->getMessage()
            ],
            status: $this->getCode(),
            headers: [
                'Content-Type => application/json'
            ]
        );
    }
}
