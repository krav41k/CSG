<?php
	if(isset($_POST)){
		$func = $_POST["func"];;
		$CONNECT = mysqli_connect('localhost','root','','android-client-server');
		$data = mysqli_query($CONNECT, "SELECT * FROM `questions` WHERE `Qstage`='$_POST[Qstage]' AND `Qnumber`='$_POST[Qnumber]'");
		$row = mysqli_fetch_assoc($data);
		if($row) {
			mysqli_query($CONNECT, "UPDATE `questions` SET `Qdata`='$_POST[Qdata]' WHERE `Qstage`='$_POST[Qstage]' AND `Qnumber`='$_POST[Qnumber]'");
			mysqli_query($CONNECT, "UPDATE `questions` SET `Adata`='$_POST[Adata]' WHERE `Qstage`='$_POST[Qstage]' AND `Qnumber`='$_POST[Qnumber]'");
			mysqli_query($CONNECT, "UPDATE `questions` SET `Qtype`='$_POST[Qtype]' WHERE `Qstage`='$_POST[Qstage]' AND `Qnumber`='$_POST[Qnumber]'");
			mysqli_query($CONNECT, "UPDATE `questions` SET `Atype`='$_POST[Atype]' WHERE `Qstage`='$_POST[Qstage]' AND `Qnumber`='$_POST[Qnumber]'");
		}else 
		mysqli_query($CONNECT, "INSERT INTO `questions` (`Qstage`,`Qnumber`,`Qtype`,`Qdata`,`Atype`,`Adata`,`status`) VALUES ('$_POST[Qstage]', '$_POST[Qnumber]','$_POST[Qtype]','$_POST[Qdata]','$_POST[Atype]','$_POST[Adata]','0')");
		mysqli_close($CONNECT);
	}
?>
