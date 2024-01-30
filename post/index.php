<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Make a post</title>
	<link rel="stylesheet" href="../css/main.css">
</head>
<body>
	<div class="main-cont">
	<header>
		<h1>Make a post</h1>
		<nav>
			<p><a href="/feed">Feed</a></p>
			<p><a href="/">Main</a></p>
		</nav>
		<hr>
	</header>
	<form class="post" id="postform" enctype="multipart/form-data" method="post" action="upload.php">
		<label for="title">Title*: </label>
		<input type="text" maxlength="25" id="title" name="title">
		<br>
		<label for="image">Image*: </label>
		<input type="file" id="image" name="image">
		<br><br>
		<input type="submit" name="submit">
	</form>
	</div>
</body>
</html>
