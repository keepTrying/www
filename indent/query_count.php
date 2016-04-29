<?php
http://localhost/hotel/indent/query.php?time_begin=2016-02-25&time_end=2016-02-26&pay=1&room_num=010001&indent_status=2&user_id=0001&cost_min=10&cost_max=999&indent_type=2&indent_id=2
	require_once('../connect.php');
	
	if(empty($_POST['time_begin'])&&empty($_POST['time_end'])&&empty($_POST['cost_max'])&&empty($_POST['cost_min'])&&empty($_POST['indent_time_begin'])&&empty($_POST['indent_time_end'])&&!isset($_POST['room_num'])&&!isset($_POST['indent_id'])&&!isset($_POST['indent_status'])&&!isset($_POST['user_id'])&&!isset($_POST['indent_type'])){
		
		die(JSON('431'));
	}else{
		foreach($_POST as $key => $value){
			$$key=$value;
			//var_dump($$key);
		}
	}
	
	if(empty($_POST['time_begin'])){
		$time_begin='1011-00-01';
	}
	if(empty($_POST['time_end'])){
		$time_end='3999-12-01';
	}
	if(empty($_POST['indent_time_begin'])){
		$indent_time_begin='0000-00-00 00:00:00';
	}
	if(empty($_POST['indent_time_end'])){
		$indent_time_end='9999-12-31 23:59:59';
	}
	if(empty($_POST['cost_min'])){
		$cost_min=0;
	}
	if(empty($_POST['cost_max'])){
		$cost_max=99999;
	}
	
	$querysql = "SELECT count(*) 
	FROM  `indents` 
	WHERE  `time_begin` >=  '$time_begin'
	AND  `time_end` <=  '$time_end'
	AND  `room_num` ='$room_num'
	AND  `indent_id` ='$indent_id'
	AND  `indent_time` 
	BETWEEN  '$indent_time_begin' 
	AND  '$indent_time_end'
	AND  `indent_status` ='$indent_status'
	AND  `user_id` ='$user_id'
	AND  `cost` 
	BETWEEN $cost_min
	AND $cost_max 
	AND  `indent_type` ='$indent_type'
	; ";
	
	//var_dump($querysql);
	if(empty($indent_id)){
		$querysql=str_replace("`indent_id` ='$indent_id'
	AND","",$querysql);
	}
	if(empty($indent_status)){
		$querysql=str_replace("`indent_status` ='$indent_status'
	AND  ","",$querysql);
	}
	if(empty($user_id)){
		$querysql=str_replace("`user_id` ='$user_id'
	AND  ","",$querysql);
	}
	if(empty($indent_type)){
		$querysql=str_replace("AND  `indent_type` ='$indent_type'","",$querysql);
	}
	if(empty($room_num)){
		$querysql=str_replace("  `room_num` ='$room_num'
	AND","",$querysql);
	}
	
	//var_dump($querysql);

	if($query=mysql_query($querysql)){
		
		while($row=mysql_fetch_assoc($query)){
			$results=array("count"=>$row['count(*)']);
			die(JSON($results));
		}
	}else{
		die(JSON('432'));
	}
?>
