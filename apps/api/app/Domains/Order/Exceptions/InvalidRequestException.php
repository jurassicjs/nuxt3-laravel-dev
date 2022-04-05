<?php

namespace App\Domains\Order\Exceptions;

use Exception;

class InvalidRequestException extends Exception
{

    /**
     * @throws InvalidRequestException
     */
    public static function missingArgument(string $argument)
    {
        throw new static("Invalid Request! $argument missing in Request");
    }

    /**
     * @throws InvalidRequestException
     */
    public static function wrongArgumentType(string $argument, string $type)
    {
        throw new static("Invalid Request! $argument must be of type $type");
    }

    /**
     * @throws InvalidRequestException
     */
    public static function wrongActionType(string $action, string $type)
    {
        throw new static("$action is an invalid action on $type");
    }
}
