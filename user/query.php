<?php
	require_once('../connect.php');
	
	if((empty($_POST['user_phone']))&&(empty($_POST['user_id_num']))&&(empty($_POST['user_name']))){
		die(JSON('401'));

	}else{
		$sql_query="SELECT * FROM `users` WHERE ";
		foreach($_POST as $key => $value){
			if($key == 'page' || $key == 'num_page')
				continue;
			//$condition=$key;
			//$parameter = $value;
		$sql_query=$sql_query."`".$key."` = '".$value."' AND ";
		}
		$sql_query2=substr_replace($sql_query, "LIMIT $_POST[page],$_POST[num_page]", -4,-1);
	}

//var_dump($sql_query2);	
	
		 if($user_info=mysql_query($sql_query2)){
			 
			$results = array();
			
		 	while($row=mysql_fetch_assoc($user_info)){
				
				//var_dump($row);
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
					
					
					
					
				}
				
				if(empty($user_history)){
						
						$user_history="";
						
						// for ($i=3 ; $i<7 ; $i++){
						// echo "<br \>";
						// }
						// echo "null";
						// for($i=3 ; $i<7 ; $i++){
						// echo "<br \>";}
					}
				
				//var_dump($user_history);
				$row['user_history']=$user_history;
				array_push($results,$row);
				
			}
			
			if(empty($results)){
				
				die(JSON('402'));
				
			}else{
				
				$results['status']='200';
				die(json_encode($results));
				
			}
			
		}else{
			
			die(JSON('403'));
		}
?>
