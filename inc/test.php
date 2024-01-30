<?php
include_once("func.php");
$miau = array_key_exists("mau",$_POST);
if ($miau){
	$miu=$_POST["mau"];
	$IP=get_ip();
	echo json_encode(array("a"=>"miumau :3   ".$miu." | ".$IP));
} else {
	echo json_encode(array("a"=>"VATTU"));
}
?>
