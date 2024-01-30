<?php
include_once("db.php");
include_once("func.php");

$has_info=array_key_exists("contentId",$_POST);
if ($has_info){
	$has_info=array_key_exists("isComment",$_POST);
}

if ($has_info){
	$cont_id=$_POST["contentId"];
	$is_comment=$_POST["isComment"];
	$ip=get_ip();

	$sql="select * from likes where content_id={$cont_id} and ip='{$ip}' and comment='{$is_comment}'";
	$result=$mysqli->query($sql);	

	if ($result->num_rows>0){
		$sql="delete from likes where content_id={$cont_id} and ip='{$ip}' and comment='{$is_comment}'";
		$result=$mysqli->query($sql);
		$out = array("act"=>"LikeRem","cont_id"=>$cont_id,"is_comment"=>$is_comment);
		echo json_encode($out);
	} else {
		$sql="insert into likes (content_id,comment,ip) values ({$cont_id},'{$is_comment}','{$ip}')";
		$result=$mysqli->query($sql);
		$out = array("act"=>"LikeAdd","cont_id"=>$cont_id,"is_comment"=>$is_comment);
		echo json_encode($out);
	}
}

?>
