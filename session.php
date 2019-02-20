<?php
  session_start();
  if($_SESSION['id_member'] == "")
  
  {
      header("location:index.html");
      exit();
  }

  $id_member= $_SESSION['id_member'];
  
  $sql_name = "SELECT * FROM member WHERE id_member = $id_member";
  $objq_name = mysqli_query($conn,$sql_name);
  $objr_name = mysqli_fetch_array($objq_name);
  $username = $objr_name['name'];
 
?>