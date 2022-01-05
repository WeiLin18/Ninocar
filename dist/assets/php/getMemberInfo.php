<?php
 try
 {
    include("./Lib/Conn.php");
    $Util = new UtilClass();

    //建立SQL
    $data = json_decode(file_get_contents("php://input"));
    // print_r($data);
    $mem_email = $data -> account;


    $sql = "SELECT * from `member` WHERE member_account in (?)";
    $statement = $Util->getPDO()->prepare($sql);


    $statement->bindValue(1, $mem_email);
    $statement->execute();
    $data = $statement->fetchAll();
 
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
