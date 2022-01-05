<?php
include("head.php");
include 'logincheck.php';

//建立SQL---->會員----------------------
$sql = "SELECT * FROM `team1`.`member` WHERE `member_id` = ?";
//執行
$statement = $Util->getPDO()->prepare($sql);
//給值
$statement->bindValue(1, $_GET["MID"]);
$statement->execute();
$data = $statement->fetchAll();

?>
<html>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>會員詳細</title>
</head>

<body>
@@include('./base.html')
  <div class="content">
    <div class="block-responsive">
      <?php
      foreach ($data as $index => $row) {
      ?>
        <main>
          <form method="post" action="memberUpdateR.php" enctype="multipart/form-data">
            <div class="update mb-4">
              <p>會員姓名：</p>
              <input disabled="disabled" type="text" name="name" id="" value="<?= $row["member_name"] ?>">
            </div>
            <div class="update mb-4">
              <p>會員帳號（信箱）：</p>
              <input type="text" name="email" value="<?= $row["member_account"] ?>">
            </div>
            <div class="update mb-4">
              <p>聯絡號碼：</p>
              <input type="text" name="phone" id="" value="<?= $row["member_phone"] ?>">
            </div>
            <div class="update mb-4">
              <p>聯絡地址：</p>
              <input type="text" name="address" id="" value="<?= $row["member_address"] ?>">
            </div>
            <div class="update mb-4">
              <p>會員狀態：</p>
              <select disabled="disabled" name="memberType" id="" value="">
                <?php
                $type = $row["member_type"];
                switch ($type) {
                  case '1':
                    $type = "封鎖";
                    break;
                  default:
                    $type = "開通";
                    break;
                }
                ?>
                <option value="<?= $type ?>"><?= $type ?></option>
                <option value="0">開通</option>
                <option value="1">封鎖</option>
              </select>

            </div>
            <input type="hidden" name="MID" value="<?= $row["member_id"] ?>" />

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