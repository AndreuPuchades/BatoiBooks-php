<?php

 namespace BatBook\exceptions;
class InvalidFormatException extends \Exception
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}