<?php


try {


    include("./Lib/Conn.php");
    $Util = new UtilClass();


    $mem_id =  $_POST['ID'];  
    $order_id =  $_POST['ORDER_ID'];  


    // print_r($order_id);


    //更新會員累積消費


    //抓取目前會員訂單消費金額

    $sql_member_cost= "SELECT order_cost FROM `order` WHERE member_id=? and order_id = ?";
    $member_cost=$Util->getPDO()->prepare( $sql_member_cost);
    $member_cost->bindValue(1,$mem_id);
    $member_cost->bindValue(2,$order_id);
    $member_cost->execute();
    $member_current_cost = $member_cost ->fetch();

    
 

    // print_r ($member_current_cost[0]);






    //抓取會員目前消費加總

 
    $sql = "SELECT member_cost FROM member 

    where member_id=?";


    $statement = $Util->getPDO()->prepare($sql);
       
    $statement->bindValue(1,$mem_id);
    $statement->execute();

    $member_new_cost = $statement ->fetch();

    // // if( $member_new_point){

        // print_r ($member_new_cost[0]);

        $costNum = $member_new_cost[0];

        if($costNum == null){

            $costNum = 0;

        }else{

            $costNum =  $costNum;

        }

        $cost =  $costNum + $member_current_cost[0];

        print_r ($cost);


    // //更新點數

    
    $update_cost = "UPDATE team1.member 
    SET member_cost = ? 
    WHERE member_id = ?";

    $statement_cost=$Util->getPDO()->prepare($update_cost);
    $statement_cost->bindValue(1, $cost);
    $statement_cost->bindValue(2,$mem_id);
    $statement_cost->execute();


    // echo point update

    echo'消費金額更新成功';

        
    

   


} catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
  }
?>