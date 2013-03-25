<?php
/*load all site setting
site profile(title, tag line, setting side bar(widget recent post, category, visitor, sitepartner)*/
$row=$conn->query('SELECT * FROM jr_site_profile');
$data=$row->fetch_assoc();

//mengecek apakah memakain widget sidebar atau tidak
if($data['use_widget']=='True'){
	$css='contenthalf';
}else
	$css='contentfull';
define('email',$data['email_address']);
//load module bila sidebar aktif
$rowmod=$conn->query('SELECT * FROM jr_widget WHERE widget_visible=\'True\'');
$datamod=$rowmod->fetch_array();

//loag page mene(menu bar)
$rowmenu=$conn->query('SELECT * FROM jr_page WHERE page_visible=\'True\'');
$datamenu=$rowmenu->fetch_array();
?>