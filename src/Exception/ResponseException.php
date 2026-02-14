<?php

namespace Exception;

class ResponseException extends \Exception
{
    public static function invalidStatusCode(string $body, int $code): self
    {
        throw new self('Failed to generate response, body: ' . $body . ', Response status code : ' . $code);
    }
}