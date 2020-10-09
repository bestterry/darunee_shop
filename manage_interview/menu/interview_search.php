<?php 

    if (empty($_POST['province_name'])) {
        $provinces_id = 0;
    }else {
        $provinces_id = $_POST['province_name'];
    }

    if (empty($_POST['amphur_name'])) {
      $amphures_id = 0;
    }else {
      $amphures_id = $_POST['amphur_name'];
    }

    if (empty($_POST['id_product'])) {
      $id_product = 0;
    }else {
      $id_product = $_POST['id_product'];
    }

    if (empty($_POST['id_plance'])) {
      $id_plance = 0;
    }else {
      $id_plance = $_POST['id_plance'];
    }
  
      if(($provinces_id==0)&&($amphures_id==0)&&($id_plance==0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
        INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
        INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id"; 

      }else if(($provinces_id != 0)&&($amphures_id == 0)&&($id_plance == 0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      WHERE interview.provinces_id = $provinces_id";

      }else if(($provinces_id != 0)&&($amphures_id != 0)&&($id_plance == 0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      WHERE interview.amphures_id = $amphures_id";
                  
      }else if(($provinces_id != 0)&&($amphures_id == 0)&&($id_plance != 0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_plance ON interview.id = interview_plance.id
                      WHERE interview.provinces_id = $provinces_id AND interview_plance.id_plance = $id_plance";

      }else if(($provinces_id != 0)&&($amphures_id == 0)&&($id_plance == 0)&&($id_product != 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_product ON interview.id = interview_product.id
                      WHERE interview.provinces_id = $provinces_id AND interview_product.id_product = $id_product";

      }else if(($provinces_id != 0)&&($amphures_id != 0)&&($id_plance != 0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_plance ON interview.id = interview_plance.id
                      WHERE interview.amphures_id = $amphures_id AND interview_plance.id_plance = $id_plance";
                  
      }else if(($provinces_id != 0)&&($amphures_id != 0)&&($id_plance == 0)&&($id_product != 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_product ON interview.id = interview_product.id
                      WHERE interview.amphures_id = $amphures_id AND interview_product.id_product = $id_product";
                  
      }else if(($provinces_id != 0)&&($amphures_id != 0)&&($id_plance != 0)&&($id_product != 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_plance ON interview.id = interview_plance.id
                      INNER JOIN interview_product ON interview.id = interview_product.id
                      WHERE interview.amphures_id = $amphures_id AND interview_plance.id_plance = $id_plance 
                      AND interview_product.id_product = $id_product";

      }else if(($provinces_id == 0)&&($amphures_id == 0)&&($id_plance != 0)&&($id_product != 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_plance ON interview.id = interview_plance.id
                      INNER JOIN interview_product ON interview.id = interview_product.id
                      WHERE interview_plance.id_plance = $id_plance AND interview_product.id_product = $id_product";

      }else if(($provinces_id == 0)&&($amphures_id == 0)&&($id_plance == 0)&&($id_product != 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_product ON interview.id = interview_product.id
                      WHERE interview_product.id_product = $id_product";

      }else if(($provinces_id == 0)&&($amphures_id == 0)&&($id_plance != 0)&&($id_product == 0)){
        $interview = "SELECT * FROM interview 
                      INNER JOIN tbl_amphures ON tbl_amphures.amphur_id = interview.amphures_id
                      INNER JOIN tbl_provinces ON tbl_provinces.province_id = interview.provinces_id
                      INNER JOIN interview_plance ON interview.id = interview_plance.id
                      WHERE interview_plance.id_plance = $id_plance";
      }
      
      $objq_interview = mysqli_query($mysqli,$interview);
?>