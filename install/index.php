<?php
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_STRICT);
session_start();
require_once('../module_controll/jr_get_ipaddress.php');
require_once('install.class.php');
function delete($val){
	$arr=array("'",'-');
	return $new=str_replace($arr,"",$val);
}


?>
<!DOCTYPE HTML>
<html>
<link rel='icon' href='../images/jr-icon.ico' type='image/x-icon' />
<script type='text/javascript' src='../js/jquery-latest.js'></script>
<title>Intaller | junior-cms</title>
<link rel="stylesheet" href="css/style.css" type="text/css" />
<script type="text/javascript" src="js/common.js"></script>
<body >
<div id='logo'><img src='../images/jr_logo.png' alt='Junior Guardian' border='0' /></div>
<div id='form_container'>
<div id='form_msg'><span style='font-size:14px;'><strong>Welcome to Junior CMS Installer</strong></span><br>Please enter your website detail below to configuration and setting.</div>  
<div id='form'> 

<?php
//TODO: variabel $GET[install] kudu di filter, sebelum di proses
$stepReq = isset($GET['install']) ? "step1" : $_GET['install'];
switch ($stepReq) {
	case "step1" :
		include "form_site_info.php";
		break;
	case "step2" :
		break;
	case "step3" :
		break;
	case "step4" :
		break;
	case "step5" :
		break;
	
}
exit;
?>
</div>
  <div id='extra_info'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td align='left' valign='middle'></td>
        <td align='right' valign='middle'>Powered by <a href='http://www.juniorriau.com/' target='_new'>juniorriau</a></td>
      </tr>
    </table>
  </div>
 </div>
