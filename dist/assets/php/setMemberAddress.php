<?php
 
 include("./Lib/Conn.php");
 $Util = new UtilClass();
   

    // 訂單區塊
  
    $mem_id =  $_POST['ID']; 
    
    $address_array = $_POST['ADDRESS_ARRAY'];

    echo $mem_id;
    echo $address_array;
  
    // 建立訂單與商品連結
        // for($i=0;$i<count($product_array);$i++){

            $sql = "UPDATE team1.member 
            SET member_address = ? 
            WHERE member_id = $mem_id";
    
    
            $statement=$Util->getPDO()->prepare($sql);
            $statement->bindValue(1, $address_array);
            $statement->execute();
        // };


    echo'新增成功';

    



    
?>