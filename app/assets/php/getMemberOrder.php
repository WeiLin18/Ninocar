<?php
 try
 {
    include("./Lib/Conn.php");
    $Util = new UtilClass();

    //建立SQL
    $data = json_decode(file_get_contents("php://input"));
    // print_r($data);
    $mem_id = $data -> memberId;


    $sql = "SELECT * FROM `order` where order_id in ( SELECT order_id FROM `order` WHERE member_id = ?)";
    $statement = $Util->getPDO()->prepare($sql);


    $statement->bindValue(1, $mem_id);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);;
    
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