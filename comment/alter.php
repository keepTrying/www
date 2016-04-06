<?php
// http://localhost/hotel/comment/alter.php?comment_id=1&user_id=1&comment_text=good,hahahaNoNONO&room_num=100001&comment_star=5&comment_reply=NishiShui
	require_once('../connect.php');
	//var_dump($_POST);
	if(empty($_POST['comment_id'])){
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
	if(empty($_POST['user_id'])){
		die(JSON('415'));
	}
	if(empty($_POST['comment_reply'])){
		die(JSON('416'));
	}
	
	
	
	foreach($_POST as $key => $value){
		$$key = $value; 
		// echo $key ."=>".$value. "<br \>";
	}
	
	$comment_time = date('y-m-d h:i:s');
	
	$insertsql = "INSERT INTO `hotel`.`comments` (`user_id`, `comment_time`, `comment_text`,  `room_num`, `comment_star`) VALUES ('$user_id', '$comment_time', '$comment_text', '$room_num', '$comment_star'); ";
	
	$altersql = "UPDATE `hotel`.`comments` SET `comment_text`='$comment_text', `room_num`='$room_num', `comment_star`='$comment_star', `user_id`='$user_id', `comment_reply`='$comment_reply' WHERE `comments`.`comment_id`='$comment_id'; ";
	
	if(mysql_query($altersql)){
		// echo "alter succeful";
		die(JSON('200'));
	}else{
		// echo "alter fail";
		// echo "<br>";
		// echo mysql_error();
		die(JSON('417'));
	}
?>
