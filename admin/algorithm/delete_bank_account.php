<?php
    require "../../config_database/config.php"; 
    $id_bank = $_GET['id_bank'];
  
    $sql = "DELETE FROM bank_account WHERE id_bank = $id_bank";
    mysqli_query($conn,$sql);

?>