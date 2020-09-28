<?php 
  require "../../config_database/config.php"; 
  $output = '';  
  $id_carrental = $_POST['id_carrental'];
  
  $query = "SELECT * FROM car_rental 
            INNER JOIN rc_practice ON rc_practice.id_practice = car_rental.id_practice 
            INNER JOIN member ON member.id_member = car_rental.id_member
            WHERE id_carrental = $id_carrental";  
  $result = mysqli_query($conn, $query);
  $objr = mysqli_fetch_array($result);
  $name_member = $objr['name'];
  $money = $objr['money'];
  $name_practice = $objr['name_practice'];
  $note = $objr['note'];
  $date = $objr['date'];
  $id_practice = $objr['id_practice'];

  // $sql_practice = "SELECT name_practice WHERE rc_practice";
  // $objq_practice = mysqli_query($conn,$sql_practice);
  // while($value = $objq_practice->fetch_assoc()){
  //   $value['name_practice'];
  // }
          $output .= '  
          <div class="form-group">
                <label for="name" class="col-sm-2 control-label">ชื่อ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="name" value="'.$name_member.'" readonly/>
                  <input type="hidden" class="form-control" id="name" value="'.$id_carrental.'" readonly/>
                </div>
              </div>
              <div class="form-group">
                <label for="rc_practice" class="col-sm-2 control-label">ปฏิบัติงาน</label>
                <div class="col-sm-10">
                  <select name="id_practice" class="form-control">
                   <option value="'.$id_practice.'">'.$name_practice.'</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="car_rental" class="col-sm-2 control-label">ค่าเช่ารถ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="car_rental" value="'.$money.'">
                </div>
              </div>
              <div class="form-group">
                <label for="car_rental" class="col-sm-2 control-label">วันที่</label>
                <div class="col-sm-10">
                  <input type="date" class="form-control" id="car_rental" value="'.$date.'">
                </div>
              </div>
              <div class="form-group">
                <label for="note" class="col-sm-2 control-label">หมายเหตุ</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="note" value="'.$note.'">
                </div>
              </div>
                ';   
      echo $output;  
 
 ?>