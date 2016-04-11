<?php
// http://localhost/hotel/user/alter.php?user_nick=测试21&user_gender=1&user_years=11&user_email=test@example.com&user_phone=123456&user_id_num=13121415&user_name=王尼玛
	require_once('../connect.php');
	//var_dump($_POST);
	if(empty($_POST['user_nick'])){
		die(JSON('411'));
	}
	if(empty($_POST['user_gender'])){
		die(JSON('412'));
	}
	if(empty($_POST['user_years'])){
		die(JSON('413'));
	}
	if(empty($_POST['user_email'])){
		die(JSON('414'));
	}
	if(empty($_POST['user_phone'])){
		die(JSON('415'));
	}
	if(empty($_POST['user_id_num'])){
		die(JSON('416'));
	}
	if(empty($_POST['user_name'])){
		die(JSON('417'));
	}
	if(empty($_POST['user_point'])){
		die(JSON('418'));
	}
	
	foreach($_POST as $key => $value){
		$$key = $value; 
		// echo $key ."=>".$value. "<br \>";
	}
	
	
	$altersql = "UPDATE  `hotel`.`users` SET `user_nick` = '$user_nick', `user_gender` = '$user_gender', `user_years` = '$user_years', `user_email` = '$user_email', `user_phone` = '$user_phone',`user_id_num` = '$user_id_num',  `user_name` = '$user_name' ,`user_img` = '$user_img' ,`user_point`='$user_point' WHERE `users`.`user_id_num` = '$user_id_num'; ";

	if(mysql_query($altersql)){
		// echo "alter succeful";
		die(JSON('200'));
	}else{
		// echo "alter fail";
		// echo "<br>";
		// echo mysql_error();
		die(JSON('419'));

	}
?>
