<?php
	if(isset($_POST)){
		$func = $_POST["func"];
		$data = $_POST["data"];
		$null = "0";
		$CONNECT = mysqli_connect('localhost','root','','android-client-server');
		switch ($func){
			case eventTime:
				mysqli_query($CONNECT, "UPDATE `game` SET `eventTime`=$data");
				break;
			case setday:
				mysqli_query($CONNECT, "UPDATE `game` SET `day`=$data");
				break;
			case playjoker:
				mysqli_query($CONNECT, "UPDATE `game` SET `joker`=$data");
				mysqli_query($CONNECT, "UPDATE `game` SET `time`=606");
				mysqli_query($CONNECT, "UPDATE `game` SET `status`=1");
				break;
			case changeStage:
				$DBdata = mysqli_query($CONNECT, "SELECT `Qstage` FROM `game`");
				$row = mysqli_fetch_assoc($DBdata);
				$stage = $row['Qstage'];
				switch ($data){
					case add:
						if ($stage<'9'){
						$stage=$stage+'1';
						mysqli_query($CONNECT, "UPDATE `game` SET `Qstage`=$stage");
						}break;
					case remove:
						if ($stage>'1'){
						$stage=$stage-'1';
						mysqli_query($CONNECT, "UPDATE `game` SET `Qstage`=$stage");
						}break;
					case zero:
						mysqli_query($CONNECT, "UPDATE `game` SET `Qstage`='0'");
						break;
				}
				break;
			case changeQuestion:
				mysqli_query($CONNECT, "UPDATE `game` SET `Qnumber`=$data");
				break;
			case setStatus:
				$data = mysqli_query($CONNECT, "SELECT `status` FROM `game`");
				$row = mysqli_fetch_assoc($data);
				$status = $row['status'];
				if ($status == 0){
					$status = 1;
				}else
					$status=0;
				mysqli_query($CONNECT, "UPDATE `game` SET `status`=$status");
				break;
			case nextQ:
				mysqli_query($CONNECT, "UPDATE `game` SET `time`='706'");
				mysqli_query($CONNECT, "UPDATE `game` SET `Qstatus`=0");
				mysqli_query($CONNECT, "UPDATE `game` SET `status`=1");
				mysqli_query($CONNECT, "UPDATE `game` SET `Gnumber`=Qnumber");
				mysqli_query($CONNECT, "UPDATE `game` SET `Gstage`=Qstage");
				mysqli_query($CONNECT, "UPDATE `players` SET `answer`=''");
				$data= mysqli_query($CONNECT, "UPDATE `game` SET round = 1 + round;");
				break;
			case showA;
				mysqli_query($CONNECT, "UPDATE `game` SET `Qstatus`=1");
				mysqli_query($CONNECT, "UPDATE `game` SET `status`=1");
				mysqli_query($CONNECT, "UPDATE `game` SET `eventTime`=60");
				mysqli_query($CONNECT, "UPDATE `game` SET `time`=0");
				mysqli_query($CONNECT, "UPDATE `questions` AS q, `game` AS g SET q.status=1 WHERE q.Qnumber=g.Gnumber AND q.Qstage=g.Gstage");
				include '../sql-control/logControl.php';
				break;
			case startDuel:
				$firstplayer = substr($_POST["data"],-1);
				if($firstplayer == 0) $firstplayer = 10;				
				$secondplayer = substr($_POST["data2"],-1);
				if($secondplayer == 0) $secondplayer = 10;
				mysqli_query($CONNECT, "UPDATE `duel` SET `firstplayer`=$firstplayer");
				mysqli_query($CONNECT, "UPDATE `duel` SET `secondplayer`=$secondplayer");
				mysqli_query($CONNECT, "UPDATE `players` SET `view`=2 WHERE `id`=$firstplayer OR `id`=$secondplayer");
				mysqli_query($CONNECT, "UPDATE `game` SET `time`=999");
				break;			
			case stopDuel:
				mysqli_query($CONNECT, "UPDATE `duel` SET `firstScore`=0");
				mysqli_query($CONNECT, "UPDATE `duel` SET `secondScore`=0");
				mysqli_query($CONNECT, "UPDATE `duel` SET `firstA`=2");
				mysqli_query($CONNECT, "UPDATE `duel` SET `secondA`=2");
				mysqli_query($CONNECT, "UPDATE `game` SET `time`=0");
				mysqli_query($CONNECT, "UPDATE `players` SET `view`=0 WHERE `view`=2");
				break;
			case giveA:
				$dbData = mysqli_query($CONNECT, "SELECT `time` FROM `game`");
				$row = mysqli_fetch_assoc($dbData);
				$time=$row['time'];
				if($time==999){
					switch ($data){
						case '1':
							$data=2;
							break;
						case '2':
							$data=1;
							break;
					}
					mysqli_query($CONNECT, "UPDATE `duel` SET `rightA`=$data");
					if($data!=2){
						$select=mysqli_query($CONNECT, "SELECT `firstA`,`secondA`,`firstScore`,`secondScore` FROM `duel`");
						$row=mysqli_fetch_assoc($select);
						$firstA=$row['firstA'];
						$secondA=$row['secondA'];
						if($firstA==$data){
							$score=$row['firstScore'];
							$score=$score+1;
							mysqli_query($CONNECT, "UPDATE `duel` SET `firstScore`=$score");
						}
						if($secondA==$data){
							$score=$row['secondScore'];
							$score=$score+1;
							mysqli_query($CONNECT, "UPDATE `duel` SET `secondScore`=$score");
						}
					}else{
						mysqli_query($CONNECT, "UPDATE `duel` SET `firstA`=2");
						mysqli_query($CONNECT, "UPDATE `duel` SET `secondA`=2");
					}
				}
				break;
		}
		mysqli_close($CONNECT);
	}
?>
