<?php
  include("./Lib/Conn.php");//建立資料庫連線
  $Util = new UtilClass();


  $allIndex = $_POST['allIndex'];  //prodct_id
  $workName = $_POST['workName']; //product_name OK
  $inspiration = $_POST['inspiration']; //product_des OK
  $workPostTime = $_POST['workPostTime']; //board_id
  $workPrice = $_POST['workPrice']; //OK
  // $userNickName = $_POST['userNickName'];  //好像用不到?
  $imgPath = $_POST['imgPath']; //OK
  $memberId = $_POST['memberId'];//OK



  //建立SQL，將試著將資料寫入資料庫
  // $sql = "INSERT INTO customize(board_id, member_id, product_name, product_img, product_price, product_des, product_type) VALUES (1, '".$memberId."', '".$workName."','".$imgPath."', '".$workPrice."', '".$inspiration."', 0)";

  $sql = "INSERT INTO `product` (`product_name`, `product_ename`, `product_img`, `product_series`, `product_spec`, `product_seriesid`, `product_price`, `product_des`, `product_type`) VALUES('".$workName."', 'CUSTOMIZED PRODUCT', '".$imgPath."', 8, 5, '".$allIndex."', '".$workPrice."', '".$inspiration."', 0)";

  // $statement0=$Util->getPDO()->prepare($sql0);
  $statement=$Util->getPDO()->prepare($sql);

  // $statement0->execute();
  $statement->execute();

?>


