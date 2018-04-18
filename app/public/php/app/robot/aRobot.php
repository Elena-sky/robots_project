<?php

namespace App\Robot;


abstract class aRobot
{
    abstract protected function makeRequest();

    abstract protected function getRobot();
}