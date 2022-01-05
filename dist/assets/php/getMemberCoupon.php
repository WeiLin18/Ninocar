<?php
 
            
      include("./Lib/Conn.php");
      $Util = new UtilClass();
        


      $mem_id =  $_POST['ID']; 


   

    $sql = "SELECT * FROM member as m JOIN member_coupon as mc
      on m.member_id = mc.member_id
        JOIN coupon as c 
      on  mc.coupon_id = c.coupon_id
    WHERE m.member_id =?";


     $statement = $Util->getPDO()->prepare($sql);
  
     $statement->bindValue(1, $mem_id);
     $statement->execute();
    

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
 

  if($data != [] ){
      echo json_encode($data, JSON_UNESCAPED_UNICODE);
  }else{
    echo '此帳號未註冊';
  }




   
    



    
?>