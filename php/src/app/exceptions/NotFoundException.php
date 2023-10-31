<?php
namespace App\exceptions;
class NotFoundException extends \Exception
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}