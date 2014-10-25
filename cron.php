<?php
include 'functions.php';
include 'rb.php';
include 'dbconfig.php';
error_reporting(E_ALL);

$cronjob = R::load( 'cronjob', $argv[1] );
$device = R::load('devices',  $cronjob->device->id);
if($cronjob->task == 'turnon')
{

$state = true;
}
if($cronjob->task == 'turnoff')
{
$state = false;

}
$device->state = setGPIO($device->pin, $state, $device->inverted);
R::store($device);

?>