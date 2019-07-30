<?php 
  require "../config_database/config.php";

  $id_order_list = $_POST['id_order_list'];
  $list_order = $_POST['list_order'];
  $date_receive = $_POST['date_receive'];
  $num_product = $_POST['num_product'];
  $price = $_POST['price'];
  $money = $_POST['money'];
  $vat = $_POST['vat'];
  $portage = $_POST['portage'];
  $pay_portage = $_POST['pay_portage'];
  $name_sent = $_POST['name_sent'];
  $tel_sent = $_POST['tel_sent'];
  $licent_plate = $_POST['licent_plate'];
  $name_author = $_POST['name_author'];
  $status = $_POST['status'];
  $name_to = $_POST['name_to'];
  $tel_to = $_POST['tel_to'];

  //update addorder
    $sql_order_list = "UPDATE order_list SET list_order = '$list_order', date_receive = '$date_receive', num_product = '$num_product', price = '$price',
                                             money = $money, portage = '$portage', pay_portage = '$pay_portage', name_sent = '$name_sent',vat = '$vat',
                                             tel_sent = '$tel_sent',licent_plate = '$licent_plate', name_author = '$name_author',
                                             status = '$status', name_to = '$name_to', tel_to = '$tel_to'
                       WHERE id_order_list = $id_order_list";  
                                   
   mysqli_query($conn,$sql_order_list);
    header('location:edit_order.php?id_order_list='.$id_order_list);
?>