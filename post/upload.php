<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posted</title>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
<br>
<br>
<div class="main-cont">
<?php
include_once("../inc/db.php");
include_once("../inc/func.php");
if (isset($_POST["submit"])){
    $target_dir = "../img/posts/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imgFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $_POST["title"]=filter($_POST["title"]);

    if (ctype_space($_POST["title"]) || $_POST["title"]==''){
	echo "Where title!? ";
	$uploadOk=0;
    }
    if ($_FILES["image"]["error"]==4 || ($_FILES["image"]["size"]==0 && $_FILES["image"]["error"]==0)){
        echo "Where image!?<br>";
    } else {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check==false){
            $uploadOk=0;
        }

        if ($imgFileType != "jpg" && $imgFileType!="jpeg" && $imgFileType != "png" && $imgFileType != "gif"){
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk=0;
        }
        
        if ($_FILES["image"]["size"]>5000000){
            echo "Image too big.";
            $uploadOk=0;
        }

        if ($uploadOk==0){
            echo "Upload unsuccesful";
        } else {
            $sql = "select id from post order by id desc limit 1";
	    $result = $mysqli->query($sql);
	    $image_ID="1";
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $image_ID = strval($row["id"]+1);
                }
	    }
	/*meow*/
            $_FILES["image"]["name"]=$image_ID. "." .$imgFileType;
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
	    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
		$title=$_POST["title"];
		$imgName=$_FILES["image"]["name"];
		$mysqli->query("insert into post (title,image) values ('{$title}','{$imgName}')");
                echo "<br>Your post has been properly uploaded!<br><br>";
            } else {
                echo "Error with uploading image.";
            }
        }
    }
} else {
    echo "Nuh uh.";
}
?>
<p><a href="/">Main</a></p>
</div>
</body>
</html>
