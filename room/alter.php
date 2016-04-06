<?php
http://localhost/hotel/room/alter.php?room_num=011001&room_type=1&room_area=120.00&room_cost=999&room_img=http://img
	require_once('../connect.php');
	
	if(empty($_POST['room_num'])||empty($_POST['room_type'])||empty($_POST['room_area'])||empty($_POST['room_cost'])||empty($_POST['room_img'])){
		
		die(JSON('431'));
	}else{
		foreach($_POST as $key => $value){
			$$key=$value;
			//var_dump($$key);
		}
	}
	
	
	$altersql = "UPDATE  `hotel`.`rooms` SET `room_type` = '$room_type', `room_area` = '$room_area', `room_cost` = '$room_cost', `room_img` = '$room_img' WHERE `rooms`.`room_num` = '$room_num'; ";

	if(mysql_query($altersql)){
		// echo "alter succeful";
		die(JSON('200'));
	}else{
		die(JSON('432'));

	}
?>
