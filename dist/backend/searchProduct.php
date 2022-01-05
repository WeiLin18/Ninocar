<?php
include("logincheck.php");

//取得POST過來的值
$textbox = $_POST["textbox"];

//建立SQL
$sql = "SELECT * FROM `team1`.`product` WHERE (`product_name` like ?) OR (`product_ename` like ?)";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->bindValue(1, '%' . $textbox . '%');
$statement->bindValue(2, '%' . $textbox . '%');
$statement->execute();

$data = $statement->fetchAll();

foreach ($data as $index => $row) {

  echo  '<tr>' . '<td>' . $row["product_name"] . '</td>';
  echo  '<td>' . '<a href="productDetail.php?PID=' . $row["product_id"] . '">';
  if ($row["product_year"] == 2021) {
    echo  '<img src="../../upload/' . $row['product_img'] . '" alt="">';
  } else {
    echo  '<img src="' . $row['product_img'] . '" alt="">';
  }
  echo  '</a>' . '</td>';
  // echo  '<td>' . '<img src="' . $row['product_img'] . '" alt="">' . '</td>';
  $series = $row["product_series"];
  switch ($series) {
    case '1':
      $series = "工程系";
      break;
    case '2':
      $series = "RV休旅系";
      break;
    case '3':
      $series = "計程車系";
      break;
    case '4':
      $series = "巴士系";
      break;
    case '5':
      $series = "警車系";
      break;
    case '6':
      $series = "消防救護系";
      break;
    case '7':
      $series = "轎車系";
      break;
    default:
      $series = "PREMIUM系";
      break;
  }
  echo  '<td>' . $series . '</td>';
  echo  '<td>' . $row["product_price"] . '</td>';
  echo  '<td>' . $row["product_points"] . '</td>';
  $type = $row["product_type"];
  switch ($type) {
    case '1':
      $type = "未上架";
      break;
    case '2':
      $type = "刪除";
      break;
    default:
      $type = "上架";
      break;
  }
  echo  '<td>' . $type . '</td>' . '</tr>';
}
