<?php
session_start();
require_once('jr_config.php');
require_once('jr_connection.php');
require_once('module_controll/jr_quote_handler.php');
require_once('module_controll/jr_get_ipaddress.php');
require_once('module_controll/jr_xss_clean.php');
require_once('module_controll/jr_user_agent.php');

if(isset($_SESSION['jrsystem']) && isset($_SESSION['loggedip']) && isset($_SESSION['jrlevel']) && isset($_SESSION['jrdatelog'])){
	header('Location:sysadministrator/');
}
?>
<link rel='icon' href='images/jr-icon.ico' type='image/x-icon' />
<title>Login | junior-cms</title>
<link rel='stylesheet' type='text/css' href='css/guardian.css'/>

<body >
<div id='logo'><a href='jr_login.php'><img src='images/jr_logo.png' alt='Junior Guardian' border='0' /></a></div>
<div id='login_container'>
<div id='login_msg'><span style='font-size:14px;'><strong>Welcome Back</strong></span><br>Please enter your username below to access admin area.</div>  <div id='login'>
    <form action='module_controll/jr_login.php' method='post' name='frmlogin' id='frmlogin'>
      <table width='100%' border='0' cellspacing='0' cellpadding='5'>
        <tr>
          <td width='30%' align='right' valign='middle'><strong>Username</strong></td>
          <td align='left' valign='middle'><input type='text' name='username' size='30' class='login_inputs' /></td>
        </tr>
        <tr>
          <td width='30%' align='right' valign='middle'><strong>Password</strong></td>
          <td align='left' valign='middle'><input type='password' name='password' size='30' class='login_inputs' /></td>
          <input type='hidden' name='ip' value='<?php echo ip();?>'/>
        </tr>
        <tr>
          <td width='30%' align='right' valign='middle'>&nbsp;</td>
          <td align='left' valign='middle'>
          	<input type='submit' value='Login'/>
                <input type='reset' value='Reset' />
          </td>
        </tr>
        <tr>
            <td colspan='2' class="login_error">
            	<?php
				if(isset($_GET['login_attempt']) && delete($_GET['login_attempt'])==1){
					echo "<span >Incorrect Username or Password</span>";
				}
				?>
            </td>
        </tr>
      </table>
    </form>
  </div>
  <div id='extra_info'>
    <table width='100%' border='0' cellspacing='0' cellpadding='0'>
      <tr>
        <td align='left' valign='middle'>IP Address Logged: <strong><?php echo ip();?></strong></td>
        <td align='right' valign='middle'>Powered by <a href='http://www.juniorriau.com/' target='_new'>juniorriau</a></td>
      </tr>
    </table>
  </div>
</div>
</body>

