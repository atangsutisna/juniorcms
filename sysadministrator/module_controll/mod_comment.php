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
	if($_GET['deletecomment']=="" || $_GET['comment_id']==""){
		header('Location:../mod_widget.php?message=errordata');
	}
	else{
		$cid=xss_clean(delete($_GET['comment_id']));
		$query="DELETE FROM `jr_comment` WHERE `comment_id`='".$cid."'";
		if(!$raw=$conn->query($query)){
			header('Location:../mod_comment.php?message=errorsql');
		}else{
			if($raw){
				header('Location:../mod_comment.php?message=success');
			}
			else{
				header('Location:../mod_comment.php?message=errorsql');
			}
		}
	}
}

?>