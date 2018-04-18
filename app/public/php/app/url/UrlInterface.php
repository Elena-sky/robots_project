<?php

namespace App\Url;

interface UrlInterface {
    public function setUrl($url);
    public function getUrl();
    public function validate();
}