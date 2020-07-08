<?php
	if(isset($_POST)){
		$func = $_POST["func"];
		$id = $_POST["id"];
		$CONNECT = mysqli_connect('localhost','root','','android-client-server');
		switch ($func){
			case add:
				$data = mysqli_query($CONNECT, "SELECT * FROM `players` WHERE `id`='$id'");
				$row = mysqli_fetch_assoc($data);
				$score = 1 + $row['score'];
				mysqli_query($CONNECT, "UPDATE `players` SET `score`='$score' WHERE `id`=$id");
				mysql_query("INSERT INTO `question` (`Qstage`,`Qnumber`,`Qtype`,`Qdata`,`Atype`,`Adata`) VALUES ('1','2','text','Earth','round','text')");
				break;
			case remove:
				$data = mysqli_query($CONNECT, "SELECT * FROM `players` WHERE `id`='$id'");
				$row = mysqli_fetch_assoc($data);
				$score =$row['score']-1;
				if($score >= 0) mysqli_query($CONNECT, "UPDATE `players` SET `score`='$score' WHERE `id`=$id");
				break;
			case view:
				$data = mysqli_query($CONNECT, "SELECT * FROM `players` WHERE `id`='$id'");
				$row = mysqli_fetch_assoc($data);
				if($row[view] == 1) mysqli_query($CONNECT, "UPDATE `players` SET `view`='0' WHERE `id`='$id'");
				else mysqli_query($CONNECT, "UPDATE `players` SET `view`='1' WHERE `id`='$id'");
				$password = rand(1000,9999);
				mysqli_query($CONNECT, "UPDATE `players` SET `password`='$password' WHERE `id`=$id");
				break;
			case name:
				$id = substr($_POST[id],-1);
				if($id == 0) $id = 10;
				mysqli_query($CONNECT, "UPDATE `players` SET `name`='$_POST[data]' WHERE `id`=$id");
				break;
			case nickname:
				$id = substr($_POST[id],-1);
				if($id == 0) $id = 10;
				mysqli_query($CONNECT, "UPDATE `players` SET `nickname`='$_POST[data]' WHERE `id`=$id");
				break;
			case clear:
				for ($key=1; $key<=10;$key++){
					mysqli_query($CONNECT, "UPDATE `players` SET `answer`=' ' WHERE `id`=$key");
				}
				break;
			case rmk:
				for ($key=1; $key<=10;$key++){
					$player = "player".$key;
					$password = rand(1000,9999);
					$shadow = "red";
					mysqli_query($CONNECT, "UPDATE `players` SET `answer`=' ' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `name`='$player' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `score`='0' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `view`='0' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `password`='$password' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `shadow`='$shadow' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `nickname`=' ' WHERE `id`=$key");
					mysqli_query($CONNECT, "UPDATE `players` SET `background`=$key WHERE `id`=$key");
					}
				break;
			case response:
				$id = substr($_POST[id],-1);
				if($id == 0) $id = 10;
				$row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT * FROM `players` WHERE `id`=$id"));
				if($_POST[password] == $row[password]){
					mysqli_query($CONNECT, "UPDATE `players` SET `floatName`='$_POST[name]' WHERE `id`=$id");
					mysqli_query($CONNECT, "UPDATE `players` SET `answer`='$_POST[answer]' WHERE `id`=$id");
				}
				break;
			case shadow:
				$id = substr($_POST[id],-1);
				if($id == 0) $id = 10;
				mysqli_query($CONNECT, "UPDATE `players` SET `shadow`='$_POST[data]' WHERE `id`=$id");
				break;
			case background:
				$id = substr($_POST['id'],-1);
				if($id == 0) $id = 10;
				mysqli_query($CONNECT, "UPDATE `players` SET `background`='$_POST[data]' WHERE `id`=$id");
				break;
			case uploadNames:
				mysqli_query($CONNECT, "UPDATE `players` SET `name`=`floatName` WHERE `floatName`<>''");
				break;
			case changeOrientation:
				$data = mysqli_query($CONNECT, "SELECT `orientation` FROM `game`");
				$row = mysqli_fetch_assoc($data);
				$orientation = $row['orientation'];
				if ($orientation == 1){
					mysqli_query($CONNECT,"UPDATE `game` SET `orientation`=0");
				}else if ($orientation == 0){ 
					mysqli_query($CONNECT,"UPDATE `game` SET `orientation`=1");
				}
				break;
		}
		mysqli_close($CONNECT);
	}
?>
