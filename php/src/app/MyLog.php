<?php
namespace BatBook;

class MyLog
{
    private $accesLogger;

    public function __construct()
    {
        $this->accesLogger = new Logger('AccesLogger');
        $this->accesLogger->pushHandler(new StreamHandler('logs/acces.log', Logger::DEBUG));
    }

    public function logAccess($message)
    {
        $this->accesLogger->info($message);
    }
}