<?php
 try
 {
    // include("./Lib/UtilClass.php");
    include("./Lib/Conn.php");
    $Util = new UtilClass();

    //建立SQL
    $data = json_decode(file_get_contents("php://input"));
    // print_r($data);
    $mem_id = $data -> memberId;
    $order_id= $data -> orderId;

  
    $sql = "SELECT * FROM `order` as o JOIN detail as de
    on o.order_id = de.order_id
      JOIN product as pro 
    on de.product_id = pro.product_id
    WHERE o.member_id =? AND o.order_id =? ;";



    $statement = $Util->getPDO()->prepare($sql);


    $statement->bindValue(1, $mem_id);
    $statement->bindValue(2, $order_id);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
    if($data != [] ){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
        echo '尚未擁有任何車車';
    }
    
 }
 catch(PDOException $e)
 {
     echo "Connection failed: ".$e->getMessage();
 }

?>
