<?php


namespace App\Exceptions;


use Exception;
use Throwable;

class ApiException extends Exception {
    private $status;

    public function __construct(Throwable $previous = null, string $message = '未知错误', int $status = 500)
    {
        parent::__construct($message, $previous);
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }
}
