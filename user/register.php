<?php
// http://localhost/hotel/user/register.php?user_nick=测试&user_type=1&user_gender=1&user_years=15&user_email=test@example.com&user_password=fdfddfeefddfe&user_phone=123456&user_id_num=323234323&user_name=王尼玛&user_que=你是猪么？&user_ans=你猜！
	require_once('../connect.php');
	//var_dump($_POST);
	if(!isset($_POST['user_nick'])){
		die(JSON('411'));
	}
	if(!isset($_POST['user_gender'])){
		die(JSON('412'));
	}
	if(!isset($_POST['user_years'])){
		die(JSON('413'));
	}
	if(!isset($_POST['user_email'])){
		die(JSON('414'));
	}
	if(!isset($_POST['user_phone'])){
		die(JSON('415'));
	}
	if(!isset($_POST['user_id_num'])){
		die(JSON('416'));
	}
	if(!isset($_POST['user_name'])){
		die(JSON('417'));
	}
	if(!isset($_POST['user_que'])){
		die(JSON('418'));
	}
	if(!isset($_POST['user_ans'])){
		die(JSON('419'));
	}
	if(!isset($_POST['user_password'])){
		die(JSON('420'));
	}
	foreach($_POST as $key => $value){
		$$key = $value; 
		// echo $key ."=>".$value. "<br \>";
	}
	
	$user_time = date('y-m-d h:i:s');
	$user_point = 0 ;
	
	
	$insertsql = "INSERT INTO `hotel`.`users` (`user_id`, `user_nick`, `user_type`, `user_gender`, `user_years`, `user_email`, `user_time`, `user_password`, `user_point`, `user_phone`, `user_id_num`, `user_name`, `user_que`, `user_ans`) VALUES (NULL, '$user_nick', '$user_type', '$user_gender', '$user_years', '$user_email', '$user_time', '$user_password', '$user_point', '$user_phone', '$user_id_num', '$user_name', '$user_que', '$user_ans') ";
	// $insertsql = "INSERT INTO `hotel`.`users` (`user_id`, `user_nick`, `user_type`, `user_gender`, `user_years`, `user_email`, `user_time`, `user_password`, `user_point`, `user_phone`, `user_id_num`, `user_name`, `user_que`, `user_ans`) VALUES (NULL, '呵呵', '1', '1', '21', 'exameple@company.com', '2016-02-25 07:16:14', '1343434jj43rf', '', '', '', '猪八戒', '你是猪么？', '你猜！！！'); ";
	if(mysql_query($insertsql)){
		// echo "insert succeful";
		die(JSON('200'));
	}else{
		// echo "insert fail";
		// echo "<br>";
		// echo mysql_error();
		die(JSON('421'));
	}
?>
