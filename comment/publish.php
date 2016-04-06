<?php
// http://localhost/hotel/comment/publish.php?user_id=1&comment_text=good,hahaha&room_num=100001&comment_star=5
	require_once('../connect.php');
	//var_dump($_POST);
	if(empty($_POST['user_id'])){
		die(JSON('411'));
	}
	if(empty($_POST['comment_text'])){
		die(JSON('412'));
	}
	if(empty($_POST['room_num'])){
		die(JSON('413'));
	}
	if(empty($_POST['comment_star'])){
		die(JSON('414'));
	}
	
	foreach($_POST as $key => $value){
		$$key = $value; 
		// echo $key ."=>".$value. "<br \>";
	}
	
	$comment_time = date('y-m-d h:i:s');
	
	$insertsql = "INSERT INTO `hotel`.`comments` (`user_id`, `comment_time`, `comment_text`,  `room_num`, `comment_star`) VALUES ('$user_id', '$comment_time', '$comment_text', '$room_num', '$comment_star'); ";
	
	if(mysql_query($insertsql)){
		// echo "insert succeful";
		die(JSON('200'));
	}else{
		// echo "insert fail";
		// echo "<br>";
		// echo mysql_error();
		die(JSON('417'));
	}
?>
