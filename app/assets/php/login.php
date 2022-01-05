<?php
 try
 {
    include("./Lib/Conn.php");
    $Util = new UtilClass();

    $data = json_decode(file_get_contents("php://input"));
    $mem_email = $data -> account;
    $mem_password = $data -> password;
  

    $sql = "SELECT member_id FROM member WHERE  member_account = ? and member_pwd = ?";
    $statement = $Util->getPDO()->prepare($sql);

   
    $statement->bindValue(1, $mem_email);
    $statement->bindValue(2, $mem_password);
    $statement->execute();
    $data = $statement->fetchAll();

    
    if($data != [] ){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
        echo '帳號或密碼錯誤';
    }
 }
catch(PDOException $e)
{
    echo "Connection failed: ".$e->getMessage();
}
    // }else if($data == [] && $data2 != []){
    //     echo '帳號或密碼錯誤';
    // }else if($data2 == []){
    //     echo '此帳號未註冊';
    // }
    // $memberID = "";
    // $memberName = "";
    // foreach($data as $index => $row){
    //     $memberID = $row["member_id"];
    //     $memberName = $row["Account"];
    // }

 

?>
