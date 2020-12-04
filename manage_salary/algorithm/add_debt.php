<?php 
  require "../../config_database/config.php";
  $id_member = $_POST['id_member'];
  $id_debt_list = $_POST['id_debt_list'];
  $money_debt = $_POST['money_debt'];
  $month = $_POST['month'];
  $year = $_POST['year'];

  $insert_debt_list = "INSERT INTO salary_debt (money_debt, id_debt_list, id_member)
                        VALUE ($money_debt, $id_debt_list, $id_member)";
  mysqli_query($conn,$insert_debt_list);

  header('location:../salary_data.php?id_member='.$id_member.'&month='.$month.'&year='.$year);
?>