function like(em){
	var par=em.parentNode;
	if (par.hasAttribute("post-id")){
		var postId=par.getAttribute("post-id");
		var comment='false';
	} else if (par.hasAttribute("comment-id")){
		var postId=par.getAttribute("comment-id");
		var comment='true';
	}
	console.log(postId);
	console.log(comment);
	$.ajax({
		url:"../inc/like.php",
		type: "post",
		dataType: "json",
		data: {contentId:postId,isComment:comment},
		success:function(result){
			console.log(result.act + " | " + result.cont_id + " | " + result.is_comment);
			var posttype="p"; //p=post, c=comment
			if (comment=='true'){posttype="c"};
			var likecounter=document.getElementById(posttype+"like-"+postId);
			var likes=parseInt(likecounter.innerHTML);
			if (result.act=="LikeAdd"){likes++;} else {likes--;}
			likecounter.innerHTML=likes.toString();
		}
	});

}
