<?php
try {
      include("./Lib/Conn.php");
      $Util = new UtilClass();

      $product_id =  $_POST['PRODUCT_ID'];  


      $sql = "SELECT * FROM product 

      where product_id=?";


      $statement = $Util->getPDO()->prepare($sql);
          
      $statement->bindValue(1,$product_id);
      $statement->execute();

      //抓出全部且依照順序封裝成一個二維陣列
      $data = $statement->fetchAll(PDO::FETCH_ASSOC);
      if($data){
          echo json_encode($data, JSON_UNESCAPED_UNICODE);
 }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>