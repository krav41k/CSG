<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = mysqli_connect($servername, $username, $password);
$data = mysqli_query($conn, "show databases;");
$check = false;
while ($row = mysqli_fetch_assoc($data)){
	if ($row['Database']=='dbgamelog'){
		$check=true;
	}
}
if(!$check){
	mysqli_query($conn, "CREATE DATABASE dbGameLog;");
}

mysqli_select_db($conn, "android-client-server");
//$data = mysqli_query($conn, "SELECT `name`,`nickname`,`score`,`answer`,`view`,`shadow`,`background` FROM `players`");
$data = mysqli_query($conn, "SELECT `round` FROM `game`");
$row = mysqli_fetch_assoc($data);
$round = $row['round'];
$data = mysqli_query($conn, "SELECT a.`Qdata`, a.`Adata` FROM `questions` AS a, `game` AS b WHERE a.`Qstage`=b.`Gstage` AND a.`Qnumber`=b.`Gnumber`;");
$row = mysqli_fetch_assoc($data);
$question = $row['Qdata'];
$answer = $row['Adata'];
$firsttable = 'players-'.$round.'';
$secondtable = 'gameInfo-'.$round.'';
mysqli_select_db($conn, "dbGameLog");
mysqli_query($conn, "CREATE TABLE `$firsttable` like `android-client-server`.`players`;");
mysqli_query($conn, "INSERT INTO `$firsttable` SELECT * FROM `android-client-server`.`players`;");
mysqli_query($conn, "CREATE TABLE `$secondtable` (question text, answer text);");
mysqli_query($conn, "INSERT INTO `$secondtable` SELECT a.`Qdata`, a.`Adata` FROM `android-client-server`.`questions` AS a, `android-client-server`.`game` AS b WHERE a.`Qstage`=b.`Gstage` AND a.`Qnumber`=b.`Gnumber`;");
?>