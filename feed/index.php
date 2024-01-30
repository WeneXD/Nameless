<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Feed</title>
	<link rel="stylesheet" href="../css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="../js/like.js"></script>
<?php
if (isset($_GET["post"])){
	echo '<script src="../js/comment.js"></script>';
}
?>
</head>
<body>
<div class="main-cont">
	<header>
		<h1>Feed</h1>
		<nav>
			<p><a href="/">Main</a></p>
			<p><a href="/post">Post</a></p>
		</nav>
		<hr>
	</header>
<?php
include_once("../inc/class.php");
if (isset($_GET["post"])){
	get_post($_GET["post"]);	
}else{
	get_posts();
}
?>
</div>
</body>
</html>
