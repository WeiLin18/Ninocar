<?php
 
 include("./Lib/Conn.php");
 $Util = new UtilClass();
   


    $mem_id =  $_POST['ID']; 
 
  

    $sql = "SELECT member_address from `member` WHERE member_id = ?";
    // $sql = "SELECT * from member";
    $statement = $Util->getPDO()->prepare($sql);
  
    $statement->bindValue(1, $mem_id);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();
 

    if($data != [] ){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }else{
      echo '此帳號未註冊';
    }
    

 
?>