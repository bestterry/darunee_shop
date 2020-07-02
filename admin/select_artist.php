<?php
 
 include("db_connect.php");
 $mysqli = connect();

  $id_ageartist = $_POST['id_ageartist'];
  $id_sexartist = $_POST['value'];
	$sql = "SELECT * FROM song_artist WHERE id_sexartist = $id_sexartist AND id_ageartist = $id_ageartist";
 
  if ($result=mysqli_query($mysqli,$sql)) {
  while ($value = mysqli_fetch_array($result)) {
  echo "<option value=\"" . $value['id_artist'] . "\">" . $value['name_artist'] . "</option>";
  }
  }else{
  echo "<option value=\"\">ไม่มีข้อมูลที่เลือก</option>";
  }
	
?>