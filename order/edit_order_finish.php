<?php 
  require "../config_database/config.php";

  $id_order_list = $_POST['id_order_list'];
  $list_order = $_POST['list_order'];
  $catagory_car = $_POST['catagory_car'];
  $date_getorder = $_POST['date_getorder'];
  $date_receive = $_POST['date_receive'];
  $date_order = $_POST['date_order'];
  $portage = $_POST['portage'];
  $price_portage = $_POST['price_portage'];
  $num_product = $_POST['num_product'];
  $name_store = $_POST['name_store'];
  $note = $_POST['note'];
  $name_sent = $_POST['name_sent'];
  $tel_sent = $_POST['tel_sent'];
  $licent_plate = $_POST['licent_plate'];
  $name_author = $_POST['name_author'];
  $name_to = $_POST['name_to'];
  $tel_to = $_POST['tel_to'];
  $province_id = $_POST['province_name'];
  $amphur_id = $_POST['amphur_name'];
  $invoice = $_POST['invoice'];
  $money = $_POST['money'];
  $price = $_POST['price'];
  $id_product = $_POST['id_product'];
 

  if (empty($province_id)) {
      //update addorder don't have province
      if(empty( $id_product)){
               $sql_order_list = " UPDATE order_list SET list_order = '$list_order', num_product = '$num_product', note = '$note', name_sent = '$name_sent',
                                               tel_sent = '$tel_sent', licent_plate = '$licent_plate', name_author = '$name_author', price = $price, money = $money,
                                               name_to = '$name_to', tel_to = '$tel_to', catagory_car = '$catagory_car',
                                               date_receive = '$date_receive', date_getorder = '$date_getorder' , date_order = '$date_order', portage = '$portage', name_store = '$name_store',
                                               invoice = '$invoice', price_portage = $price_portage
                          WHERE id_order_list = $id_order_list ";  

      }else{
               $sql_order_list = " UPDATE order_list SET list_order = '$list_order', num_product = '$num_product', note = '$note', name_sent = '$name_sent',
                                 tel_sent = '$tel_sent', licent_plate = '$licent_plate', name_author = '$name_author', price = $price, money = $money,
                                 name_to = '$name_to', tel_to = '$tel_to', catagory_car = '$catagory_car',id_product = '$id_product',
                                 date_receive = '$date_receive', date_getorder = '$date_getorder' , date_order = '$date_order', portage = '$portage', name_store = '$name_store',
                                 invoice = '$invoice', price_portage = $price_portage
                                 WHERE id_order_list = $id_order_list ";  
      }
  }else{

   if(empty( $id_product)){
            $sql_order_list = " UPDATE order_list SET list_order = '$list_order', catagory_car = '$catagory_car', num_product = '$num_product',
                                                note = '$note', name_sent = '$name_sent',tel_sent = '$tel_sent', licent_plate = '$licent_plate', price = $price, money = $money,
                                                name_author = '$name_author', name_to = '$name_to', tel_to = '$tel_to',date_receive = '$date_receive', 
                                                date_getorder = '$date_getorder', date_order = '$date_order', portage = '$portage', name_store = '$name_store', amphur_id = $amphur_id, 
                                                province_id = $province_id ,invoice = '$invoice', price_portage = $price_portage
                          WHERE id_order_list = $id_order_list ";  
   }else{
            $sql_order_list = " UPDATE order_list SET list_order = '$list_order', catagory_car = '$catagory_car', num_product = '$num_product',
                                                note = '$note', name_sent = '$name_sent',tel_sent = '$tel_sent', licent_plate = '$licent_plate', price = $price, money = $money,
                                                name_author = '$name_author', name_to = '$name_to', tel_to = '$tel_to',date_receive = '$date_receive', 
                                                date_getorder = '$date_getorder', date_order = '$date_order', portage = '$portage', name_store = '$name_store', amphur_id = $amphur_id, 
                                                province_id = $province_id ,invoice = '$invoice',id_product = '$id_product', price_portage = $price_portage
                           WHERE id_order_list = $id_order_list ";  
   }    

  }
                                 
      
   mysqli_query($conn,$sql_order_list);

   header('location:data_order.php?id_order_list='.$id_order_list);
?>