<?php
/**
 * Created by PhpStorm.
 * User: guoji
 * Date: 2019/2/23
 * Time: 23:41
 */
namespace Ccb\Helpers;
use Exception;
use Throwable;

class OutLimitException extends Exception
{
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}