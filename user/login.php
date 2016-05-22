<?php
	require_once('../connect.php');
	require_once('../JPush/JPush.php');
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
			die(JSON('402'));
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
				unset($row['user_ans'],$row['user_que']);
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
					}

				}else{
					//TODO  android PUSH
					$client = new JPush('376ef5633c2c8b564f5cb188', '1f896b4b972267e162d22095');
					$push = $client->push();
					$push->setPlatform('all');
					$push->addAllAudience();
					$array=array($_POST['tag']);
					$client->addTag($array);
					$push->setNotificationAlert('亲爱的顾客，为庆祝本酒店成立5周年，即日起至6月15日预定房间，享受8.8折优惠！');
					$push->send();
					$sql="SELECT * FROM indents WHERE user_id=$user_id";
					if ($indents=mysql_query($sql)) {
						while($row3=mysql_fetch_assoc($indents)){
							switch ($row3['indent_status']) {
							case '2':
								# payed
							$push->setNotificationAlert('亲爱的顾客,您预定的'.$row3['room_num'].'号房间，将于'.$row3['time_begin'].'可以入住，不要错过哦！')->send();
								break;
							case '6':
								# lived
								$time=time();
								$now=date("y-m-d",$time);
							if (diffBetweenTwoDays($row3['time_end'],$now)<=5) {
								$push->setNotificationAlert('亲爱的顾客,您入住的'.$row3['room_num'].'号房间，将于'.$row3['time_begin'].'到期，如需要继续享受我们的服务，请及时续费！')->send();
								break;
							}

							default:
								break;
							}
						}
					}
					

				}
                
				die (JSON($row));

			}else{
				// echo $row['user_password'];
				die(JSON('404'));
			}
		}else{
			die(JSON('403'));
		}
	}catch (Exception $e) {
		print $e->getMessage();

	}

	/**
	 * 求两个日期之间相差的天数
	 * (针对1970年1月1日之后，求之前可以采用泰勒公式)
	 * @param string $day1
	 * @param string $day2
	 * @return number
	 */
	function diffBetweenTwoDays ($day1, $day2)
	{
	  $second1 = strtotime($day1);
	  $second2 = strtotime($day2);
	    
	  if ($second1 < $second2) {
	    $tmp = $second2;
	    $second2 = $second1;
	    $second1 = $tmp;
	  }
	  return ($second1 - $second2) / 86400;
	} 
?>
