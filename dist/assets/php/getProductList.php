<?php
try {
 include("./Lib/Conn.php");
 $Util = new UtilClass();

    $sql = "SELECT * FROM product";

    $statement = $Util->getPDO()->prepare($sql);
    $statement->execute();

    //抓出全部且依照順序封裝成一個二維陣列
    $data = $statement->fetchAll();
    if($data){
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>