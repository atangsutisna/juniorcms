function validate() {
	var site_name = document.forms["step1"]["site_name"].value;
	var tag_line =document.forms["step1"]["tag_line"].value;
	var site_url =document.forms["step1"]["site_url"].value;
	var email =document.forms["step1"]["Email"].value;
	var widget_use =document.forms["step1"]["widget_use"].value;
	if (site_name == null || site_name == "" || 
	    tag_line == null || tag_line == "" || 
	    site_url == null || site_url == "" || 
	    email == null || email =="" || 
	    widget_use == null || widget_use == "" )
	{
		$("#report").html("<font color='red'>Could not process with empty field</font>");
		return false;
	}
}

function validate_email() {
	var email =document.forms["step1"]["Email"].value;
	var atpos= email.indexOf("@");
	var dotpos= email.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
	  {
	  		$("#report").html("<font color='red'>Email not valid</font>");
			return false;
	  }
	  else{
		  $("#report").html("<font color='red'></font>");
			return true;
	  }
} // end check email

function validate_url() {
	 var theurl = document.step1.site_url.value;
	 var tomatch = /http:\/\/[A-Za-z0-9\.-]{3,}\.[A-Za-z]{3}/
	 if (tomatch.test(theurl)) {
			$("#report").html("<font color='red'></font>");
			return false;
	 } else {
		 $("#report").html("<font color='red'>URL not valid</font>");
			return false; 
	 }
} // end check url

function validate_database_form() {
	var db_host = document.forms["step2"]["db_host"].value;
	var db_name = document.forms["step2"]["db_name"].value;
	var db_user = document.forms["step2"]["db_user"].value;
	var db_password = document.forms["step2"]["db_password"].value;
	if (db_host == null || db_host =="" || 
	    db_name == null || db_name == "" || 
	    db_user == null || db_user == "")
	{
		$("#report").html("<font color='red'>Could not process with empty field</font>");
		return false;
	}
}