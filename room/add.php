<?php
http://localhost/hotel/room/add.php?room_num=011001&room_type=1&room_area=120.00&room_cost=999&room_img=http://img
	require_once('../connect.php');
	
	if(empty($_POST['room_num'])||empty($_POST['room_type'])||empty($_POST['room_area'])||empty($_POST['room_cost'])||empty($_POST['room_img'])){
		
		die(JSON('431'));
	}else{
		foreach($_POST as $key => $value){
			$$key=$value;
			//var_dump($$key);
		}
	}
	$insert_sql="INSERT INTO  `hotel`.`rooms` (
	`room_num` ,
	`room_type` ,
	`room_area` ,
	`room_cost` ,
	`room_img`
	)
	VALUES (
	'$room_num',  '$room_type',  '$room_area',  '$room_cost',  '$room_img'
	); ";

	if(mysql_query($insert_sql)){
		die(JSON('200'));
	}else{
		die(JSON('432'));

	}
	
?>
