<?php


namespace App\Exceptions;


use Throwable;

class IncorrectPasswordException extends ApiException {
    public function __construct(Throwable $previous = null, string $message = '密码错误', int $status = 401) {
        parent::__construct($previous, $message, 401);
    }
}
