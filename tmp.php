<?php
include 'rb.php';
include 'dbconfig.php';

$cronjob = R::dispense('cronjob');
$cronjob->description = "Turn on";
$cronjob->task = "turnon";
$cronjob->device = R::load('devices',  2);
$cronjob->minute = 30;
$cronjob->hour = 20;
$cronjob->day = 24;
$cronjob->month = 10;
$cronjob->active = true;
R::store($cronjob);
?>