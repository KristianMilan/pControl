<?php
include 'functions.php';
include 'rb.php';
include 'dbconfig.php';
error_reporting(E_ALL);
session_save_path("/tmp");
session_start();

if($_POST['action']=='login')
{
	
	if(isset($_SESSION['username']))
	{

		$result = array('success'=>true, 'isauthed'=>true);
	}
	else
	{
				$user  = R::find( 'user', ' username = ? AND password = ? ', array($_POST['username'], md5($_POST['password'])));
				//var_dump($user);
				
				if($user == false || $user == null)
				{
					$result = array('success'=>false, 'isauthed'=>false);
				}
				else
				{
					$_SESSION['username'] = $user[1]->username;
					$result = array('success'=>true, 'isauthed'=>true, 'username'=>$_SESSION['username']);
					
				}
		

	}
	echo json_encode($result);
}
if($_POST['action']=='logout')
{
	
		checkAuth();
		session_destroy();
		$result = array('success'=>true, 'isauthed'=>false);
	
		echo json_encode($result);
}
if($_POST['action']=='initload')
{
	
	checkAuth();
	$devices = R::getAll( 'SELECT * FROM devices WHERE active = 1' );	
	//var_dump($devices);
	$result = array('success'=>true, 'isauthed'=>false);
	$result["devices"] = '';
	$result["devices-table"] = '';
	$result["devices"] = $result["devices"]. '<table class="ui table segment"> <thead> <tr> <th colspan="2" class="ui center aligned header"> Urządzenia </th> </tr> <tr> <th>Opis</th> <th>&nbsp;</th> </tr> </thead> <tbody>';
	foreach($devices as $device)
	{
		$state = '';
		if($device['state']==1)
		{
			$state = ' checked="checked" ';
		}
		$result["devices"] = $result["devices"]. '<tr><td><div class="ui checkbox toggle"><input type="checkbox" class="device-toggle" data-device-id="'.$device["id"].'" '.$state.'><label>&nbsp;</label></div></td><td>'.$device["description"].'</td></tr>';
	}
	$result["devices"] = $result["devices"]. '</tbody> <tfoot> <tr> <th colspan="3"> <div class="ui buttons"><div class="ui red button all-off">OFF</div><div class="ui green button all-on">ON</div></div> </th> </tr> </tfoot> </table>';
	foreach($devices as $device)
	{
		$result["devices-table"] = $result["devices-table"] . "<tr><td>".$device['description']."</td><td>".$device['pin']."</td><td>".$device['state']."</td><td><div class=\"ui icon button device-delete\" data-id=\"".$device['id']."\"><i class=\"ui trash icon\"></i></div></td></tr>";
	}
	$categories = R::getAll( 'SELECT * FROM category' );
	foreach($categories as $category)
	{
		$result["categories-table"] = $result["categories-table"] . "<tr><td>".$category['name']."</td><td>".$category['column']."</td><td><div class=\"ui icon button category-delete\" data-id=\"".$category['id']."\"><i class=\"ui trash icon\"></i></div></td></tr>";
	}
	
	echo json_encode($result);
}

if($_POST['action']=='devicechange')
{
	checkAuth();
	$device = R::load('devices',$_POST['id']);
	//$gpio = new PhpGpio\GPIO();
	//$gpio->setup(intval($device->pin), "out");

	//echo "Turning on pin $device->pin\n";
	//$gpio->output(intval($device->pin), $_POST['state'] ? 1 : 0);
	
	$device->state = setGPIO($device->pin, $_POST['state'], $device->inverted);
	
	
	$result = array('success'=>true, 'isauthed'=>true, 'pin'=>$device->pin, 'state'=>$device->state);
	echo json_encode($result);

	R::store($device);
}
if($_POST['action']=='shutdown')
{
	checkAuth();
	exec('sudo shutdown -h now');
	session_destroy();
	$result = array('success'=>true, 'isauthed'=>false);
	echo json_encode($result);
	

}

if($_POST['action']=='reboot')
{
	checkAuth();
	exec('sudo reboot');
	session_destroy();
	$result = array('success'=>true, 'isauthed'=>false);
	echo json_encode($result);
	

}
/*
if($_POST['action']=='listdevices')
{
	checkAuth();
	$devices = R::getAll( 'SELECT * FROM devices' );
	$string = "";
	foreach($devices as $device)
	{
		$string = $string . "<tr><td>".$device['description']."</td><td>".$device['pin']."</td><td>".$device['state']."</td><td><div class=\"ui icon button device-delete\" data-id=\"".$device['id']."\"><i class=\"ui trash icon\"></i></div></td></tr>";
	}
	$result = array('success'=>true, 'isauthed'=>false, 'html'=>$string, 'devices'=>$devices);
	echo json_encode($result);
	

}*/

if($_POST['action']=='adddevice')
{
	checkAuth();
	$device = R::dispense('devices');
	$device->description = $_POST['description'];
	$device->pin = $_POST['pin'];
	$device->state = false;
	$device->active = true;
	if($_POST['inverted'] == 'true')
	{
		$device->inverted = true;
	}
	else
	{
		$device->inverted = false;
	}
	R::store($device);
	$result = array('success'=>true, 'isauthed'=>false);
	echo json_encode($result);
	

}

if($_POST['action']=='addcategory')
{
	checkAuth();
	$category = R::dispense('category');
	$category->name = $_POST['name'];
	$category->column = $_POST['column'];
	R::store($category);
	$result = array('success'=>true, 'isauthed'=>false);
	echo json_encode($result);
	

}
if($_POST['action']=='updates')
{
	checkAuth();
	
	
	$result = array('success'=>true, 'isauthed'=>true, 'updates' => getUpdates());
	echo json_encode($result);
	

}

if($_POST['action']=='deletedevice')
{
	checkAuth();
	
	$device = R::load( 'devices', $_POST['id'] );
	R::trash( $device );
	$result = array('success'=>true, 'isauthed'=>true);
	echo json_encode($result);
	

}

if($_POST['action']=='deletecategory')
{
	checkAuth();
	
	$device = R::load( 'category', $_POST['id'] );
	R::trash( $device );
	$result = array('success'=>true, 'isauthed'=>true);
	echo json_encode($result);
	

}
if($_POST['action']=='console')
{
	checkAuth();
	

	$result = array('success'=>true, 'isauthed'=>true, 'response'=>exec($_POST['command']));
	echo json_encode($result);
	

}
?>