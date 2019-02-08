<?php
  session_start();
  if($_SESSION['id_member'] == "")
  
  {
      header("location:index.html");
      exit();
  }
?>