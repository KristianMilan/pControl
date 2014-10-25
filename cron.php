<?php
include 'functions.php';
include 'rb.php';
include 'dbconfig.php';
error_reporting(E_ALL);

$cronjobs = R::getAll( 'SELECT * FROM cronjob WHERE active = 1' );



?>