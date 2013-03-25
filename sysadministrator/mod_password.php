<?php
session_start();
require_once('../jr_config.php');
require_once('../jr_connection.php');
require_once('../module_controll/jr_quote_handler.php');
require_once('../module_controll/jr_xss_clean.php');

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
<link rel='stylesheet' type='text/css' href='css/bootstrap.min.css'/>
<script type="text/javascript" src="../js/jquery-latest.js"></script>
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
        Dashboard <img src="images/current.png"/> Manage Setting
        </div>
    </div>
<div id="wrapper">
   <!--body-->
	<?php
	//panggil menu
	 require_once('mod_menu.php');?>      
     <div id="usercontent">
    	<div class="usercontenttitle"><strong>Dashboard Work Form</strong></div>
        <div class="listrecent">

        <script type="text/javascript">
			var npwd;
			var cpwd;
			$(document).ready(function(){
				$("#cnew_password").keyup(function(){
				npwd = $("#new_password").val();
				cpwd = $("#cnew_password").val();
				if(cpwd!=npwd){
					$("#nreport").html("<font color='red'> <img src='images/super-mono-3d-part2-57.png' width='20' height='20'/> Password not match!</font>");
				}
				else if(cpwd==npwd){
					$("#nreport").html("");
				}
				return false;
				});
			});
		</script>
        <?php
			if(!isset($_GET['message'])){
				echo "			
				<form id='edit' id='edit' >
				<label ><strong>Change password for ".$_SESSION['jrsystem']."</strong></label><br />
				<label ><strong>New Password</strong></label><br />
				<input type='password' id='new_password' name='new_password' style='width:275px;' /><br/>
				<label ><strong>Confirm New Password</strong></label><br />
				<input type='password' id='cnew_password' name='cnew_password' style='width:275px;' /><span id='nreport'></span><br/>
				</form>";
			echo "<input type='image' src='images/super-mono-3d-part2-95.png' formaction='module_controll/mod_password.php' form='edit' formmethod='post' formenctype='multipart/form-data' class='imgaction'/>
				<input type='image' src='images/super-mono-3d-part2-85.png' onClick=\"window.location.href='mod_password.php';\" class='imgaction' />";
					
			}elseif(isset($_GET['message'])){
				$msg=delete(xss_clean($_GET['message']));
				if($msg=="errordata"){
					echo "<img src='images/super-mono-3d-part2-57.png'/> Cannot process with empty or not match data! Back to <a href='mod_password.php'>Change Password.</a>";
				}elseif($msg=="errorsql"){
					echo "<img src='images/super-mono-3d-part2-57.png'/> Cannot process query with empty data or data not valid! Back to <a href='mod_password.php'>Change Password.</a>";
				}elseif($msg=="success"){
					echo "<img src='images/super-mono-3d-part2-57.png'/> Data saved! Back to <a href='mod_password.php'>Change Password.</a>";
				}else{
					header("Location:mod_password.php");
				}
			}
			
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