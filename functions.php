<?php

function checkAuth()
{
if(!isset($_SESSION['username']))
	{
		$result = array('success'=>false, 'isauthed'=>false);
		echo json_encode($result);
		die();

	}
	
}

function getUpdates()
{
$updates['temp'] = explode('=', exec('sudo /opt/vc/bin/vcgencmd measure_temp'))[1];
$updates['ip'] = exec('hostname -I');
return $updates;
}
if($_POST['action']=='checkauth')
{
	
	if(isset($_SESSION['username']))
	{

		$result = array('success'=>true, 'isauthed'=>true, 'username'=>$_SESSION['username']);
	}
	else
	{
		$result = array('success'=>true, 'isauthed'=>false);

	}
	echo json_encode($result);
}

function setGPIO($pin, $state, $inverted = false)
{
exec("gpio -g mode $pin output");
if($state == 'true' || $state == 1)
	{
		
		if($inverted)
		{
			exec("gpio -g write $pin 1");
		}
		else
		{
			exec("gpio -g write $pin 0");
		}
		return true;
		
	}
	else
	{
		if($inverted)
		{
			exec("gpio -g write $pin 0");
		}
		else
		{
			exec("gpio -g write $pin 1");
		}
		return false;
	}
}
?>