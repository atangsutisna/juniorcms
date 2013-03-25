<?php
require_once('module_controll/jr_get_ipaddress.php');
require_once('module_controll/jr_user_agent.php');

$ua=getBrowser();
$browser= "Browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'] . " reports: " . $ua['userAgent'];

$qcek="SELECT * FROM `jr_visitor` WHERE `visitor_online_status`=1 AND `visitor_ipaddress`='".ip()."' 
AND `visitor_online` < NOW()";
$rawcek=$conn->query($qcek);
$rawresultcek=$rawcek->num_rows;
if($rawresultcek > 0){
	$queryuv="UPDATE `jr_visitor` SET `visitor_online` = CURRENT_TIMESTAMP, `visitor_user_agent`= '".$browser."'
	WHERE `visitor_online_status`=1 AND `visitor_online` < NOW()  AND `visitor_ipaddress`='".ip()."'"; 
	$row=$conn->query($queryuv);
	
}elseif($rawresultcek == 0){
	$queryi="INSERT INTO `jr_visitor`(`visitor_ipaddress`, `visitor_user_agent`, `visitor_date`, `visitor_online`, `visitor_online_status`) 
  VALUES ('".ip()."','".$browser."',CURDATE(),CURRENT_TIMESTAMP,1)";
	$row=$conn->query($queryi);
}


$qt="SELECT COUNT(*) as num FROM `jr_visitor`";
$rawdata=$conn->query($qt);
$dataresult=$rawdata->fetch_assoc();
$total = $dataresult['num'];

$qd="SELECT COUNT(*) as num FROM `jr_visitor` WHERE `visitor_date` = CURDATE()";
$rawdata=$conn->query($qd);
$dataresult=$rawdata->fetch_assoc();
$today = $dataresult['num'];

$qy="SELECT COUNT(*) as num FROM `jr_visitor` WHERE `visitor_date` = DATE_ADD(CURDATE(), INTERVAL -1 DAY)";
$rawdata=$conn->query($qy);
$dataresult=$rawdata->fetch_assoc();
$yesterday = $dataresult['num'];

$qo="SELECT COUNT(*) as num FROM `jr_visitor` WHERE `visitor_online_status`=1";
$rawdata=$conn->query($qo);
$dataresult=$rawdata->fetch_assoc();
$online = $dataresult['num'];


echo "
<div id='site_sidebar'>
	<div class='side_head'>
		<p>Traffic Visitor</p>
	</div>
	<div class='side_content'>
		<div class='visitor'>
			<img src='images/total-visitor.png'/> Total Visitor : ".$total."<br>
			<img src='images/online-green-icon.png'/> Total Online : ".$online."<br>
			<img src='images/total-online.png'/> Visitor Today : ".$today."<br>
			<img src='images/offline-icon.png'/> Visitor Yesterday : ".$yesterday."<br>
			<img src='images/online-red-icon.png'/> Your IP : ".ip()."<br>
		</div>
	</div>
</div>";
?>