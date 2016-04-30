<?php
http://localhost/hotel/comment/query.php?comment_time_begin=&comment_time_end=2016-02-26&comment_id=&room_num=&comment_star=&user_id=
	require_once('../connect.php');
	
	if(empty($_POST['comment_time_begin'])&&empty($_POST['comment_time_end'])&&empty($_POST['comment_id'])&&empty($_POST['room_num'])&&empty($_POST['comment_star'])&&empty($_POST['user_id'])&&empty($_POST['user_name'])){
		
		die(JSON('431'));
	}else{
		foreach($_POST as $key => $value){
			$$key=$value;
			//var_dump($$key);
		}
	}
	
	if(empty($_POST['comment_time_begin'])){
		$comment_time_begin='1011-00-01 00:00:00';
	}
	if(empty($_POST['comment_time_end'])){
		$comment_time_end='3999-12-01 00:00:00';
	}
	
	
	$querysql = "SELECT * 
	FROM  `comments` 
	WHERE  `comment_time` >=  '$comment_time_begin'
	AND  `comment_time` <=  '$comment_time_end'
	AND  `room_num` ='$room_num'
	AND  `comment_id` ='$comment_id'
	AND  `comment_star` ='$comment_star'
	AND  `user_id` ='$user_id'
	AND  `user_name` ='$user_name'
	LIMIT $_POST[page],$_POST[num_page]
	; ";
	
	//var_dump($querysql);
	if(empty($room_num)){
		$querysql=str_replace("AND  `room_num` ='$room_num'","",$querysql);
	}
	if(empty($comment_id)){
		$querysql=str_replace("AND  `comment_id` ='$comment_id'","",$querysql);
	}
	if(empty($comment_star)){
		$querysql=str_replace("AND  `comment_star` ='$comment_star'","",$querysql);
	}
	if(empty($user_id)){
		$querysql=str_replace("AND  `user_id` ='$user_id'","",$querysql);
	}
	if(empty($user_name)){
		$querysql=str_replace("AND  `user_name` ='$user_name'","",$querysql);
	}
	//var_dump($querysql);

	if($query=mysql_query($querysql)){
		$results=array();
		while($row=mysql_fetch_assoc($query)){
			//var_dump($row);
			array_push($results,$row);
		}
		//var_dump($results);
		if(!empty($results)){
			die(JSON($results));
		}else{
			die(JSON('433'));
		}
		
	}else{
		// echo mysql_error();
		die(JSON('432'));
	}
?>
