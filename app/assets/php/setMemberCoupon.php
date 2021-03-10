<?php
 
 
 include("./Lib/Conn.php");
 $Util = new UtilClass();
   


    $mem_id =  $_POST['ID']; 
   

  
  //註冊立即啟用 3天倒數9折
    $sql = "INSERT INTO `member_coupon`(`member_cid`, `member_id`, `coupon_id`, `type_date`, `dead_date`, `coupon_type`) 
    VALUES (0,?,0,now(),now() + interval 3 day,1)";


    $statement=$Util->getPDO()->prepare($sql);
    $statement->bindValue(1,$mem_id);
    $statement->execute();

  // 註冊就是一般會員
    $sql = "UPDATE `member` SET `member_level` = '0',`member_upgradedate`= now() 
    WHERE `member`.`member_id` = ?";

    $statement=$Util->getPDO()->prepare($sql);
    $statement->bindValue(1,$mem_id);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    // $data = $statement->fetchAll();
 


    
  // 導出消費總金額

    $sql_member_level= "SELECT sum(order_cost) FROM `order` WHERE member_id=? GROUP BY member_id";

    $member_level=$Util->getPDO()->prepare( $sql_member_level);
    $member_level->bindValue(1,$mem_id);
    $member_level->execute();
    $member_level_cost = $member_level ->fetch(); 

    if( $member_level_cost){

      print_r ($member_level_cost[0]);
      // 累計消費2000元黃金會員
      if($member_level_cost[0]>=2000){

        $sql = "INSERT INTO `member_coupon`(`member_cid`, `member_id`, `coupon_id`, `type_date`, `dead_date`, `coupon_type`) 
        VALUES (0,?,1,now(),now() + interval 30 day,1)";
        
        $statement=$Util->getPDO()->prepare($sql);
         $statement->bindValue(1,$mem_id);
        $statement->execute();

        // 會員狀態更新 至 黃金
        $sql = "UPDATE `member` SET `member_level` = '1',`member_upgradedate`= now()  
        WHERE `member`.`member_id` = ?";

        $statement=$Util->getPDO()->prepare($sql);
        $statement->bindValue(1,$mem_id);
         $statement->execute();

      }


        //累計消費滿5000元白金會員

        if($member_level_cost[0]>=5000){

          $sql = "INSERT INTO `member_coupon`(`member_cid`, `member_id`, `coupon_id`, `type_date`, `dead_date`, `coupon_type`) 
          VALUES (0,?,2,now(),now() + interval 180 day,1)";
          
          $statement=$Util->getPDO()->prepare($sql);
           $statement->bindValue(1,$mem_id);
          $statement->execute();


        // 會員狀態更新 至 白金
        $sql = "UPDATE `member` SET `member_level` = '2',`member_upgradedate`= now() 
         WHERE `member`.`member_id` = ?";

        $statement=$Util->getPDO()->prepare($sql);
        $statement->bindValue(1,$mem_id);
         $statement->execute();
  
        }


    };


    $sql_member_birthday= "SELECT DATEDIFF(member_signdate, member_birthday) FROM member WHERE member_id =?";

    $member_birthday=$Util->getPDO()->prepare( $sql_member_birthday);
    $member_birthday->bindValue(1,$mem_id);
    $member_birthday->execute();
    $member_birthday_ary = $member_birthday ->fetch(); 

    //生日快到了 五折免運
    if( $member_birthday_ary){
      // 註冊與生日日期相減 取365天餘數 小於30天 就是生日月份
      if($member_birthday_ary[0]%365 <=30){
    
      
        $sql = "INSERT INTO `member_coupon`(`member_cid`, `member_id`, `coupon_id`, `type_date`, `dead_date`, `coupon_type`) 
        VALUES (0,?,3,now(),now() + interval 360 day,1)";
        
        $statement=$Util->getPDO()->prepare($sql);
         $statement->bindValue(1,$mem_id);
        $statement->execute();


      }



    };






    



    
?>