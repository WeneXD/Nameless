<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Main</title>
	<link rel="stylesheet" href="css/main.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="./js/like.js"></script>
</head>
<body>
	<div class="main-cont">
	<header>
		<h1>Main</h1>
		<nav>
			<p><a href="/feed">Feed</a></p>
			<p><a href="/post">Post</a></p>
		</nav>
		<hr>
	</header>
<?php
include_once("./inc/class.php");
include_once("./inc/func.php");
get_posts(True);
?>
	</div>
</body>
</html>
