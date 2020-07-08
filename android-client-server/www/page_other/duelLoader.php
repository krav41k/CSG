<?php
	if(isset($_POST)){
		$id = substr($_POST['id'],-1);
		if($id == 0) $id = 10;
		$password = $_POST['password'];
		$CONNECT = mysqli_connect('localhost','root','','android-client-server');
		$data = mysqli_query($CONNECT, "SELECT `id`,`password` FROM `players` WHERE `view`=2");
		if($data){
		$row = mysqli_fetch_assoc($data);
		$firstplayer=$row['id'];
		$firstpassword=$row['password'];
		$row = mysqli_fetch_assoc($data);
		$secondplayer=$row['id'];
		$secondpassword=$row['password'];
		}
		if ($id == $firstplayer){
			if ($firstpassword==$password){
				print('
					<div class="duelBlock">
					<input type="button" onclick=choose("1","firstA") class="static-object width-object" value="TRUE">
					<input type="button" onclick=choose("0","firstA") class="static-object width-object" value="FALSE">
					<div>
				');
			}
		}else if ($id == $secondplayer){
			if ($secondpassword==$password){
				print('
					<div class="duelBlock">
					<input type="button" onclick=choose("1","secondA") class="static-object width-object" value="TRUE">
					<input type="button" onclick=choose("0","secondA") class="static-object width-object" value="FALSE">
					<div>
				');
			}
		}
		mysqli_close($CONNECT);
	}
?>