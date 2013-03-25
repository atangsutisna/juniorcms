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
	$query="";
	if(isset($_POST['add']) && $_POST['add']=="true"){
		if($_POST['category_title']=="" || $_POST['category_visible']=="" ){
			header('Location:../mod_category.php?message=errordata');
		}else{
			$query="INSERT INTO `jr_category`(`category_title`, `category_visible`, `category_date_add`) VALUES ('".xss_clean(delete($_POST['category_title']))."','".xss_clean(delete($_POST['category_visible']))."','".date("Y-m-d H:i:s")."')";
		}
	}elseif(isset($_POST['edit']) && $_POST['edit']=="true"){
		$query="UPDATE `jr_category` SET `category_title`='".xss_clean(delete($_POST['category_title']))."',`category_visible`='".xss_clean(delete($_POST['category_visible']))."' WHERE `category_id`='".xss_clean(delete($_POST['category_id']))."'";
	}elseif(isset($_GET['deletecategory']) && xss_clean(delete($_GET['deletecategory']))=="true" && isset($_GET['category_id'])){
		$query="DELETE FROM `jr_category` WHERE `category_id`='".xss_clean(delete($_GET['category_id']))."'";
	}
	if(!$raw=$conn->query($query)){
		header('Location:../mod_category.php?message=errorsql');
	}else{
		if($raw){
			header('Location:../mod_category.php?message=success');
		}
		else{
			header('Location:../mod_category.php?message=errorsql');
		}
	}
	
}

?>