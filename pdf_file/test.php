<?php
require('fpdf.php');
require('../config_database/config.php'); 
 
$sql_car = "SELECT id_member,name FROM member WHERE 
status='employee' AND NOT id_member = 3 AND NOT id_member = 8 AND NOT id_member = 19
AND NOT id_member = 32 AND NOT id_member = 28";
$objq_car = mysqli_query($conn,$sql_car);

while($value_car = $objq_car->fetch_assoc()){
$id_member = $value_car['id_member']; 
$i = 1;
$sql_ferti = "SELECT * FROM sent_ferti
  INNER JOIN type_lift ON sent_ferti.id_type_lift = type_lift.id
  INNER JOIN member ON sent_ferti.id_member = member.id_member 
  WHERE DATE_FORMAT(datetime,'%Y-%m-%d')='2020-05-14' AND sent_ferti.id_member = $id_member";
$objq_ferti = mysqli_query($conn,$sql_ferti);
echo $num_row = mysqli_num_rows($objq_ferti);

if($num_row == 0){
  echo "1".'<br>';
}else{
  echo "2".'<br>';
}

}

?>