<?php
http://localhost/hotel/room/query.php?room_num=&room_type=&room_area_min=20.00&room_area_max=999.00&room_cost_min=9&room_cost_max=999
	require_once('../connect.php');
	
	if(empty($_POST['room_num'])&&empty($_POST['room_type'])&&empty($_POST['room_area'])&&empty($_POST['room_cost_max'])&&empty($_POST['room_cost_min'])){
		
		die(JSON('431'));
	}else{
		foreach($_POST as $key => $value){
			$$key=$value;
			//var_dump($$key);
		}
	}
	
	if(empty($_POST['room_area_min'])){
		$room_area_min=0;
	}
	if(empty($_POST['room_area_max'])){
		$room_area_max=9999;
	}
	if(empty($_POST['room_cost_min'])){
		$room_cost_min=0;
	}
	if(empty($_POST['room_cost_max'])){
		$room_cost_max=9999;
	}
	
	$querysql = "SELECT * 
	FROM  `rooms` 
	WHERE  `room_num` ='$room_num'
	AND  `room_type` ='$room_type'
	AND  `room_area`
	BETWEEN $room_area_min 
	AND $room_area_max
	AND  `room_cost`
	BETWEEN $room_cost_min 
	AND  $room_cost_max 
	LIMIT $_POST[page],$_POST[num_page]
	; ";
	//var_dump($querysql);
	if(empty($room_num)){
		$querysql=str_replace("`room_num` ='$room_num'
	AND  ","",$querysql);
	}
	if(empty($room_type)){
		$querysql=str_replace("`room_type` ='$room_type'
	AND  ","",$querysql);
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
			die(json_encode($results));
		}else{
			die(JSON('432'));
		}
		
	}else{
		die(JSON('433'));
	}
?>
