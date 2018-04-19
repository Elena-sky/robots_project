<?php
require '../../vendor/autoload.php';
require_once ('./php/loader/Loader.php');
Loader::load('app.php');
Loader::load('url/UrlInterface.php');
Loader::load('url/Url.php');
Loader::load('robot/aRobot.php');
Loader::load('robot/aRobotForUrl.php');
Loader::load('robot/RobotForUrl.php');
Loader::load('robot/iRobot.php');
Loader::load('robot/Robot.php');
Loader::load('table/table.php');


$result=[];
if(array_key_exists('url', $_POST)){
    $robot = new \App\Robot\Robot($_POST['url']);
    $result = $robot->check()->getResults();

    $table = new \App\Table\Table();
    $table->setResult($result);
    $table->createTable();
    ksort($result);
}

require_once ('main.php');

