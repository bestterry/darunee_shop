<?php
  session_start();
  if($_SESSION['id_member'] == "")
  
  {
      header("location:index.html");
      exit();
  }

  $id_member = $_SESSION['id_member'];
  $sql_name = "SELECT * FROM member INNER JOIN zone ON member.id_zone = zone.id_zone  WHERE member.id_member = $id_member";
  $objq_name = mysqli_query($conn,$sql_name);
  $objr_name = mysqli_fetch_array($objq_name);
  
  $username = $objr_name['name'];
  $id_zone = $objr_name['id_zone'];
  $name_zone = $objr_name['name_zone'];
  $status_user = $objr_name['status'];
  
?>