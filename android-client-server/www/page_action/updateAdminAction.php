<?php
$db = mysqli_connect('localhost','root','','android-client-server');
$data = mysqli_query($db, "SELECT * FROM `game`");
$row = mysqli_fetch_assoc($data);
$stage = $row['Qstage'];
$number = $row['Qnumber'];
$data = mysqli_query($db, "SELECT * FROM `questions` WHERE `Qstage`=$stage");  
    print('
		<div class="stageList">
		<a class="text-field">Stage:</a>
		<input type="button" class="static-object" onclick="changeStage(\'remove\')" value="<">
		<a class="text-field">'.$stage.'</a>
		<input type="button" class="static-object" onclick="changeStage(\'add\')" value=">">
		</div>
	');
	echo "<div class='questionList'>";
    while ($question = mysqli_fetch_assoc($data)) {
		if($question['status']==1){
			echo('<input type="radio" disabled name="question" id="question-select" value="'.$question["Qnumber"].'" onclick="changeQuestion(this);"> '.$question["Qnumber"].'<br>');
		}else
        echo('<input type="radio" name="question" id="question-select" value="'.$question["Qnumber"].'" onclick="changeQuestion(this);"> '.$question["Qnumber"].'<br>');
    }
	echo "</div>";
    //echo('<br><input type="button" onclick="startRound()" class="static-object" value="next round">');
mysqli_close($db);
?>
