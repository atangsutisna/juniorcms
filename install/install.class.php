<?php

class Installer {
	public $configurations;
	public $connection;
	
	public function addConfiguration($key, $value){
		$this->configurations[$key] = $value;
	}
	
	public function getConfigurations(){
		return $this->configurations;
	}
	
	public function __construct($connection = null) {
	    $this->connection = $connection;
	}
	/**
	 * untuk mengatur koneksi database bukan tanggung jawab kelas ini
	public function _checkDB($dbhost,$dbuser,$dbpassword,$dbname){
		// I think we should to show message gracefully if $connection failed
		// because not all user understand the error stack trace
		try {
			$dbhost = "atangsutisna-juniorcms-1061955";
			$dbuser = "atangsutisna";
			$dbpassword = "";
			$dbname = "jr_cms";
			$mysqli=new mysqli($dbhost,$dbuser,$dbpassword,$dbname);
		} catch (Exception $e) {
			echo 'Could not connect to ', $dbname, '<br>';
			echo '<b>Error message </b>', $e->getMessage();
			exit;
		}
	} */
	
	public function run(){
		$file = "cms.sql";
		if (!file_exists($file)) {
		    return "Cannot find cms.sql file, Installation stoped.";
		}
		
		$dbfile = fopen($file, "r+"); 
		$dbquery = fread($dbfile, filesize($file)); 
		$queryArray = explode(';',$dbquery);

		if (!$dbfile){
			return false;
		} else {
			$msg = "Installation Complete. Do not forget delete installation folder. Enjoy with Junior CMS";
			//$connection = new mysqli($this->configurations['db_host'],$this->configurations['db_user'],$this->configurations['db_password'],$this->configurations['db_name']);
			foreach ($queryArray as $query) {
            	if (strlen($query)>3){
           			$result = $this->connection->query($query);
					if(!$result) {
						$msg = $this->connection->error;
						break;
					}else{
						continue;
					}
				}
			}
			
			if($result==true){
				date_default_timezone_get();
				$user = $this->connection->query("INSERT INTO `jr_user`(`user_name`, `user_password`, `user_full_name`, `user_email`, `user_level`, `user_date_register`, `user_ipaddress_register`) 
				VALUES ('".$this->configurations['username']."','".sha1($this->configurations['password'].">}{|(&^%@#$%d^&)(}{5(*&^%?$#!~G%")."','".$this->configurations['username']."','".$this->configurations['Email']."','sysadmin','".date("Y-m-d H:i:s")."','".ip()."')");
				
				$setting = $this->connection->query("INSERT INTO `jr_site_profile`(`site_name`, `site_tag_line`, `site_url`, `email_address`, `use_widget`)
				 VALUES ('".$this->configurations['site_name']."','".$this->configurations['tag_line']."','".$this->configurations['site_url']."','".$this->configurations['Email']."','".$this->configurations['widget_use']."')");
				
				$post = $this->connection->query("INSERT INTO `jr_post` (`post_id`, `post_title`, `post_category`, `post_content`, `post_tag`, `post_user`, `post_date`, `post_ip`) 
				VALUES (1, 'Welcome', 'General', '<p>Welcome to Junior-CMS v1.5. This CMS build for learning and it&#39;s under GPL license&nbsp;</p>\r\n\r\n<p>This is your first post. You can modify it. Enjoy with this cms.</p>\r\n\r\n<p>regards</p>\r\n\r\n<p>junior.riau18</p>\r\n', 'new post', 'hafizh', '2013-03-23 09:13:24', '127.0.0.1')");

				file_put_contents("../jr_config.php","<?php
                        //define the database name
                        define(\"dbname\",\"".$this->configurations['db_name']."\");
                        						
                        //define the database username
                        define(\"dbuser\",\"".$this->configurations['db_user']."\");
                        						
                        //define the database password use by username
                        define(\"dbpassword\",\"".$this->configurations['db_password']."\");
                        						
                        //define database host/database server host to use
                        define(\"dbhost\",\"".$this->configurations['db_host']."\");
                        						
                        //define time zone
                        date_default_timezone_get();
                        						
                        //define salt password
                        define(\"salt\",\">}{|(&^%@#$%d^&)(}{5(*&^%?$#!~G%\");
                        						
                        ?>"
                ); // end put contents
				return array('status'=>$msg);
			}else{
				return array('status'=>$msg);
			}
		}
	}
	
	public function getStatus() {
	    /**
	     * aku pikir untuk mengecek koneksi database bukan tugasnya kelas ini
		$this->connect=$this->_checkDB($this->configurations['db_host'],$this->configurations['db_user'],$this->configurations['db_password'],$this->configurations['db_name']);
		if($this->connect==true){
			$this->connect = $this->run();
			if($this->connect==true){
				return array(
					"msg"=>$this->connect['status'],
					"status"=>"ok");
			}else{
				return array(
					"msg"=>$this->connect['status'],
					"status"=>"fail");
			}
		}
		elseif($this->connect==false){
			return array(
					"msg"=>"Could not run install script, check all sending data throug installation step!",
					"status"=>"fail");
		} */
		if ($this->run() == true) {
		    return array(
					"msg"=>$this->connect['status'],
					"status"=>"ok");
		} else {
		    return array(
					"msg"=>$this->connect['status'],
					"status"=>"fail");
		}
	}
} // end class install
?>