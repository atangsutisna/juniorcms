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
        <span id="feedback_message"></span>
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
                    success : function(data, status, jqXHR){
                        console.log(data);
                        if (data.status === "error") {
                            $('#feedback_message').text(data.feedback_message);
                        } else {
                            $('#feedback_message').text("success");
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