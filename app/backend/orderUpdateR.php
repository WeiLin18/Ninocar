<?php
include 'logincheck.php';

//取得POST過來的值
$OID = $_POST["OID"]; //訂單編號
$date = $_POST["date"]; //訂單日期
$MID = $_POST["MID"]; //會員編號
$price = $_POST["price"];   //訂單金額
$point = $_POST["point"];   //訂單點數
$deliverType = $_POST["deliverType"];   //貨物狀態（0：處理中 1：出貨中 2：已送達）
$price = $_POST["price"];   //商品價格
$orderType = $_POST["orderType"];   //訂單狀態（0：成立 1：取消）

//返回訊息文字
$message = "變更成功!";

//建立SQL
$sql = "UPDATE `team1`.`order` set `deliver_type` = ?, `order_type` = ?, `type_date` = NOW() WHERE `order_id` = ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值    
$statement->bindValue(1, $deliverType);
$statement->bindValue(2, $orderType);
$statement->bindValue(3, $OID);
$statement->execute();


//導頁
echo "<script>alert('" . $message . "'); location.href = 'order.php';</script>";
