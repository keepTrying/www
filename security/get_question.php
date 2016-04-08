<?php
// http://localhost/hotel/security/get_question.php?user_phone=123456&user_id_num=323234323&user_name=王尼玛
	require_once('../connect.php');
	
	if((empty($_POST['user_name']))||(empty($_POST['user_id_num']))||(empty($_POST['user_phone']))){
		die(JSON('421'));
	}else{
		foreach($_POST as $key => $value){
			$$key = $value;
		}
	}
	
	$sql_query="SELECT * FROM users WHERE user_id_num = '$user_id_num' ; ";
	
		 if($user_info=mysql_query($sql_query)){
			
		 	while($row=mysql_fetch_assoc($user_info)){
				$result = array("user_que"=>$row['user_que'],"user_id"=>$row['user_id']);
				$results['status']='200';
				die(json_encode($results));	
			}
			
		}else{
			
				die(JSON('401'));

		}
?>
