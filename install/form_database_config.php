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