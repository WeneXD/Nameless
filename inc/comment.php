<?php
include_once("db.php");
include_once("func.php");

$needed_info=array("contentId","commenter","comment");

$has_info=False;
foreach ($needed_info as $key){
	$has_info=array_key_exists($key,$_POST);
	if (!$has_info){
		break;
	}
}

if ($has_info){
	$invalid_info=False;

	$_POST["commenter"]=filter($_POST["commenter"]);
	$_POST["comment"]=filter($_POST["comment"]);

	if (ctype_space($_POST["commenter"]) || $_POST["commenter"]==''){
		$invalid_info=True;
	}elseif (ctype_space($_POST["comment"]) || $_POST["comment"]==''){
		$invalid_info=True;
	}

	if ($invalid_info){
		$out = array("a"=>"invalid");
	} else {
		$name=$_POST["commenter"];
		$comment=$_POST["comment"];
		$cont_id=$_POST["contentId"];

		$sql="insert into comment (name,text,post_id) values ('{$name}','{$comment}',{$cont_id})";
		$mysqli->query($sql);

		$out = array("a"=>"success");
	}

}else{
	$out = array("a"=>"invalid"); /* DATA MISSING */
}

echo json_encode($out)
?>
