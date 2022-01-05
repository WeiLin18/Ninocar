<?php
include 'logincheck.php';

//取得POST過來的值
$MID = $_POST["MID"]; //會員編號
$email = $_POST["email"]; //會員帳號（信箱）
$phone = $_POST["phone"]; //聯絡號碼
$address = $_POST["address"];   //聯絡地址
$memberType = $_POST["memberType"];   //會員等級（0：預設一般 1：黃金 2：白金）

//返回訊息文字
$message = "變更成功!";

//建立SQL
$sql = "UPDATE `team1`.`member` set `member_type` = ? WHERE `member_id` = ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值    
$statement->bindValue(1, $memberType);
$statement->bindValue(2, $MID);
$statement->execute();


//導頁
echo "<script>alert('" . $message . "'); location.href = 'member.php';</script>";
