<?php
 
 try{

    include("./Lib/Conn.php");
 $Util = new UtilClass();
   


    $mem_id =  $_POST['ID']; 
    $mem_name =  $_POST['MEMBER_NAME']; 
    $mem_phone =  $_POST['MEMBER_PHONE']; 
    $mem_gender =  $_POST['MEMBER_GENDER']; 
    $mem_birthday =  $_POST['MEMBER_BIRTHDAY']; 
    $mem_photo =  $_POST['MEMBER_PHOTO']; 

 

    $sql = "UPDATE team1.member 
    SET member_name= ? ,member_gender=?,member_phone=? ,member_photo=?,member_birthday=?
    WHERE member_id = $mem_id";
    

    $statement=$Util->getPDO()->prepare($sql);
    $statement->bindValue(1,$mem_name);
    $statement->bindValue(2, $mem_gender);
    $statement->bindValue(3, $mem_phone);
    $statement->bindValue(4, $mem_photo);
    $statement->bindValue(5,  $mem_birthday);
    // $statement->bindValue(6, $pay_type);
    
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();
 




    echo'新增成功';


 }catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
 
   
    



    
?>