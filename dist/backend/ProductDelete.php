<?php
include("logincheck.php");

//取得GET過來的值
$PID = $_GET["PID"]; //PK

//建立SQL
$sql = "DELETE FROM `team1`.`product` WHERE `product_id` = ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->bindValue(1, $PID);
$statement->execute();

//導頁
echo "<script>alert('商品已刪除!'); location.href = 'commodity.php';</script>";
