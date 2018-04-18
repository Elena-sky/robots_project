<?php

namespace App\Robot;

use App\Url\Url;

abstract class aRobotForUrl extends aRobot
{
    protected $headers;
    protected $url;

    public function __construct($url)
    {
        $this->url = new Url($url);
        $this->url->validate();
    }

    protected function makeRequest()
    {
        if ($this->url->getUrl()) {
            $this->headers = get_headers($this->url->getUrl() . "/robots.txt");
            return true;
        }
        return false;
    }


}