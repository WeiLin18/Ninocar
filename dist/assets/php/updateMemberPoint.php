<?php


try {


    include("./Lib/Conn.php");
    $Util = new UtilClass();


    $mem_id =  $_POST['ID'];  
    $order_id =  $_POST['ORDER_ID'];  

  

    //更新會員累積消費


    //抓取目前會員訂單消費點數

    $sql_member_point= "SELECT order_points  FROM `order` WHERE member_id=? and order_id = ?  GROUP BY member_id";
    $member_point=$Util->getPDO()->prepare( $sql_member_point);
    $member_point->bindValue(1,$mem_id);
    $member_point->bindValue(2,$order_id);
    $member_point->execute();
    $member_current_cost_point = $member_point ->fetch();

    
 

    // print_r ($member_current_cost_point[0]);


    //     if($member_current_cost_point[0]== null){

    //         $member_current_cost_point[0] = 0;

    //     }else{

    //         $member_current_cost_point[0] = $member_current_cost_point[0];

    //     }

    // }

     //抓取目前會員訂單獲得點數


    $sql_gain_point= "SELECT order_gain  FROM `order` WHERE member_id=? and order_id = ? ";
    $member_gain_point=$Util->getPDO()->prepare($sql_gain_point);
    $member_gain_point->bindValue(1,$mem_id);
    $member_gain_point->bindValue(2,$order_id);
    $member_gain_point->execute();
    $member_current_gain_point = $member_gain_point ->fetch();

   
    // print_r ($member_current_gain_point[0]);

        // if( $member_current_gain_point[0] ==""){

        //    $member_current_gain_point[0] = 0;

        // }else{

        //    $member_current_gain_point[0] =$member_current_gain_point[0];

        // }

    // // 抓取會員擁有點數

    $sql = "SELECT member_points FROM member 

    where member_id=?";


    $statement = $Util->getPDO()->prepare($sql);
       
    $statement->bindValue(1,$mem_id);
    $statement->execute();

    $member_new_point = $statement ->fetch();

    // if( $member_new_point){

        // print_r ($member_new_point[0]);

        $points = $member_new_point[0] - $member_current_cost_point[0] + $member_current_gain_point[0];

        // print_r ($points);


    // //更新點數

    
    $update_point = "UPDATE team1.member 
    SET member_points = ? 
    WHERE member_id = ?";

    $statement_point=$Util->getPDO()->prepare($update_point);
    $statement_point->bindValue(1,$points);
    $statement_point->bindValue(2,$mem_id);
    $statement_point->execute();


    // echo point update

    echo'點數更新成功';

        
    // }

   


} catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
  }
?>