<?php
session_start();
require_once('../jr_config.php');
require_once('../jr_connection.php');
require_once('../module_controll/jr_quote_handler.php');

if(!isset($_SESSION['jrsystem']) && !isset($_SESSION['loggedip']) && !isset($_SESSION['jrlevel']) && !isset($_SESSION['jrdatelog']) 
|| $_SESSION['jrsystem']=="" || $_SESSION['jrsystem']==NULL && $_SESSION['loggedip']=="" || $_SESSION['loggedip']==NULL 
&& $_SESSION['jrlevel']="" || $_SESSION['jrlevel']==NULL && $_SESSION['jrdatelog']="" || $_SESSION['jrdatelog']==NULL){
	session_destroy();
	header('Location:../jr_login.php');
}
else{
?>
<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="icon" href="../images/jr-icon.ico" type="image/x-icon" />
<title>Dashboard Admin</title>
<link rel="stylesheet" type="text/css" href="css/user.css"/>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body bgproperties="fixed">

	<!--header-->
    <div id="header">
    	<a href="index.php">
        	<img src="images/logo.png" alt="" style="margin:5px 10px 0 5px;float:left;"/>
        </a>
        <div class="sitetitle">
        Junior CMS Administration
        </div>
        <div class="headermenu">
        Logged with user: <?php echo $_SESSION['jrsystem']." as ".$_SESSION['jrlevel'].", "; echo $_SESSION['jrdatelog'];?>. <a href="../module_controll/jr_login.php?action=logout" >Log Out? <img src="images/super-mono-3d-part2-91.png"/></a>
        </div>
        <div id="siteposition" class="siteposition">
        Dashboard <img src="images/current.png"/> Home
        </div>
    </div>
<div id="wrapper">
   <!--body-->
	<?php require_once('mod_menu.php');?>
	<div id="usercontent">
    	<div class="usercontenttitle"><strong>Dashboard Work Form</strong></div>
        <div class="listrecent">
        <?php
		echo "<p>Welcome ".$_SESSION['jrsystem'].", below is currently statictic of your site. Enjoyt it!</p>";
		require_once('mod_all.php');
		?>
        </div>
    </div>  
    <!--footer-->
    <div id="footer">
    	<div class="copyright">
            <p>&copy; 2012. all right reserved
            <br/>
            powered by <a href="http://www.juniorriau.com" class="copyright"/>juniorriau</a></p>
    	</div>
  	</div>
</div>   
</body>
</html>
<?php } ?>