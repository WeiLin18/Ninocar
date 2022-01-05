<?php
 try
 {
    include("./Lib/Conn.php");
 $Util = new UtilClass();

    //建立SQL
    $data = json_decode(file_get_contents("php://input"));

    $mem_id = $data -> memberId;

    // echo $mem_id;

    $sql = "SELECT * from `member` WHERE member_id = ?";
    $statement = $Util->getPDO()->prepare($sql);
  
    $statement->bindValue(1, $mem_id);
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
 
    if($data != [] ){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
        echo '此帳號未註冊';
    }
    
 }
 catch(PDOException $e)
 {
     echo "Connection failed: ".$e->getMessage();
 }

?>