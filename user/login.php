<?php
	require_once('../connect.php');
	try{

		if (isset($_POST['action'])) {
			if ($_POST['action']==='logout') {
				session_destroy();
				die(JSON('200'));
			}
		}

		if(isset($_POST['user_password'])){
			$user_password = $_POST['user_password'];
		}else{
			// echo "no password";
			die(JSON('401'));
		}
		if(isset($_POST['user_phone'])){
			$user_phone = $_POST['user_phone'];
		}else{
			// echo "no phone number";
			die(JSON('401'));
		}
		// echo $user_phone;
		// echo "<br />";
		// echo $user_password;
		
		 $sql_query="SELECT * FROM users WHERE user_phone=$user_phone";
		 if($user_info=mysql_query($sql_query)){
		 	$row=mysql_fetch_assoc($user_info);
			if($row['user_password']==$user_password){
				unset($row['user_password'],$row['user_ans'],$row['user_que']);
				$user_id=$row['user_id'];
				$sql_indents="SELECT time_begin,time_end,room_num FROM indents WHERE user_id = $user_id ";
				if($user_history=mysql_query($sql_indents)){
					$temp=array();
					while ($row2=mysql_fetch_assoc($user_history)) {
						//var_dump($row2);
						array_push($temp, $row2);
				}
					$user_history=$temp;
				}else{
					$user_history="";
				}
				//var_dump($user_history);
				$row['user_history']=$user_history;

				if (isset($_POST['action'])) {
					if ($_POST['action']==='login') {
						// session_start();
						$_SESSION['user']=$row;
						die(JSON('200'));
					}
				}else
					die (JSON($row));

			}else{
				// echo $row['user_password'];
				die(JSON('402'));
			}
		}else{
			die(JSON('403'));
		}
	}catch (Exception $e) {
		print $e->getMessage();

	} 
?>
