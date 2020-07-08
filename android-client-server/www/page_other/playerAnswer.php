<?php
	$CONNECT = mysqli_connect('localhost','root','','android-client-server');
	$answer=$_POST["answer"];
	$player=$_POST["player"];
	mysqli_query($CONNECT, "UPDATE `duel` SET `$player`=$answer");
	mysqli_close($CONNECT);
?>

