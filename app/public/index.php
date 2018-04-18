<?php
require_once ('./php/loader/Loader.php');
Loader::load('app.php');
Loader::load('url/UrlInterface.php');
Loader::load('url/Url.php');

$result=[];
if(array_key_exists('url', $_POST)){
    $robot = new \App\Robot\Robot($_POST['url']);
    $result = $robot->check()->getResults();
    ksort($result);
}

require_once ('main.php');

