<?php 
  require "../../config_database/config.php";
  $id_member = $_POST['id_member'];
  $id_debt_list = $_POST['id_debt_list'];
  $money_debt = $_POST['money_debt'];
  $month = $_POST['month'];
  $year = $_POST['year'];

  $sql_checkdebt = "SELECT * FROM salary_debt WHERE id_member = $id_member AND id_debt_list = $id_debt_list";
  $objq_checkdebt = mysqli_query($conn,$sql_checkdebt);
    if ($objq_checkdebt->num_rows > 0) {
        $objr_checkdebt = mysqli_fetch_array($objq_checkdebt);
        echo $money_debt2 = $objr_checkdebt['money_debt'];
        $total_debt = $money_debt + $money_debt2;
      // $update_debt = "UPDATE salary_debt SET money = "
        
    }else {
      echo "test";
      // $insert_debt_list = "INSERT INTO salary_debt (money_debt, id_debt_list, id_member)
      //                       VALUE ($money_debt, $id_debt_list, $id_member)";
      //   mysqli_query($conn,$insert_debt_list);
    }

  //header('location:../salary_data.php?id_member='.$id_member.'&month='.$month.'&year='.$year);
?>