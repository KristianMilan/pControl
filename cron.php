<?php
include 'functions.php';
include 'rb.php';
include 'dbconfig.php';
error_reporting(E_ALL);

$cronjob = R::load( 'cronjob', $_GET['id'] );
if($cronjob->task == 'turnon')
{

$state = true;
}
if($cronjob->task == 'turnoff')
{
$state = false;

}
$device->state = setGPIO($cronjob->device->pin, $state, $cronjob->device->inverted);


?>