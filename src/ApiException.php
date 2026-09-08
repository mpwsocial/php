<?php

namespace MoiPayWay;

class ApiException extends \RuntimeException
{
    public function __construct(
        string $message,
        public readonly int $httpStatus = 0,
        public readonly ?array $payload = null
    ) {
        parent::__construct($message, $httpStatus);
    }
}
