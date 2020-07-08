<?php
$CONNECT = mysqli_connect('localhost','root','','android-client-server');
$data = mysqli_query($CONNECT,"SELECT `Qstatus`,`orientation` FROM `game`");
$row = mysqli_fetch_assoc($data);
$Qstatus=$row['Qstatus'];
$orientation=$row['orientation'];
$data = mysqli_query($CONNECT, "SELECT * FROM `players`");
if(mysqli_num_rows($data)){
	if($orientation==0){
		if($Qstatus==1){
			while ($row = mysqli_fetch_assoc($data)){
				if($row[view] == 1){
					printf('
						<div id="v-player'.$row[background].'" class="kick v-player shadow-'.$row[shadow].'">
							<div class="v-name">%s</div>
							<div class="v-nickname">%s</div>
							<div class="v-score">%s</div>
							<div class="v-answer">%s</div>
						</div>
					',$row["name"],$row["nickname"],$row["score"], $row["answer"]);
				}else printf('
						<div id="v-player'.$row[background].'" class="v-player shadow-'.$row[shadow].'">
							<div class="v-name">%s</div>
							<div class="v-nickname">%s</div>
							<div class="v-score">%s</div>
							<div class="v-answer">%s</div>
						</div>
					',$row["name"],$row["nickname"],$row["score"], $row["answer"]);
			}
		}else if($Qstatus==0){
			while ($row = mysqli_fetch_assoc($data)){
				if($row[view] == 1){
					printf('
						<div id="v-player'.$row[background].'" class="kick v-player shadow-'.$row[shadow].'">
							<div class="v-name">%s</div>
							<div class="v-nickname">%s</div>
							<div class="v-score">%s</div>
							<div class="v-answer">-</div>
						</div>
					',$row["name"],$row["nickname"],$row["score"]);
				}else printf('
						<div id="v-player'.$row[background].'" class="v-player shadow-'.$row[shadow].'">
							<div class="v-name">%s</div>
							<div class="v-nickname">%s</div>
							<div class="v-score">%s</div>
							<div class="v-answer">-</div>
						</div>
					',$row["name"],$row["nickname"],$row["score"]);
			}
		}
	}else if($orientation==1){
		if($Qstatus==1){
		while ($row = mysqli_fetch_assoc($data)){
			if($row[view] == 1){
				printf('
					<div id="h-player'.$row[background].'" class="kick h-player shadow-'.$row[shadow].'">
						<div class="h-name">%s</div>
						<div class="h-nickname">%s</div>
						<div class="h-score">%s</div>
						<div class="h-answer">%s</div>
					</div>
				',$row["name"],$row["nickname"],$row["score"], $row["answer"]);
			}else printf('
					<div id="h-player'.$row[background].'" class="h-player shadow-'.$row[shadow].'">
						<div class="h-name">%s</div>
						<div class="h-nickname">%s</div>
						<div class="h-score">%s</div>
						<div class="h-answer">%s</div>
					</div>
				',$row["name"],$row["nickname"],$row["score"], $row["answer"]);
		}
	}else if($Qstatus==0){
		while ($row = mysqli_fetch_assoc($data)){
			if($row[view] == 1){
				printf('
					<div id="h-player'.$row[background].'" class="kick h-player shadow-'.$row[shadow].'">
						<div class="h-name">%s</div>
						<div class="h-nickname">%s</div>
						<div class="h-score">%s</div>
						<div class="h-answer">-</div>
					</div>
				',$row["name"],$row["nickname"],$row["score"]);
			}else printf('
					<div id="h-player'.$row[background].'" class="h-player shadow-'.$row[shadow].'">
						<div class="h-name">%s</div>
						<div class="h-nickname">%s</div>
						<div class="h-score">%s</div>
						<div class="h-answer">-</div>
					</div>
				',$row["name"],$row["nickname"],$row["score"]);
		}
	}
	}
}
mysqli_close($CONNECT);
?>
