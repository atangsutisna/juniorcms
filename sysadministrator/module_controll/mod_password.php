<?php
session_start();
require_once('../../jr_config.php');
require_once('../../jr_connection.php');
require_once('../../module_controll/jr_quote_handler.php');
require_once('../../module_controll/jr_xss_clean.php');

if(!isset($_SESSION['jrsystem']) && !isset($_SESSION['loggedip']) && !isset($_SESSION['jrlevel']) && !isset($_SESSION['jrdatelog']) 
|| $_SESSION['jrsystem']=="" || $_SESSION['jrsystem']==NULL && $_SESSION['loggedip']=="" || $_SESSION['loggedip']==NULL 
&& $_SESSION['jrlevel']="" || $_SESSION['jrlevel']==NULL && $_SESSION['jrdatelog']="" || $_SESSION['jrdatelog']==NULL){
	session_destroy();
	header('Location:../../jr_login.php');
}
else{
	if($_POST['new_password']=="" || $_POST['cnew_password']==""){
		header('Location:../mod_password.php?message=errordata');
	}
	else{
		$npwd=xss_clean(delete($_POST['new_password']));
		$cpwd=xss_clean(delete($_POST['cnew_password']));
		$pwd="";
		if($npwd==$cpwd){
			$pwd=$npwd;
			$query="UPDATE `jr_user` SET `user_password`='".sha1($pwd.salt)."' WHERE `user_name`='".$_SESSION['jrsystem']."'";
			if(!$raw=$conn->query($query)){
				header('Location:../mod_password.php?message=errorsql');
			}else{	
				if($raw){
					header('Location:../mod_password.php?message=success');
				}
				else{
					header('Location:../mod_password.php?message=errorsql');
				}
			}
		}
		else{
			header('Location:../mod_password.php?message=errordata');
		}
		
	}
}

?>