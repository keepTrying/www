<?php
// http://localhost/hotel/indent/order.php?time_begin=2016-02-25&time_end=2016-02-26&room_num=010001&user_id=0001&cost=1000&indent_type=1
	require_once('../connect.php');
	//var_dump($_POST);
	if(empty($_POST['time_begin'])){
		die(JSON('411'));
	}
	if(empty($_POST['time_end'])){
		die(JSON('412'));
	}
	if(empty($_POST['room_num'])){
		die(JSON('413'));
	}
	if(empty($_POST['user_id'])){
		die(JSON('414'));
	}
	if(empty($_POST['cost'])){
		die(JSON('415'));
	}
	if(empty($_POST['indent_type'])){
		die(JSON('416'));
	}
	
	foreach($_POST as $key => $value){
		$$key = $value; 
		// echo $key ."=>".$value. "<br \>";
	}
	
	$indent_time = date('y-m-d h:i:s');
	
	
	$insertsql = "INSERT INTO `hotel`.`indents` (`time_begin`, `time_end`, `room_num`, `indent_time`, `user_id`, `cost`, `indent_type`) VALUES ('$time_begin', '$time_end', '$room_num', '$indent_time', '$user_id', '$cost', '$indent_type') ";
	
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
