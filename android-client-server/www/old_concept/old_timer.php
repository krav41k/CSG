<?php
  $db = mysqli_connect('localhost','root','','android-client-server');
  $data = mysqli_query($db, "SELECT * FROM `action`");
  if(mysqli_num_rows($data)){
    $row = mysqli_fetch_assoc($data);
    if ($row["timer"] >= 995){
      print('
      <div id="day'.$row["day"].'">
      </div>
      ');
      $timer=$row["timer"]+1;
      $null="0";
      if ($timer == '1000') $timer='0';
      mysqli_query($db, "UPDATE `action` SET `timer`=$timer WHERE `key`=$null");
     }else {
      if ($row["timer"] != 0){
        echo $row["timer"];
        $timer=$row["timer"]-1;
        $null="0";
        mysqli_query($db, "UPDATE `action` SET `timer`=$timer WHERE `key`=$null");
      }else {
        echo "0";
      }
    }
  }
  mysqli_close($db);
?>
