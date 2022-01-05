<?php
 try
 {
    include("./Lib/Conn.php");
    $Util = new UtilClass();

    //建立SQL
    $data = json_decode(file_get_contents("php://input"));
    // print_r($data);
    $mem_id = $data -> memberId;


    $sql = "SELECT member_cost, member_level,member_points, member_signdate from `member` WHERE member_id in (?)";
    $statement = $Util->getPDO()->prepare($sql);


    $statement->bindValue(1, $mem_id);
    $statement->execute();
    $data = $statement->fetchAll();
 
    if($data != [] ){
        foreach($data as $index => $row){
            echo $row["member_cost"];   //欄位名稱
            echo " / ";
            echo $row["member_points"];    //欄位名稱
            echo " / ";
            echo $row["member_signdate"]; //欄位名稱
        }
        
    }else{
        echo '幽靈人口';
    }
    
 }
 catch(PDOException $e)
 {
     echo "Connection failed: ".$e->getMessage();
 }

?>
