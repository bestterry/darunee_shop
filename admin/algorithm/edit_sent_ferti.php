<?php 
    require "../../config_database/config.php";
    require "../../session.php";
    $day = $_GET['day'];
    $id = $_POST['id'];
    $id_type_lift = $_POST['id_type_lift'];
    $id_car = $_POST['id_car'];
    $num_cus = $_POST['num_cus'];
    $num_ferti = $_POST['num_ferti'];
    $money = ceil($_POST['money']);
    $note = $_POST['note'];

  $sql = "UPDATE sent_ferti SET id_type_lift = '$id_type_lift', id_car = $id_car, num_cus = '$num_cus', 
                        num_ferti = '$num_ferti', money = '$money', note = '$note'
                        WHERE id_sent_ferti = $id ";

    if ($conn->query($sql) === TRUE) {
      header('location:../sent_fertilizer_list.php?day='.$day);
    } else {
      echo "Error updating record: " . $conn->error;
    }

    $conn->close();

?>