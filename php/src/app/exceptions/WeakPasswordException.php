<?php

namespace App\exceptions;
class WeakPasswordException extends \Exception
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}