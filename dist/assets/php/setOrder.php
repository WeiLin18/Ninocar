<?php
 
 
 include("./Lib/Conn.php");
 $Util = new UtilClass();
   

    // 訂單區塊
    $ord_id =  $_POST['ORDER_ID']; 
    $mem_id =  $_POST['ID']; 
    $ord_cost =  $_POST['ORDER_COST']; 
    $ord_points =  $_POST['ORDER_POINTS']; 
    $ord_gain =  $_POST['ORDER_GAIN']; 
    $pay_type =  $_POST['PAY_TYPE']; 
    $product_array = json_decode($_POST['PRODUCT_ARRAY']); 

    // print_r($product_array);
    // echo count($product_array);

    $sql = "INSERT INTO `team1`.`order`(order_id,member_id,order_cost,order_points,order_gain,
    pay_type,order_type,deliver_type,order_date,type_date) VALUES (?,?,?,?,?,?,0,0,Now(),Now())";
    
    $statement=$Util->getPDO()->prepare($sql);
    $statement->bindValue(1, $ord_id);
    $statement->bindValue(2, $mem_id);
    $statement->bindValue(3, $ord_cost);
    $statement->bindValue(4, $ord_points);
    $statement->bindValue(5, $ord_gain);
    $statement->bindValue(6, $pay_type);
    
    $statement->execute();

 
  
    // 建立訂單與商品連結

        for($i=0;$i<count($product_array);$i++){

            $sql = "INSERT INTO `detail` (`order_id`, `product_id`) VALUES (?, ?)";
    
            $statement=$Util->getPDO()->prepare($sql);
            $statement->bindValue(1, $ord_id);
            $statement->bindValue(2, $product_array[$i]);
            $statement->execute();
        
        };





    echo'新增成功';
    
  
    
  
?>