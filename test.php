<?php
 require "config_database/config.php";
  $sql_sumsex = "SELECT * FROM question 
  INNER JOIN question.tbl_districts ON tbl_districts.district_id = question.district_id
  WHERE id_sex = 1 AND tbl_districts.amphur_id = 588";
  $objq_sumsex = mysqli_query($conn,$sql_sumsex);
  echo $num_rows_sex = mysqli_num_rows($objq_sumsex);
?>