<?php
$dataPerPage = 10;
$page_id=delete($_GET['page_id']);
if(isset($_GET['pagelist']))
	$noPage = $_GET['pagelist'];
else 
	$noPage = 1;

$offset = ($noPage - 1) * $dataPerPage;

$sqlpage='SELECT COUNT(*) as jumData FROM `jr_post`';
$resultpost  = $conn->query($sqlpage);
$data  = $resultpost->fetch_assoc();
$jumData = $data['jumData'];

$jumPage = ceil($jumData/$dataPerPage);

$query="SELECT `jr_post`.`post_id`, `jr_post`.`post_title`, `jr_post`.`post_category`, `jr_post`.`post_content`, `jr_post`.`post_tag`, `jr_post`.`post_user`, DATE_FORMAT(`jr_post`.`post_date`,'%d %M %Y') as date, `jr_category`.`category_id` FROM `jr_post`, `jr_category`
WHERE  `jr_post`.`post_category`=`jr_category`.`category_title` ORDER BY `post_id` DESC LIMIT ".$offset.", ".$dataPerPage."";
$raw=$conn->query($query);
$rawcek=$raw->num_rows;
if($rawcek==0){
echo "<div class='".$css."_imagetext'>
	No data found in database!
</div><!--close content_imagetext-->";
}
elseif($rawcek!=0){
	while($data=$raw->fetch_array()){
		$content=explode("</p>",$data['post_content']);
		echo "
		<div class='".$css."_imagetext'>
			<div class='content_title'>
				<a href='?post_id=".$data['post_id']."'>".$data['post_title']."</a><br>
				<h4>Posted by <a href='?author=".$data['post_user']."'>".$data['post_user']." </a>, ".$data['date']."</h4>
				<h4>Category <a href='?catedory_id=".$data['category_id']."'>".$data['post_category']."</a>, Tags : ".$data['post_tag']."</h4>
			</div>
			".$content[0]."
			<div class='button_small'>
				<a href='?post_id=".$data['post_id']."'>Read more</a>
			</div><!--close button_small-->";
			$querycomment="SELECT COUNT(`comment_id`) as comment FROM `jr_comment`,`jr_post` WHERE `jr_comment`.`post_id`=`jr_post`.`post_id`";
			$rowc=$conn->query($querycomment);
			$datac=$rowc->num_rows;
			if(!$rowc=$conn->query($querycomment)){
				echo "
				<div class='comment'>
					<p>Could not retrieve data!</p>
				</div><!--close comment-->";
			}
			else{
				$datac=$rowc->fetch_assoc();
				echo "
				<div class='comment'>
					<p>".$datac['comment']." Comments</p>
				</div><!--close comment-->";
			}
		echo "</div><!--close content_imagetext-->";
	}
}
echo "<div id='paging'>";
if ($noPage > 1) echo  "<a class='pageprev' href='?page_id=".$page_id."&pagelist=".($noPage-1)."'>&lt;&lt; Prev</a>";
if ($noPage < $jumPage) echo "<a class='pagenext' href='?page_id=".$page_id."&pagelist==".($noPage+1)."'>Next &gt;&gt;</a>";
echo "</div>";
	?>