</body>
</html>

   <?php 
   $data = new Installer();
   
   if(isset($_GET['install']) && delete($_GET['install'])=="step1"){
		?>
		
		<form action='?install=step2' method='post' name='step1' id='step1' onSubmit="return check();">
		  <table width='100%' border='0' cellspacing='0' cellpadding='5'>
			<tr>
			  <td width='30%' align='left' valign='middle'><strong>Site Name</strong></td>
			  <td align='left' valign='middle'><input type='text' id='site_name' name='site_name' size='35' /></td>
			</tr>
			<tr>
			  <td width='30%' align='left' valign='middle'><strong>Site Tag Line</strong></td>
			  <td align='left' valign='middle'><input type='text' id='tag_line' name='tag_line' size='35'/></td>
			</tr>
			<tr>
			  <td width='30%' align='left' valign='middle'><strong>Site URL</strong></td>
			  <td align='left' valign='middle'><input type='text' id='site_url' name='site_url' size='35' onKeyUp="return check_url();"/></td>
			</tr>
			<tr>
			  <td width='30%' align='left' valign='middle'><strong>Email Address</strong></td>
			  <td align='left' valign='middle'><input type='email' id='Email' name='Email' size='35' onKeyUp="return checkEmail();" /></td>
			</tr>
			<tr>
			  <td width='30%' align='left' valign='middle'><strong>Use Widget on Sidebar</strong></td>
			  <td align='left' valign='middle'><select name='widget_use' id='widget_use' style='width:245px;'>
							<option value=''>--Choose Active--</option>
							<option value='True' selected>Active</option>
							<option value='False'>Non Active</option>
							</select></td>
			</tr>
			<tr>
			  <td width='30%' align='left' valign='middle'>&nbsp;</td>
			  <td align='left' valign='middle'>
				<input type='submit' value='Next' style='width:100px;height:30px'/>
			  </td>
			</tr>
            <tr>
			  <td width='30%' align='left' valign='middle' colspan="2">
              <span id='report' name='report'></span>
			  </td>
			</tr> 
		  </table>
		</form>
                <?php
				
	} // end step 1
	elseif(isset($_GET['install']) && delete($_GET['install'])=="step2"){
		$_SESSION['step1']=array(
						'site_name'=>delete($_POST['site_name']),
						'tag_line'=>delete($_POST['tag_line']),
						'site_url'=>delete($_POST['site_url']),
						'Email'=>delete($_POST['Email']),
						'widget_use'=>delete($_POST['widget_use']));
		?>
		
        		<form action='?install=step3' method='post' name='step2' id='step2' onSubmit="return validate_database_form();">
				  <table width='100%' border='0' cellspacing='0' cellpadding='5'>
					<tr>
					  <td width='30%' align='left' valign='middle'><strong>Database Host</strong></td>
					  <td align='left' valign='middle'><input type='text' id='db_host' name='db_host' size='35' /></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle'><strong>Database Name</strong></td>
					  <td align='left' valign='middle'><input type='text' id='db_name' name='db_name' size='35'/></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle'><strong>Username</strong></td>
					  <td align='left' valign='middle'><input type='text' id='db_user' name='db_user' size='35'/></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle'><strong>User Password</strong></td>
					  <td align='left' valign='middle'><input type='password' id='db_password' name='db_password' size='35'/></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle'>&nbsp;</td>
					  <td align='left' valign='middle'>
						<input type='submit' value='Next' style='width:100px;height:30px'/>
					  </td>
					</tr>
                    <tr>
					  <td width='30%' align='left' valign='middle' colspan="2">
                      <span id='report' name='report'></span>
					  </td>
					</tr>
				  </table>
				</form>
                <?php
	} // end step 2
	elseif(isset($_GET['install']) && delete($_GET['install'])=="step3"){
		$_SESSION['step2']=array(
						'db_host'=>delete($_POST['db_host']),
						'db_name'=>delete($_POST['db_name']),
						'db_user'=>delete($_POST['db_user']),
						'db_password'=>delete($_POST['db_password']));
		?>
        <form action='?install=step4' method='post' name='install' id='install'>
				  <table width='100%' border='0' cellspacing='0' cellpadding='5'>
                  <tr>
					  <td width='30%' align='left' valign='middle'><strong>Username</strong></td>
					  <td align='left' valign='middle'><input type='text' id='username' name='username' size='35' value="sysadmin" /></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle'><strong>Password</strong></td>
					  <td align='left' valign='middle'><input type='text' id='password' name='password' size='35' value="sysadmin"/></td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'>
						<input type='submit' value='Next' style='width:100px;height:30px'/>
					  </td>
					</tr>
				  </table>
				</form>
                <?php
	} // end step 3
	elseif(isset($_GET['install']) && delete($_GET['install'])=="step4"){
		$_SESSION['step3']=array(
						'username'=>delete($_POST['username']),
						'password'=>delete($_POST['password']));
		?>
        <form action='?install=step5' method='post' name='install' id='install'>
				  <table width='100%' border='0' cellspacing='0' cellpadding='5'>
					<tr>
					  <td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'>Required Data Complete. Continue to Install Step?</td>
					</tr>
					<tr>
					  <td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'>
						<input type='submit' value='Install CMS' style='width:100px;height:30px'/>
					  </td>
					</tr>
				  </table>
				</form>
                <?php
	} // end step 4
	elseif(isset($_GET['install']) && delete($_GET['install'])=="step5"){
		$data->_setValue('site_name',$_SESSION['step1']['site_name']);
		$data->_setValue('tag_line',$_SESSION['step1']['tag_line']);
		$data->_setValue('site_url',$_SESSION['step1']['site_url']);
		$data->_setValue('Email',$_SESSION['step1']['Email']);
		$data->_setValue('widget_use',$_SESSION['step1']['widget_use']);
		$data->_setValue('db_host',$_SESSION['step2']['db_host']);		
		$data->_setValue('db_user',$_SESSION['step2']['db_user']);
		$data->_setValue('db_password',$_SESSION['step2']['db_password']);
		$data->_setValue('db_name',$_SESSION['step2']['db_name']);
		$data->_setValue('username',$_SESSION['step3']['username']);
		$data->_setValue('password',$_SESSION['step3']['password']);
		$result=$data->_install();
		echo "<form action='?install=step4' method='post' name='install' id='install'>
				  <table width='100%' border='0' cellspacing='0' cellpadding='5'>
					
					  ";
					  if($result['status']=="ok"){
						  echo "
						  <tr>
					  <td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'/>".$result['msg']."</td>
					</tr>
					<tr><td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'>
						<input type='button' value='Login' style='width:100px;height:30px' onClick='window.location=\"../jr_login.php\"'/>
					  </td></tr>";
					  }elseif($result['status']=="failed"){
						  echo "
						  <tr>
					  <td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'/>".$result['msg']."</td>
					</tr>
					<tr><td width='30%' align='left' valign='middle' style='text-align:center;' colspan='2'>
						<input type='button' value='Login' style='width:100px;height:30px' onClick='window.location=\"?install=step1\"'/>
					  </td></tr>";
					  }
					  echo"
				  </table>
				</form>";
	} // end step 5
echo "
  </div>
  <div id='extra_info'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td align='left' valign='middle'></td>
        <td align='right' valign='middle'>Powered by <a href='http://www.juniorriau.com/' target='_new'>juniorriau</a></td>
      </tr>
    </table>
  </div>
 </div>
</body>
</html>";

?>