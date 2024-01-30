function comment(em){
	var par=em.parentNode;
	var nameInput=document.getElementById("name");
	var textInput=document.getElementById("text");
	
	var postId=par.getAttribute("post-id");
	
	$.ajax({
		url:"../inc/comment.php",
		type: "post",
		dataType: "json",
		data: {contentId:postId,commenter:nameInput.value,comment:textInput.value},
		success:function(result){
			if (result.a=="invalid"){
				console.log("Missing data");
			}else{
				nameInput.value="";
				textInput.value="";
				location.reload();
			}
		}
	});
}
