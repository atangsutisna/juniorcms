<?php
if (!file_exists('jr_config.php')) {

	echo "<script>document.location.href = 'install/';</script>";
}
else {

//meng include file2 penting
require_once('jr_config.php');
require_once('jr_connection.php');
require_once('jr_setting.php');
require_once('module_controll/jr_xss_clean.php');
require_once('module_controll/jr_quote_handler.php');
echo "
<!DOCTYPE html> 
<html>
<head>
  <title>".$data['site_name']."</title>
  <link rel='icon' href='images/jr-icon.ico'/>
  <meta name='description' content='".$data['site_tag_line']."' />
  <meta name='keywords' content='website keywords, website keywords' />
  <meta http-equiv='content-type' content='text/html; charset=windows-1252' />
  <link rel='stylesheet' type='text/css' href='css/style.css' />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type='text/javascript' src='js/modernizr-2.6.1.min.js'></script>
  <script type='text/javascript' src='js/jquery-latest.js'></script>
</head>
<body>
	<div id='wrapper'>
    	<div id='banner'>
		<a href='".$data['site_url']."' ><img src='images/logo.png' alt='".$data['site_tag_line']."'/></a>
        </div>
		";
		//memanggil file menu
        require('module_controll/jr_menu.php');
       echo" <div class='slideshow'>
	    	<ul class='slideshow'>
          		<li class='show'><img width='980' height='250' src='images/home_1.jpg' alt='&quot;Enter your caption here&quot;' /></li>
          		<li><img width='980' height='250' src='images/home_2.jpg' alt='&quot;Enter your caption here&quot;' /></li>
        	</ul> 
	  	</div>
        
		<div id='site_".$css."'>";
		//mengecek apakah ada menu page yang terplih atau tidak
		if(!isset($_GET['page_id']) && !isset($_GET['category_id']) && !isset($_GET['author']) && !isset($_GET['post_id']) && !isset($_GET['searchkey'])){
			require_once('module_controll/jr_home.php');
		}elseif(isset($_GET['page_id']) && !isset($_GET['category_id']) && !isset($_GET['author']) && !isset($_GET['post_id']) && !isset($_GET['searchkey'])){
			//bilah terpilih, data modul menu page di ambil
			$page=$conn->real_escape_string($_GET['page_id']); //<-menangkal serangan sql injection
			$rescontent=$conn->query("SELECT * FROM jr_page WHERE page_id='".$page."'");
			$content=$rescontent->fetch_assoc();
			if($content['page_module']=="" || $content['page_module']==NULL){
				echo "
				<div class='".$css."_imagetext'>
					".$content['page_content']."
				</div><!--close content_imagetext-->
				";
				
			}elseif($content['page_module']!="" || $content['page_module']!=NULL){
				require_once("module_controll/jr_".$content['page_module'].".php");			
			}

		}elseif(isset($_GET['category_id']) && !isset($_GET['page_id'])  && !isset($_GET['author']) && !isset($_GET['post_id']) && !isset($_GET['searchkey'])){
			$category_id=$conn->real_escape_string(xss_clean($_GET['category_id'])); 
			$rescontent=$conn->query("SELECT `jr_post`.`post_id`, `jr_post`.`post_title`, `jr_post`.`post_user`, DATE_FORMAT(`jr_post`.`post_date`,'%d %M %Y') as date FROM `jr_post`, `jr_category`
WHERE  `jr_post`.`post_category`=`jr_category`.`category_title` AND `jr_category`.`category_id`='".$category_id."' ORDER BY `post_id`");
			$content=$rescontent->num_rows;
			if($content==0){
				echo "<div class='content_title'>
						No data found!.
					</div>";
			}else{
				while($content=$rescontent->fetch_array()){
					echo "<div class='".$css."_imagetext'>
					<div class='content_title'>
						<a href='?post_id=".$content['post_id']."'>".$content['post_title']."</a><br>
						<h4>Posted by <a href='?author=".$content['post_user']."'>".$content['post_user']." </a>, ".$content['date']."</h4>
					</div></div> <br>";
				}
			}
			
		}elseif(isset($_GET['author']) && !isset($_GET['page_id'])  && !isset($_GET['category_id']) && !isset($_GET['post_id']) && !isset($_GET['searchkey'])){
			$author=$conn->real_escape_string(xss_clean($_GET['author'])); 
			$rescontent=$conn->query("SELECT `post_id`, `post_title`, `post_user`, DATE_FORMAT(`post_date`,'%d %M %Y') as date FROM `jr_post` WHERE `post_user`='".$author."' ORDER BY `post_id`");
			$content=$rescontent->num_rows;
			if($content==0){
				echo "<div class='content_title'>
						No data found!.
					</div>";
			}else{
				while($content=$rescontent->fetch_array()){
					echo "<div class='".$css."_imagetext'>
					<div class='content_title'>
						<a href='?post_id=".$content['post_id']."'>".$content['post_title']."</a><br>
						<h4>Posted by <a href='?author=".$content['post_user']."'>".$content['post_user']." </a>, ".$content['date']."</h4>
					</div></div> <br>";
				}
			}		
			
		}elseif(isset($_GET['post_id']) && !isset($_GET['page_id'])  && !isset($_GET['category_id']) && !isset($_GET['author']) && !isset($_GET['searchkey'])){
			$post_id=$conn->real_escape_string(xss_clean($_GET['post_id'])); 
			$rescontent=$conn->query("SELECT `jr_post`.`post_id`, `jr_post`.`post_title`, `jr_post`.`post_category`, `jr_post`.`post_content`, `jr_post`.`post_tag`, `jr_post`.`post_user`, DATE_FORMAT(`jr_post`.`post_date`,'%d %M %Y') as date, `jr_category`.`category_id` FROM `jr_post`, `jr_category`
WHERE  `jr_post`.`post_category`=`jr_category`.`category_title` AND `post_id`='".$post_id."'");
			$content=$rescontent->num_rows;
			if($content==0){
				echo "<div class='content_title'>
						No data found!.
					</div>";
			}else{
				
				while($content=$rescontent->fetch_assoc()){
					echo "
					<div class='".$css."_imagetext'>
						<div class='content_title'>
							".$content['post_title']."<br>
							<h4>Posted by <a href='?author=".$content['post_user']."'>".$content['post_user']." </a>, ".$content['date']."</h4>
							<h4>Category <a href='?catedory_id=".$content['category_id']."'>".$content['post_category']."</a>, Tags : ".$content['post_tag']."</h4>
						</div>
						".$content['post_content'];
					echo "</div><!--close content_imagetext-->";
				}
			}		
			
			
		}elseif(isset($_GET['searchkey']) && !isset($_GET['page_id'])  && !isset($_GET['category_id']) && !isset($_GET['post_id']) && !isset($_GET['author'])){
			$searchkey=delete(xss_clean($_GET['searchkey'])); 
			$rescontent=$conn->query("SELECT `post_id`, `post_title`, `post_user`, DATE_FORMAT(`post_date`,'%d %M %Y') as date FROM `jr_post` WHERE `post_title` LIKE '%".$searchkey."%' OR `post_content` LIKE '%".$searchkey."' OR `post_tag` LIKE '%".$searchkey."' ORDER BY `post_id`");
			$content=$rescontent->num_rows;
			if($content==0){
				echo "<div class='content_title'>
						No data found!.
					</div>";
			}else{
				while($content=$rescontent->fetch_array()){
					echo "<div class='".$css."_imagetext'>
					<div class='content_title'>
						<a href='?post_id=".$content['post_id']."'>".$content['post_title']."</a><br>
						<h4>Posted by <a href='?author=".$content['post_user']."'>".$content['post_user']." </a>, ".$content['date']."</h4>
					</div></div> <br>";
				}
			}			
		}
        
       echo	" </div><!--close site_content-->";
	   echo	" <div id='sidebody'> <!--open side bar-->";
	   //memanggil module widget widget
		if($css=='contenthalf'){
			do {
				include("module_controll/jr_side_".$datamod["widget_module"].".php");
			}while($datamod=$rowmod->fetch_array());
		}
   echo "</div><!--close side bar-->
 </div><!--close wrapper-->";
		include('jr_footer.php');
echo "
</body>
</html>";
}

?>

