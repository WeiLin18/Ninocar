<?php

try {
  include("./Lib/UtilClass.php");
  $Util = new UtilClass();


  $data = json_decode(file_get_contents("php://input"));
  $mem_email = $data->account;
  $mem_password = $data->password;


  $sql = "INSERT INTO member(member_account, member_pwd, member_name, member_signdate) VALUES (?,?,'匿名',NOW())";
  $statement = $Util->getPDO()->prepare($sql);


  $statement->bindValue(1, $mem_email);
  $statement->bindValue(2, $mem_password);
  $statement->execute();
  //  echo "Connected Successfully";
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

try {
  $sql = "SELECT member_id FROM member WHERE  member_account = ? and member_pwd = ?";
  $statement = $Util->getPDO()->prepare($sql);


  $statement->bindValue(1, $mem_email);
  $statement->bindValue(2, $mem_password);
  $statement->execute();
  $data = $statement->fetchAll();
  echo json_encode($data, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}

?>