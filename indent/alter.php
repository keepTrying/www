<?php
// http://localhost/hotel/indent/alter.php?time_begin=2016-02-25&time_end=2016-02-26&pay=1&room_num=010001&indent_status=2&user_id=0001&cost=1000&indent_type=2&indent_id=2
	require_once('../connect.php');
	//var_dump($_POST);
	if(empty($_POST['time_begin'])){
		die(JSON('411'));
	}
	if(empty($_POST['time_end'])){
		die(JSON('412'));
	}
	if(!isset($_POST['room_num'])){
		die(JSON('414'));
	}
	if(!isset($_POST['indent_status'])){
		die(JSON('415'));
	}
	if(!isset($_POST['user_id'])){
		die(JSON('416'));
	}
	if(!isset($_POST['cost'])){
		die(JSON('417'));
	}
	if(!isset($_POST['indent_type'])){
		die(JSON('418'));
	}
	if(!isset($_POST['indent_id'])){
		die(JSON('419'));
	}
	$sql_query = "UPDATE `hotel`.`indents` SET ";
	foreach($_POST as $key => $value){
			
		$sql_query=$sql_query."`".$key."` = '".$value."', ";
	}
	$indent_id=$_POST['indent_id'];
	$sql_query2=substr_replace($sql_query, "WHERE `indents`.`indent_id`='$indent_id';", -2,-1);
	
	echo $sql_query2;
	//$altersql = "UPDATE `hotel`.`indents` SET `time_begin`='$time_begin', `time_end`='$time_end', `room_num`='$room_num', `indent_status`='$indent_status', `user_id`='$user_id', `cost`='$cost', `indent_type`='$indent_type' WHERE `indents`.`indent_id`='$indent_id'; ";
	
	if(mysql_query($sql_query2)){
		// echo "alter succeful";
		die(JSON('200'));
	}else{
		// echo "alter fail";
		// echo "<br>";
		// echo mysql_error();
		die(JSON('420'));
	}
?>
