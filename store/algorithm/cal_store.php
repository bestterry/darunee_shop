<?php   
        for ($i=0; $i < count($_POST['bring']); $i++) { 
           $id_store_incar = $_POST['id_store_incar'][$i];
          $name_product = $_POST['name_product'][$i];
          $unit = $_POST['unit'][$i];
          $bring = $_POST['bring'][$i];
          $input = $_POST['input'][$i];
          $draw = $_POST['draw'][$i];
          $sale = $_POST['sale'][$i];
          $etc  = $_POST['etc'][$i];
          $return = $_POST['return'][$i];
          $count = $_POST['count'][$i];

          $surplus = ($bring+$input)-($draw+$sale+$etc+$return);

          $sql = "UPDATE store_incar 
                  SET bring ='$bring',input = '$input',draw = '$draw',sale = '$sale',etc = '$etc',ret = '$return',surplus = '$surplus',count = '$count' 
                  WHERE id_store_incar = $id_store_incar";
          mysqli_query($conn,$sql);    
?>
                          <tr>
                            <td class="text-center" ><?php echo $i+1; ?></td>
                            <td class="text-center"  ><?php echo $name_product; ?></td>
                            <td class="text-center"  ><?php echo $unit; ?></td>
                            <td bgcolor="#ccffcc" class="text-center"  ><?php echo $bring; ?></td>
                            <td bgcolor="#ccffcc" class="text-center"  ><?php echo $input; ?></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><?php echo $draw; ?></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><?php echo $sale; ?></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><?php echo $etc; ?></td>
                            <td bgcolor="#ffc2b3" class="text-center"  ><?php echo $return; ?></td>
                            <td bgcolor="#b3ffff" class="text-center"  ><?php echo $surplus; ?></td>
                            <td bgcolor="#b3ffff" class="text-center"  ><?php echo $count; ?></td>
                          </tr>
<?php
          }
?>   