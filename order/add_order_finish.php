<?php 

    require "../config_database/config.php";
    
    $id_order_list = $_POST['id_order_list'];
    $list_order = $_POST['list_order'];
    $id_product = $_POST['id_product'];
    $num_product = $_POST['num_product'];
    $price_num = $_POST['price_num'];
    $money = $_POST['money'];
    //$vat = $_POST['vat'];
    $date_order = $_POST['date_order'];
    $date_getorder = $_POST['date_getorder'];
    $date_receive = $_POST['date_receive'];
    $name_sent = $_POST['name_sent'];
    $tel_sent = $_POST['tel_sent'];
    $catagory_car = $_POST['catagory_car'];
    $licent_plate = $_POST['licent_plate'];
    $name_author = $_POST['name_author'];
    $name_store = $_POST['name_store'];
    $amphur_id = $_POST['amphur_name'];
    $province_id = $_POST['province_name'];
    $name_to = $_POST['name_to'];
    $tel_to = $_POST['tel_to'];
   // $slip_number = $_POST['slip_number'];
   $price_portage = $_POST['price_portage'];
    $portage = $_POST['portage'];
    $note = $_POST['note'];
    $invoice = $_POST['invoice'];

    

     $sql = "INSERT INTO order_list (id_order_list, list_order, id_product, num_product,price, money, date_receive, date_getorder, date_order, price_portage, portage,name_sent, tel_sent, catagory_car, licent_plate, name_author, name_store, amphur_id, province_id, name_to, tel_to, note, invoice)
                         VALUES ($id_order_list, '$list_order', $id_product, $num_product, $price_num, $money, '$date_receive', '$date_getorder', '$date_order', $price_portage, $portage, '$name_sent', '$tel_sent', '$catagory_car','$licent_plate', '$name_author', '$name_store', $amphur_id, $province_id, '$name_to', '$tel_to', '$note', '$invoice')";
     mysqli_query($conn,$sql);

  

    $max_id = "SELECT MAX(id_order_list) FROM order_list";
    $objq_max_id = mysqli_query($conn,$max_id);
    $objr_max_id = mysqli_fetch_array($objq_max_id);


    header('location:data_order.php?id_order_list='.$objr_max_id['MAX(id_order_list)']);
?>