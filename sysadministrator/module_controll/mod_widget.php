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
	if($_POST['widget_visible']=="" || $_POST['widget_title']==""){
		header('Location:../mod_widget.php?message=errordata');
	}
	else{
		$wvisible=xss_clean(delete($_POST['widget_visible']));
		$wtitle=xss_clean(delete($_POST['widget_title']));
		$query="UPDATE `jr_widget` SET `widget_visible`='".$wvisible."' WHERE `widget_title`='".$wtitle."'";
		if(!$raw=$conn->query($query)){
			header('Location:../mod_widget.php?message=errorsql');
		}else{
			if($raw){
				header('Location:../mod_widget.php?message=success');
			}
			else{
				header('Location:../mod_widget.php?message=errorsql');
			}
		}
	}
}

?>