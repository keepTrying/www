<?php
	require_once('../connect.php');
	
	if(empty($_POST['comment_time_begin'])&&empty($_POST['comment_time_end'])&&empty($_POST['comment_id'])&&empty($_POST['room_num'])&&empty($_POST['comment_star'])&&empty($_POST['user_id'])){
		
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
	
	
	$querysql = "SELECT count(*) 
	FROM  `comments` 
	WHERE  `comment_time` >=  '$comment_time_begin'
	AND  `comment_time` <=  '$comment_time_end'
	AND  `room_num` ='$room_num'
	AND  `comment_id` ='$comment_id'
	AND  `comment_star` ='$comment_star'
	AND  `user_id` ='$user_id'
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
	
	//var_dump($querysql);

	if($query=mysql_query($querysql)){
//		$results=array();
//		var_dump($results);
		while($row=mysql_fetch_assoc($query)){
//			var_dump($row);
			$results=array("count"=>$row['count(*)']);
			die(JSON($results));
		}
		
		
	}else{
		// echo mysql_error();
		die(JSON('431'));
	}
?>
