<?php
include("head.php");
include 'logincheck.php';

//建立SQL---->訂單----------------------
$sql = "SELECT * FROM `team1`.`order` WHERE `order_id` = ?";
//執行
$statement = $Util->getPDO()->prepare($sql);
//給值
$statement->bindValue(1, $_GET["OID"]);
$statement->execute();
$data = $statement->fetchAll();

?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>訂單詳細</title>
</head>

<body>
@@include('./base.html')
  <div class="content">
    <div class="block-responsive">
      <?php
      foreach ($data as $index => $row) {
      ?>
        <main>
          <form method="post" action="orderUpdateR.php" enctype="multipart/form-data">
            <div class="update mb-4">
              <p>訂單日期：</p>
              <input disabled="disabled" type="text" name="date" id="name" value="<?= $row["order_date"] ?>">
            </div>
            <div class="update mb-4">
              <p>會員編號：</p>
              <input disabled="disabled" type="text" name="MID" value="<?= $row["member_id"] ?>">
            </div>
            <div class="update mb-4">
              <p>訂單金額：</p>
              <input disabled="disabled" type="text" name="price" value="<?= $row["order_cost"] ?>">
            </div>
            <div class="update mb-4">
              <p>訂單點數：</p>
              <input disabled="disabled" type="text" name="point" id="price" value="<?= $row["order_points"] ?>">
            </div>
            <div class="update mb-4">
              <p>貨物狀態：</p>
              <select name="deliverType" id="" value="">
                <?php
                $type = $row["deliver_type"];
                switch ($type) {
                  case '1':
                    $type = "出貨中";
                    break;
                  case '2':
                    $type = "已送達";
                    break;
                  default:
                    $type = "處理中";
                    break;
                }
                ?>
                <option value="<?= $row["deliver_type"] ?>"><?= $type ?></option>
                <option value="0">處理中</option>
                <option value="1">出貨中</option>
                <option value="2">已送達</option>
              </select>
            </div>
            <div class="update mb-4">
              <p>貨物狀態：</p>
              <select name="orderType" id="" value="">
                <?php
                $type = $row["order_type"];
                switch ($type) {
                  case '1':
                    $type = "取消";
                    break;
                  default:
                    $type = "成立";
                    break;
                }
                ?>
                <option value="<?= $row["order_type"] ?>"><?= $type ?></option>
                <option value="0">成立</option>
                <option value="1">取消</option>
              </select>
            </div>
            <input type="hidden" name="OID" value="<?= $row["order_id"] ?>" />

            <div class="update mb-5">
              <button type="submit" class="" onclick="return doSubmit();">送出</button>
            </div>
          </form>
        </main>
      <?php
      }
      ?>
    </div>
  </div>
</body>

</html>