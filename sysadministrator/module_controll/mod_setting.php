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
	if($_POST['site_name']=="" || $_POST['site_tag_line']=="" || $_POST['use_widget']=="" || $_POST['email_address']==""){
		header('Location:../mod_setting.php?message=errordata');
	}
	else{
		$query="UPDATE `jr_site_profile` SET `site_name`='".$_POST['site_name']."',`site_tag_line`='".$_POST['site_tag_line']."',`use_widget`='".$_POST['use_widget']."',`email_address`='".$_POST['email_address']."' WHERE `site_url`='".$_POST['site_url']."'";
		if(!$raw=$conn->query($query)){
			header('Location:../mod_setting.php?message=errorsql');
		}else{
			if($raw){
				header('Location:../mod_setting.php?message=success');
			}
			else{
				header('Location:../mod_setting.php?message=errorsql');
			}
		}
	}
}

?>