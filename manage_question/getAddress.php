<?php
header("Content-type:text/html; charset=UTF-8");
header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Connection: close");
include("db_connect.php");
$mysqli = connect();
// array ชื่อตารางในฐานข้อมูลที่เราจะใช้
$arr_tbl_name = array(
    "0"=>"tbl_geography",
    "1"=>"tbl_provinces",
    "2"=>"tbl_amphures",
    "3"=>"tbl_districts",
    "4"=>"tbl_zipcodes",
);
// array คำนำหน้า สำหรับใช้เชื่อมฟิลด์ในตาราง
$arr_data_prefix = array(
    "0"=>"geo",
    "1"=>"province",
    "2"=>"amphur",
    "3"=>"district",
    "4"=>"zipcode",
);
// array สำหรับกำหนดฟิลด์ในตารางที่เราต้องการกำหนดเงื่อนไข
$arr_field_where = array(
    "0"=>"geo_id",
    "1"=>"province_id",
    "2"=>"amphur_id",
    "3"=>"district_id",
    "4"=>"zipcode_id",
);
// ข้อความสำหรับ option ให้เลือกข้อมูล
$arr_choose_text = array(
    "0"=>"-- เลือกภาค --",
    "1"=>"-- เลือกจังหวัด --",
    "2"=>"-- เลือกอำเภอ/เขต --",
    "3"=>"-- เลือกตำบล/แขวง --",
    "4"=>"-- เลือกรหัสไปรษณีย์ -- ",
);
$tbl_id=isset($_POST['IDTbl']) ? trim($_POST['IDTbl']) : NULL;
$checkID=isset($_POST['IDCheck']) ? trim($_POST['IDCheck']) : NULL;
$where_id=isset($_POST['IDWhere']) ? trim($_POST['IDWhere']) : NULL;
$selected_id=isset($_POST['IDSelected']) ? trim($_POST['IDSelected']) : NULL;
if(isset($tbl_id) && $tbl_id!=""
|| (isset($tbl_id) && $tbl_id!=""
&& isset($checkID) && $checkID!="" 
&& isset($where_id) && $where_id!="")      
){
     
    $keyData_id=$arr_data_prefix[$tbl_id]."_id";
    $keyData_value=$arr_data_prefix[$tbl_id]."_name";
     
}else{
    exit;   
}
$sql="
SELECT * FROM ".$arr_tbl_name[$tbl_id]." WHERE 1
";
if($where_id!=""){
    $sql.="
    AND ".$arr_field_where[$where_id]."='".$checkID."'
    ";
}
// เรียงจาก id สามารถแก้เป็นเรียงตามชื่อได้ด้วยค่า $keyData_value 
// แต่เนื่องจากในฐานข้อมูล อาจจะมีบางรายการลำดับไม่ถูกต้อง แต่ก็สามารถกำหนดได้
$sql.=" ORDER BY ".$keyData_id." ";
$result = $mysqli->query($sql);
?>
<option value=""><?=$arr_choose_text[$tbl_id]?></option>
<?php
if($result->num_rows>0){  
    while($row = $result->fetch_assoc()){    
?>
    <option value="<?=$row[$keyData_id]?>"
    <?=($row[$keyData_id]==$selected_id)?" selected":""?> >
    <?=$row[$keyData_value]?>
    </option>
<?php
   }
}
?>