<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Bogota');

//Connect & Select Database
$enlace = mysqli_connect("localhost","wwsist_root","XXXXXXX","wwsist_app_reportes") or die("could not connect server");
$enlace2 = mysqli_connect("localhost","wwsist_root","XXXXXXXXXX","wwsist_app_reportes") or die("could not connect server");

//tildes y Ñ
mysqli_set_charset($enlace,"utf8");
mysqli_set_charset($enlace2,"utf8");

$fecha = date("Y-m-d");
$hora = date("h:i:sa");

//Create
if(isset($_POST['visitante']))
{
	$cedula=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['cedula'])));
	$nombre_completo=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['nombre_completo'])));
	$telefono=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['telefono'])));
	$empresa=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['empresa'])));
	$tipo_de_visita=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['tipo_de_visita'])));
	$contacto_unitec=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['contacto_unitec'])));
	$temperatura=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['temperatura'])));
	$eps=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['eps'])));
	$arl=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['arl'])));
	$observaciones=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['observaciones'])));

	$q=mysqli_query($enlace,"insert into `visitantes` (`cedula`,`nombre_completo`,`telefono`,`empresa`,`tipo_de_visita`,`contacto_unitec`,`temperatura`,`eps`,`arl`,`observaciones`,`hora`,`fecha`) values ('$cedula','$nombre_completo','$telefono','$empresa','$tipo_de_visita','$contacto_unitec','$temperatura','$eps','$arl','$observaciones','$hora','$fecha')");
		if($q)
		{
			echo "success";
		}
		else
		{
			echo "failed";
			//echo "failed".mysqli_error($enlace);
			//printf("Errormessage: %s\n", mysqli_error($link));
		}

	echo mysqli_error($enlace);
}

//Create
if(isset($_POST['empleado']))
{
	$nombre_completo=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['nombre_completo'])));
	$temperatura=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['temperatura'])));
	$observaciones=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['observaciones'])));

	$q=mysqli_query($enlace,"insert into `empleados_temp` (`nombre_completo`,`temperatura`,`observaciones`,`hora`,`fecha`) values ('$nombre_completo','$temperatura','$observaciones','$hora','$fecha')");
		if($q)
		{
			echo "success";
		}
		else
		{
			echo "failed";
			//echo "failed".mysqli_error($enlace);
			//printf("Errormessage: %s\n", mysqli_error($link));
		}

	echo mysqli_error($enlace);
}

//Create New Account
if(isset($_POST['lavadora']))
{
	$nombre=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['nombre'])));
	$telefono=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['telefono'])));
	$celular=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['celular'])));
	$direccion=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['direccion'])));
	$fecha=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['fecha'])));
	$tiempo=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['tiempo'])));
	$jabon=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['jabon'])));
	$suavizante=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['suavizante'])));
	$cod_apk_cliente=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['cod_apk_cliente'])));
	$latitud=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['latitud'])));
	$longitud=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['longitud'])));

		$date=date("d-m-y h:i:s");
		$q=mysqli_query($enlace,"insert into `lavadoras` (`reg_date`,`nombre`,`telefono`,`celular`,`direccion`,`fecha`,`tiempo`,`jabon`,`suavizante`) values ('$date','$nombre','$telefono','$celular','$direccion','$fecha','$tiempo','$jabon','$suavizante')");
		$p=mysqli_query($enlace2,"insert into `kt_driver_task` (`customer_id`,`customer_name`,`delivery_date`,`task_description`,`trans_type`,`contact_number`,`delivery_address`,`task_lat`,`task_lng`,`status`,`critical`,`cod_apk_cliente`,`task_token`) values ('5','$nombre','$fecha','nueva solicitud lavadora','delivery','$celular','$direccion','$latitud','$longitud','unassigned','1','$cod_apk_cliente','$cod_apk_cliente')");
		if($q)
		{
			echo "success";
		}
		else
		{
			echo "failed";
		}

	echo mysql_error();
}

//Create New Account
if(isset($_POST['signup']))
{
	$fullname=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['fullname'])));
	$email=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['email'])));
	$password=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['password'])));
	$login=mysqli_num_rows(mysqli_query($enlace,"select * from `phonegap_login` where `email`='$email'"));
	if($login!=0)
	{
		echo "exist";
	}
	else
	{
		$date=date("d-m-y h:i:s");
		$q=mysqli_query($enlace,"insert into `phonegap_login` (`reg_date`,`fullname`,`email`,`password`) values ('$date','$fullname','$email','$password')");
		if($q)
		{
			echo "success";
		}
		else
		{
			echo "failed";
		}
	}
	echo mysql_error();
}

//Login
if(isset($_POST['login']))
{
	$email=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['email'])));
	$password=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['password'])));
	$login=mysqli_num_rows(mysqli_query($enlace,"select * from `phonegap_login` where `email`='$email' and `password`='$password'"));
	$res = mysqli_query($enlace,"select * from `phonegap_login` where `email`='$email' and `password`='$password'");
	$row = mysqli_fetch_assoc($res);
	if($login!=0)
	{
		echo "success=".$row["fullname"];
	}
	else
	{
		echo "failed";
	}
}

//Change Password
if(isset($_POST['change_password']))
{
	$email=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['email'])));
	$old_password=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['old_password'])));
	$new_password=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['new_password'])));
	$check=mysqli_num_rows(mysqli_query($enlace,"select * from `phonegap_login` where `email`='$email' and `password`='$old_password'"));
	if($check!=0)
	{
		mysqli_query($enlace,"update `phonegap_login` set `password`='$new_password' where `email`='$email'");
		echo "success";
	}
	else
	{
		echo "incorrect";
	}
}

// Forget Password
if(isset($_POST['forget_password']))
{
	$email=mysqli_real_escape_string($enlace,htmlspecialchars(trim($_POST['email'])));
	$q=mysqli_query($enlace,"select * from `phonegap_login` where `email`='$email'");
	$check=mysqli_num_rows($q);
	if($check!=0)
	{
		echo "success";
		$data=mysqli_fetch_array($q, MYSQLI_ASSOC);
		$string="Hey,".$data['fullname'].", Your password is".$data['password'];
		mail($email, "Your Password", $string);
	}
	else
	{
		echo "invalid";
	}
}

?>