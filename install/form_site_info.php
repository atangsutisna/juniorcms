<form action='?install=step2' method='post' name='step1' id='step1' onSubmit="return validate();">
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
	  <td align='left' valign='middle'><input type='text' id='site_url' name='site_url' size='35' onKeyUp="return validate_url();"/></td>
	</tr>
	<tr>
	  <td width='30%' align='left' valign='middle'><strong>Email Address</strong></td>
	  <td align='left' valign='middle'><input type='email' id='Email' name='Email' size='35' onKeyUp="return validate_email();" /></td>
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