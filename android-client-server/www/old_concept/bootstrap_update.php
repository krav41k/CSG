<?php
$CONNECT = mysqli_connect('localhost','root','','android-client-server');
$data = mysqli_query($CONNECT, "SELECT * FROM `users`");
if(mysqli_num_rows($data)){
	while ($row = mysqli_fetch_assoc($data)) {
		if($row[view] == 1){
		printf('
			<div id="player'.$row[id].'" class="kick player">
				<div class="roflanname">%s</div>
				<div class="score">%s</div>
				<div class="answer">%s</div>
			</div>
			',$row["name"],$row["score"], $row["answer"]);
		}else printf('
			<div id="player'.$row[id].'" class="col-xs col-sm col-md col-lg col-xl">
				<div class="roflanname">%s</div>
				<div class="score">%s</div>
				<div class="answer">%s</div>
			</div>
			',$row["name"],$row["score"], $row["answer"]);
	}
}
mysqli_close($CONNECT);
?>
