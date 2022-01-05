<?php
 
 
 include("./Lib/Conn.php");
 $Util = new UtilClass();
   


    $mem_id =  $_POST['ID']; 
    $update_password =  $_POST['UPDATE_PASSWORD']; 
    



    $sql = "UPDATE team1.member 
    SET member_pwd = ? 
    WHERE member_id = $mem_id";
    
    
    $statement=$Util->getPDO()->prepare($sql);
    $statement->bindValue(1,$update_password);
    $statement->execute();


 


    echo'更新成功';
   
    



    
?>