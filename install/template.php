<!DOCTYPE html>
<html>
    <head>
        <title>JrCMS installer</title>
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <script type="text/javascript" src="js/jquery.js"></script>
    </head>    
    <body>
    <div class="container">
        <h1>JUNIOR CMS </h1><hr/>
        
        <form id="form_install">
        <div class="alert alert-danger" role="alert" id="feedback_message_ctr" style="display: none;">
             <strong>Error: </strong>
             <span id="feedback_message"></span>
        </div>
        
        <fieldset>
            <legend>Database Info</legend>
                <label>Hostname</label>
                <input type="text" name="hostname">
                <label>Database</label>
                <input type="text" name="database">
                <label>Username</label>
                <input type="text" name="username">
                <label>Password</label>
                <input type="text" name="password">
        </fieldset>
        <fieldset>
            <legend>Sysadmin</legend>
                <label>Username</label>
                <input type="text" name="hostname">
                <label>Password</label>
                <input type="password" name="database">
                <label>Retype password</label>
                <input type="password" name="username">
        </fieldset>
        <fieldset>
            <legend>Site Info</legend>
                <label>Site name</label>
                <input type="text" name="sitename">
                <label>Site tag line</label>
                <input type="text" name="site_tag_line">
                <label>Email address</label>
                <input type="text" name="email">
                <label>Use widget on sidebar </label>
                <label class="radio">
                    <input type="radio" name="widget_use" value="True"/>
                    Ya
                </label>
                <label class="radio">
                    <input type="radio" name="widget_use" value="False"/>
                    Tidak
                </label>
        </fieldset>
        <button type="submit" class="btn">Install</button>
        </form>
    </div>
    <script type="text/javascript">
        $('document').ready(function(){
            console.log("jalan gak ya");
            $('#form_install').submit(function(event){
                var postData = $(this).serializeArray();
                $.ajax({
                    url : 'install.php',
                    type : 'POST',
                    data : postData,
                    dataType : 'json',
                    success : function(data, status, jqXHR){
                        console.log(data.status);
                        console.log(data.status == "error");
                        if (data.status == "error") {
                            //console.log("create feedback_message ", data._message);
                            $('#feedback_message_ctr').show();
                            $('#feedback_message').text(data.error_message);
                        } else {
                            $('#feedback_message').text("success");
                            $('#feedback_message_ctr').hide();
                        }
                    },
                    error : function(){
                        $('#feedback_message').text("error");
                    }
                });
                event.preventDefault();
            });    
        });
        
    </script>
    </body>
</html>