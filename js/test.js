function test(em){
	var parent=em.parentNode;
	if (parent.hasAttribute("post-id")){
		var postId=parent.getAttribute("post-id");
		var isComment='false';
	} else if (parent.hasAttribute("comment-id")){
		var postId=parent.getAttribute("comment-id");
		var isComment='true';
	}
	$.ajax({
		url:"../inc/test.php",
		type: "post",
		dataType: "json",
		data: {mau:postId},
		success:function(result){
			console.log(result.a);
		}
	});
}
