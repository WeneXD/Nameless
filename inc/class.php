<?php
require("db.php");
class Post {
	public $id;
	public $title;
	public $image;
	public $likes;

	public function draw_post($main=0){
		$path="";
		if ($main>0){
			$path="../";
		}
		/*if(array_key_exists('like-button',$_POST){
			echo $this->id;
		} THIS THING DON'T WORK!!!!!!!*/
echo '
<div class="post" post-id="'. $this->id .'">
	<h2><a class="post-link" href="/feed?post='.$this->id.'">'. $this->title. '</a></h2>
	<a href="/feed?post='.$this->id.'"><img class="post-image" alt="post-image" src="'. $path .'img/posts/' .$this->image. '"></a>
	<p class="post-likes">Likes: <b id="plike-'. $this->id .'">'. $this->likes. '</b></p>
	<button class="like-button" onclick="like(this)">Like</button>
	<hr>
</div>
';
	}

	public function draw_comments(){
echo '
<div class="comment-cont" post-id="'.$this->id.'">
	<label for="name":>Name*: </label>
	<br>
	<input class="comment-name" type="text" maxlength="25" id="name" name="name">
	<br>
	<label for="text">Comment*:</label>
	<br>
	<textarea class="comment-inputtext" id="text" name="text" maxlength="180" rows="2" cols="40"></textarea>
	<br>
	<button class="comment-button" onclick="comment(this)">Post Comment</button>
</div>
';

		global $mysqli;

		$sql="select * from comment where post_id={$this->id}";
		$result=$mysqli->query($sql);

		$comments=array();

		if ($result->num_rows>0){
			while ($row=$result->fetch_assoc()){
				$comment_data=array($row["id"],$row["name"],$row["text"],$row["post_id"]);
				$_comment=new Comment();
				$_comment->set_data($comment_data);
				array_push($comments,$_comment);
			}
			foreach ($comments as $comment){
				$comment->draw_comment();
			}
		}	
	}

	public function set_data($_data){
		global $mysqli;
		$this->id=$_data[0];
		$this->title=$_data[1];
		$this->image=$_data[2];

		/*GET LIKES*/
		$sql="select * from likes where content_id={$this->id} and comment='false'";
		$result = $mysqli->query($sql);

		$this->likes=$result->num_rows;
	}
}

	
class Comment{
	public $id;
	public $name;
	public $text;
	public $likes;
	public $post_id;

	public function draw_comment(){
echo '
<div class="comment" comment-id="'.$this->id.'">
	<p class="commenter"><b>'.$this->name.'</b></p>
	<p class="comment-text">'.$this->text.'</p>
	<p class="post-likes">Likes: <b id="clike-'.$this->id.'">'.$this->likes.'</b></p>
	<button class="like-button" onclick="like(this)">Like</button>
</div>
';

	}

	public function set_data($_data){
		global $mysqli;

		$this->id=$_data[0];
		$this->name=$_data[1];
		$this->text=$_data[2];
		$this->post_id=$_data[3];

		/*GET LIKES*/
		$sql="select * from likes where content_id={$this->id} and comment='true'";
		$result = $mysqli->query($sql);

		$this->likes=$result->num_rows;
	}
}	


function get_post($post_id="0"){
	global $mysqli;
	/* Even more of le unsafe and unfiltered queries <3 */
	$sql="select * from post where id={$post_id}";
	$result = $mysqli->query($sql);

	echo '<p><a class="back-button" href="javascript:history.back()">&larr;</a></p>';

	if ($result->num_rows>0){
		$post = new Post();
		while ($row = $result->fetch_assoc()){
			$post_data = array($row["id"],$row["title"],$row["image"]);
		}
		$post->set_data($post_data);
		$post->draw_post(1);
		$post->draw_comments();
	} else {
echo '
<div class="post" post-id="no_post">
	<h2>Post not found</h2>
	<img class="post-image" alt="posts404" src="../img/posts404.gif">
	<hr>
</div>
';
		
	}
}


function get_posts($top=False){
	global $mysqli;
	if ($top){ /*Main page get top post. */
		$sql= "select content_id, count(content_id) as like_count from likes group by content_id order by like_count desc limit 1";
		$result = $mysqli->query($sql);
		$top_id=-1;

		if ($result->num_rows>0){
			$row = $result->fetch_assoc();
			$top_id=$row["content_id"];
		}

		if ($top_id>0){
			$sql="select * from post where id={$top_id}";
		}else{
			$sql="select * from post order by id";
		}


		$result=$mysqli->query($sql);

		if ($result->num_rows>0){
			$top_post = new Post();
			while ($row = $result->fetch_assoc()){
				$post_data= array($row["id"],$row["title"],$row["image"]);
			}
			echo "<h2>Top post</h2>";
			$top_post->set_data($post_data);
			$top_post->draw_post();
		} else {
			_posts404();
		}
	} else { /*Feed page get posts. */
		$sql="select * from post order by id desc";
		$result = $mysqli->query($sql);
		
		$posts=array();
		
		if ($result->num_rows>0){
			while ($row = $result->fetch_assoc()){
				$post_data=array($row["id"],$row["title"],$row["image"],$row["likes"]);
				$_post=new Post();
				$_post->set_data($post_data);
				array_push($posts,$_post);
			}
			foreach ($posts as $post){
				$post->draw_post(1);
			}
		} else {
			_posts404(1);
		}
	}
}

function _posts404($main=0){
	$path="";
	if ($main>0){
		$path="../";
	}
echo '
<div class="post" post-id="no_post">
	<h2>No posts yet</h2>
	<img class="post-image" alt="posts404" src="'. $path .'img/posts404.gif">
	<hr>
</div>
';
}
?>
