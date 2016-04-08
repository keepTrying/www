<?php
http://localhost/hotel/indent/query.php?time_begin=2016-02-25&time_end=2016-02-26&pay=1&room_num=010001&indent_status=2&user_id=0001&cost_min=10&cost_max=999&indent_type=2&indent_id=2
	require_once('../connect.php');
	
	if(empty($_POST['time_begin'])&&empty($_POST['time_end'])&&empty($_POST['pay'])&&empty($_POST['cost_max'])&&empty($_POST['cost_min'])&&empty($_POST['indent_time_begin'])&&empty($_POST['indent_time_end'])&&empty($_POST['room_num'])&&empty($_POST['indent_id'])&&empty($_POST['indent_status'])&&empty($_POST['user_id'])&&empty($_POST['indent_type'])){
		
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
	
	$querysql = "SELECT * 
	FROM  `indents` 
	WHERE  `time_begin` >=  '$time_begin'
	AND  `time_end` <=  '$time_end'
	AND  `pay` ='$pay'
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
	LIMIT $_POST[page],$_POST[num_page]
	; ";
	
	//var_dump($querysql);
	if(empty($pay)){
		$querysql=str_replace("  `pay` ='$pay'
	AND","",$querysql);
	}
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
		$results=array();
		while($row=mysql_fetch_assoc($query)){
			//var_dump($row);
			array_push($results,$row);
		}
		//var_dump($results);
		if(!empty($results)){
			$results['status']='200';
			die(json_encode($results));
		}else{
			die(JSON('433'));
		}
		
	}else{
		die(JSON('432'));
	}
?>
