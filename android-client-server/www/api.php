<?php

function Error($p1, $p2){
	exit('("error:"'.$p1.'", text: "'.$p2.'"")');
}

if ($Module =='users'){
	if(!$Param['id']) Error(1, 'Не указан id');
	if(!$Param['param']) Error(2, 'Не указан параметр');
	$Array = array('score','name','answer','view');
	
	$Exp = explode('.', $Param['param']);
	foreach($Exp as $key) if ($Param != 'all' and !in_array($key, $Array)) Error(3, 'Параметр указан не верно');
	
	if ($Param == 'all') $Select = $Array;
	else $Select = $Exp;
	
	foreach($Select as $key) $SQL .="`$key`,";
	$SQL = substr($SQL, 0, -1);
	
	
	$CONNECT = mysqli_connect('localhost','root','','android-client-server');

	echo json_encode(mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT $SQL FROM `users` WHERE `id` = '$Param[id]'")));
	
	mysqli_close($CONNECT);
	

}else if($Module == 'execute'){
	if(!$Param['id']) Error(1, 'Не указан id');
	if(!$Param['func']) Error(2, 'Не указана функция');
	$Array = array('add','remove','name','answer','view','rmk','clear');
		
	if ($Param !='all' and !in_array($Param['func'], $Array)) Error(4, 'Функция указана не верно');
		
	$CONNECT = mysqli_connect('localhost','root','','android-client-server');
	
	if($Param['func'] == 'add'){
		$data = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id`='$Param[id]'");
		if (mysqli_num_rows($data)){
			$row = mysqli_fetch_assoc($data);
			$score = 1 + $row['score'];
			mysqli_query($CONNECT, "UPDATE `users` SET `score`='$score' WHERE `id`=$Param[id]");
			echo 'оно выполнилось';
		}
	}
	if($Param['func'] == 'remove'){
		$data = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id`='$Param[id]'");
		if (mysqli_num_rows($data)){
			$row = mysqli_fetch_assoc($data);
			$score =$row['score']-1;
			if($score >= 0) mysqli_query($CONNECT, "UPDATE `users` SET `score`='$score' WHERE `id`=$Param[id]");
			echo 'оно выполнилось';
		}
	}
	if($Param['func'] == 'name'){
		$Param['name'] = urlencode($Param['name']);
		echo urldecode(urldecode($Param['name']));
		
		mysqli_query($CONNECT, "UPDATE `users` SET `name`='$Param[name]' WHERE `id`=$Param[id]");
	}
	if($Param['func'] == 'answer'){
		$Param['answer'] = urldecode($Param['answer']);
		echo urldecode($Param['answer']);
		mysqli_query($CONNECT, "UPDATE `users` SET `answer`='$Param[answer]' WHERE `id`=$Param[id]");
	}
	if($Param['func'] == 'view'){
		$data = mysqli_query($CONNECT, "SELECT * FROM `users` WHERE `id`='$Param[id]'");
		if (mysqli_num_rows($data)){
			$row = mysqli_fetch_assoc($data);
			if($row[view] == 1) mysqli_query($CONNECT, "UPDATE `users` SET `view`='0' WHERE `id`=$Param[id]");
			else mysqli_query($CONNECT, "UPDATE `users` SET `view`='1' WHERE `id`=$Param[id]");
			echo 'оно выполнилось';
		}
	}
	if($Param['func'] == 'clear'){
		for ($key=1; $key<10;$key++){
			mysqli_query($CONNECT, "UPDATE `users` SET `answer`=' ' WHERE `id`=$key");
		}
		echo "готово";
	}
	if($Param['func'] == 'rmk'){
		for ($key=1; $key<=10;$key++){
			$player = "player".$key;
			$password = rand(1000,9999);
			mysqli_query($CONNECT, "UPDATE `users` SET `answer`=' ' WHERE `id`=$key");
			mysqli_query($CONNECT, "UPDATE `users` SET `name`='$player' WHERE `id`=$key");
			mysqli_query($CONNECT, "UPDATE `users` SET `score`='0' WHERE `id`=$key");
			mysqli_query($CONNECT, "UPDATE `users` SET `view`='0' WHERE `id`=$key");
			mysqli_query($CONNECT, "UPDATE `users` SET `password`='$password' WHERE `id`=$key");
		}
		echo "complite";
	}
	mysqli_close($CONNECT);
		
}else Error(0, "Не указан метод");
?>