<?php

namespace App\Robot;

class Robot extends RobotForUrl implements iRobot
{
    private $src;

    public function check()
    {
        if (!$this->headerStatus) {
            return $this;
        }
        $this->checkStatusCode($this->headerStatus);
        if ($this->robotContent == '') {
            return $this;
        }
        $headerLength = $this->getHeaderWithLength();
        $this->checkLength($headerLength, $this->robotContent);
        $this->checkDirectives($this->robotContent);
        return $this;
    }

    public function getResults()
    {
        $this->src = $this->formatResult();
        return $this->src;
    }

}