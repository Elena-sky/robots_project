<?php

namespace App\Robot;


abstract class aRobot
{
    abstract protected function makeRequest();

    abstract protected function getRobot();

    abstract protected function checkStatusCode($header);

    protected function getStatusCode($header)
    {
        $parts = explode(' ', trim($header));
        return (int)$parts[1];
    }
}