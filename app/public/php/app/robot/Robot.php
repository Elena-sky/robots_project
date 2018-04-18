<?php

namespace App\Robot;

class Robot extends RobotForUrl implements iRobot
{

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
        return $this;
    }

    protected function getRobot()
    {
        // TODO: Implement getRobot() method.
    }

    public function getResults()
    {
        return $this->formatResult();
    }


}