<?php
session_start();
require_once('../jr_config.php');
require_once('../jr_connection.php');
require_once('jr_quote_handler.php');
require_once('jr_get_ipaddress.php');
require_once('jr_xss_clean.php');
require_once('jr_user_agent.php');
if(isset($_POST['username']) && isset($_POST['password'])){
	$ua=getBrowser();
	$user_agent= $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . ". Reports: " . $ua['userAgent'];
	$usr=xss_clean(delete($_POST['username']));
	$pwd=xss_clean(delete($_POST['password']));
	$query="SELECT `user_name`, `user_password`, `user_level` FROM `jr_user` WHERE `user_name`='".$usr."' AND `user_password`='".sha1($pwd.salt)."'";
	$raw=$conn->query($query);
	$cek=$raw->num_rows;
	
	if($cek==0){
		$query="INSERT INTO `jr_login_log`(`login_username`, `login_ipaddress`, `login_user_agent`, `login_date`, `login_status`)
			VALUES ('".$usr."','".ip()."','".$user_agent."','".date("Y-m-d H:i:s")."','login error')";
			$loged=$conn->query($query);
		header("Location:../jr_login.php?login_attempt=1");
	}
	else{
		$data=$raw->fetch_assoc();
		if($usr==$data['user_name'] && sha1($pwd.salt)==$data['user_password']){
			$date=date("Y-m-d H:i:s");
			$_SESSION['jrsystem']=$data['user_name'];
			$_SESSION['loggedip']=ip();
			$_SESSION['jrlevel']=$data['user_level'];
			$_SESSION['jrdatelog']=$date;
			$query="INSERT INTO `jr_login_log`(`login_username`, `login_ipaddress`, `login_user_agent`, `login_date`, `login_status`)
			VALUES ('".$data['user_name']."','".ip()."','".$user_agent."','".$date."','logged')";
			$loged=$conn->query($query);
			header('Location:../sysadministrator/');
		}
	}
}

if(isset($_GET['action']) && delete($_GET['action'])=='logout'){	
	$query="UPDATE `jr_login_log` SET `login_status`='logout' WHERE `login_username`='".$_SESSION['jrsystem']."' AND `login_ipaddress`='".$_SESSION['loggedip']."' AND `login_date`='".$_SESSION['jrdatelog']."' AND `login_status`='logged'";
	$logout=$conn->query($query);
	session_destroy();
	header('Location:../jr_login.php');
}


?>