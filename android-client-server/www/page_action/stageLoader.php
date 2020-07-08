<?php
$db = mysqli_connect('localhost','root','','android-client-server');
$data = mysqli_query($db, "SELECT * FROM `questions`");
$row = mysql_fetch_array($data);  
  if($row["type"] == 0){
    print('
      <select class="static-object" id="stage-select">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
      </select>
      <input type="button" onclick="changeStage()" class="static-object" value="ok">
    ');
    while ($question = mysqli_fetch_assoc($data_question)) {
      if($question["stage"] == $row["stage"]){
        echo('<br><input type="radio" name="question" value="'.$question["id"].'" onclick="changeQuestion(this);"> '.$question["id"].'');
      }
    }
    echo('<br><input type="button" onclick="startRound()" class="static-object" value="next round">');
  }
mysqli_close($db);
?>
