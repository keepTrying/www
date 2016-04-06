<?php
	require_once('../connect.php');
	
	if((empty($_POST['user_phone']))&&(empty($_POST['user_id']))&&(empty($_POST['user_id_num']))&&(empty($_POST['user_name']))){
		die(JSON('401'));

	}else{
		$sql_query="SELECT count(*) FROM users WHERE ";
		foreach($_POST as $key => $value){
			//$condition=$key;
			//$parameter = $value;
		$sql_query=$sql_query."'".$key."' ='".$value."' AND ";
		}
		$sql_query=substr_replace($sql_query, ";", -1,-4);
	}
	
	
	
		 if($user_info=mysql_query($sql_query)){
			
		 	while($row=mysql_fetch_assoc($user_info)){
				$result = array('count' =>$row['count(*)']);
				die(JSON($result));	
			}
			
		}else{
			
			die(JSON('401'));
		}
?>
