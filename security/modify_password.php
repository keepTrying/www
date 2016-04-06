<?php
// http://localhost/hotel/security/modify_password.php?user_id=3&password_new=323234
	require_once('../connect.php');
	
	if((empty($_POST['user_id']))||(empty($_POST['password_new']))){
		die(JSON('421'));

	}else{
		foreach($_POST as $key => $value){
			$$key = $value;
		}
	}
	
	$sql_query="SELECT * FROM users WHERE user_id = '$user_id' ; ";
	
		 if($user_info=mysql_query($sql_query)){
			
		 	while($row=mysql_fetch_assoc($user_info)){
				
				mysql_query("UPDATE  `hotel`.`users` SET  `user_password` =  '$password_new' WHERE  `users`.`user_id` ='$user_id'; ");
				die(JSON('200'));

	
			}
			
		}else{
			
				die(JSON('401'));

		}
?>