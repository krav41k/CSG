<?php
$db = mysqli_connect('localhost','root','','android-client-server');
$data = mysqli_query($db, "SELECT * FROM `players`");
if(mysqli_num_rows($data)){
	echo('<table>');
	while ($row = mysqli_fetch_assoc($data)) {
		if($row[view] == 1) $check = 'checked';
		printf('
			<tr>
				<td class="interim">%s ['.$row[id].']</td>
				<td class="interim">%s</td>
				<td class="interim">%s</td>
				<td><input type="button" class="button-admin" onclick="send(\'add\',\''.$row[id].'\')" value="+"></td>
				<td><input type="button" class="button-admin" onclick="send(\'remove\',\''.$row[id].'\')" value="-"></td>
				<td><input type="checkbox" class="button-admin" onclick="send(\'view\',\''.$row[id].'\')" '.$check.'></td>
				<td class="password">%s</td>
			</tr>
			',$row["name"],$row["score"], $row["answer"], $row["password"]);
			$check='';
	}
	echo('</table>');
}
mysqli_close($db);
?>
