<?php
  $db = mysqli_connect('localhost','root','','android-client-server');
  $data = mysqli_query($db, "SELECT `time`,`status` FROM `game`");
  $row = mysqli_fetch_assoc($data);
  $time = $row['time'];
  $status = $row['status'];
  switch (true){
	  case $time > 600 && $time <= 700:
	  $data = mysqli_query($db, "SELECT `joker` FROM `game`");
	  $row = mysqli_fetch_assoc($data);
	  $joker = $row['joker'];
	  printf('
		<div id="joker%s">
		</div>
	  ',$joker);
	  if ($status == 1){
		if ($time != 601){
			$time = $time - 1;
			mysqli_query($db, "UPDATE `game` SET `time`=$time");
		}else
			mysqli_query($db, "UPDATE `game` SET `time`=0");
	  }
	  break;
	  
	  case ($time > 700 && $time <=800):
	  $data = mysqli_query($db, "SELECT `day`,`eventTime` FROM `game`");
	  $row = mysqli_fetch_assoc($data);
	  $day = $row['day'];
	  $eventTime = $row['eventTime'];
	  printf('
		<div id="day%s">
		</div>
	  ',$day);
	  if ($status == 1){
		if ($time != 701){
			$time = $time - 1;
			mysqli_query($db, "UPDATE `game` SET `time`=$time");
		}else
			mysqli_query($db, "UPDATE `game` SET `time`=$eventTime");
	  }
	  break;
	  
	  case $time >= 0 && $time <= 600:
		$data = mysqli_query($db, "SELECT `status`,`Qstatus`,`Gstage`,`Gnumber` FROM `game`");
		$row = mysqli_fetch_assoc($data);
		$Gstage=$row['Gstage'];
		$Gnumber=$row['Gnumber'];
		$Qstatus=$row['Qstatus'];
		$status=$row['status'];
		if($status == 2){
			echo "<div class='game-of-thornes'></div>";
		}else{
			if($Qstatus=='0'){
				$data = mysqli_query($db, "SELECT `Qdata` FROM `questions` WHERE `Qstage`=$Gstage and `Qnumber`=$Gnumber");
				$row = mysqli_fetch_assoc($data);
				$data = $row['Qdata'];
			}else{
				$data = mysqli_query($db, "SELECT `Adata` FROM `questions` WHERE `Qstage`=$Gstage and `Qnumber`=$Gnumber");
				$row = mysqli_fetch_assoc($data);
				$data = $row['Adata'];
			}
			switch (true){
				case (strlen($data)<=5):
						$size='xxl';
					break;				
				case (strlen($data)<=10 && strlen($data)>5):
					$size='xl';
				break;
				case (strlen($data)<=15 && strlen($data)>10):
					$size='l';
				break;
				case (strlen($data)<=20 && strlen($data)>15):
					$size='m';
				break;
				case (strlen($data)<=25 && strlen($data)>20):
					$size='s';
				break;
				case (strlen($data)>=25):
					$size='ss';
				break;
				
			}
			printf('
				<div class="mainEvent">
					<table class="time text-field"><tr><td>%s</td></tr></table>
				<div class="QA">
					<table class="QAtext text-field '.$size.'"><tr><td>%s</td></tr></table>
				</div>
				</div>
			',$time,$data);
			if($status=='1'){
				if($time!=0){
					$time=$time-1;
					mysqli_query($db, "UPDATE `game` SET `time`=$time");
				}
			}
		}
	  break;
	  case $time==999:
		$data = mysqli_query($db,"SELECT `rightA`,`firstPlayer`,`secondPlayer`,`firstScore`,`secondScore`,`firstA`,`secondA` FROM `duel`");
		$row = mysqli_fetch_assoc($data);
		$firstplayer=$row['firstPlayer'];
		$secondplayer=$row['secondPlayer'];
		$firstScore=$row['firstScore'];
		$secondScore=$row['secondScore'];
		$firstA=$row['firstA'];
		$secondA=$row['secondA'];
		$rightA=$row['rightA'];
		if ($rightA!=2){
			if ($rightA==$firstA){
				$firstPoint='win';
			}else $firstPoint='lose';
			
			if ($rightA==$secondA){
				$secondPoint='win';
			}else $secondPoint='lose';
			
		}else{
			$firstPoint='';
			$secondPoint='';
		}
		if ($firstA==0){
			$firstA='Hi';
		}else if($firstA==1){
			$firstA='Так';
		}else $firstA='-';
		if ($secondA==0){
			$secondA='Hi';
		}else if($secondA==1){
			$secondA='Так';
		}else $secondA='-';
		$data = mysqli_query($db,"SELECT `name` FROM `players` WHERE `id`=$firstplayer OR `id`=$secondplayer");
		$row = mysqli_fetch_array($data);
		$firstPlayer=$row['name'];
		$row = mysqli_fetch_array($data);
		$secondPlayer=$row['name'];
		printf("
		<div class='duel'>
			<div class='firstPlayer'>
				<div class='Signature'>
					%s : %s
				</div>
				<table class='answer text-field %s'><tr><td>%s</td></tr></table>
			</div>
			<div class='secondPlayer'>
				<div class='Signature'>
					%s : %s
				</div>
				<table class='answer text-field %s'><tr><td>%s</td></tr></table>
			</div>
		<div>",$firstPlayer,$firstScore,$firstPoint,$firstA,$secondPlayer,$secondScore,$secondPoint,$secondA);
	break;
	}
  mysqli_close($db); 
?>
