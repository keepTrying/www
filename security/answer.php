<?php
// http://localhost/hotel/security/answer.php?user_id=8&user_ans=你猜！
	require_once('../connect.php');
	
	if((empty($_POST['user_ans']))||(empty($_POST['user_id']))){
		die(JSON('401'));
	}else{
		foreach($_POST as $key => $value){
			$$key = $value;
		}
	}
	
	$sql_query="SELECT * FROM users WHERE user_id = '$user_id' ; ";
	
		 if($user_info=mysql_query($sql_query)){
			
		 	while($row=mysql_fetch_assoc($user_info)){
				//var_dump($user_ans);
				//var_dump($row['user_ans']);
				if($user_ans==$row['user_ans']){
					die(JSON('200'));
					
				}else{
					
						die(JSON('422'));

					
				}
				
			}
			
		}else{
			
			die(JSON('423'));
		}
?>
