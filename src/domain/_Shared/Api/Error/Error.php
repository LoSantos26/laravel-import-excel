<?php

namespace Src\domain\_Shared\Api\Error;

class Error
{
    public function mountErrorApi(string $message)
    {
        return [
            'success' => false,
            'message' => $message,
        ];
    }
}
