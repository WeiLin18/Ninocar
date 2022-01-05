<?php
include("logincheck.php");

//取得POST過來的值
$textbox = $_POST["textbox"];

//建立SQL
$sql = "SELECT * FROM `team1`.`member` WHERE `member_name` like ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->bindValue(1, '%' . $textbox . '%');
$statement->execute();

$data = $statement->fetchAll();

foreach ($data as $index => $row) {
  $level = $row["member_level"];
  switch ($level) {
    case '1':
      $level = "黃金";
      break;
    case '2':
      $level = "白金";
      break;
    default:
      $level = "一般";
      break;
  }
  echo '<td>' . $level . '</td>';
  echo '<td>' . '<a href="memberDetail.php?MID=' . $row["member_id"] . '">' . $row["member_name"] . '</a>' . '</td>';
  $type = $row["member_type"];
  switch ($type) {
    case '1':
      $type = "封鎖";
      break;
    default:
      $type = "開通";
      break;
  }
  echo '<td>' . $type . '</td>';
  echo '<td>' . $row["member_signdate"] . '</td>';
  echo '<input type="hidden" name="MID" value="' . $row["member_id"] . '" />';
  echo '<td>' . '<button type="button"' . ' class="alert" id="' . $row["member_id"] . '">' . '<i class="fas fa-ban"></i>' . '</button></td>';
  echo '<td>' . '<button type="button"' . ' class="return" id="' . $row["member_id"] . '">' . '<i class="fas fa-unlock"></i>' . '</button></td>' . '</tr>';
}
