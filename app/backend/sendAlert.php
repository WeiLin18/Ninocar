<?php
include("LoginCheck.php");

//取得POST過來的值
$CID = $_POST["CID"];

//建立SQL
$sql = "UPDATE `team1`.`comment` set `comment_type` = 1 WHERE `comment_id` = ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->bindValue(1, $CID);
$statement->execute();

try {
  //取得POST過來的值
  $CID = $_POST["CID"];

  //建立SQL
  $sql = "SELECT * FROM comment WHERE `comment_id` = ?";

  //執行
  $statement = $Util->getPDO()->prepare($sql);

  //給值
  $statement->bindValue(1, $CID);
  $statement->execute();
  $data = $statement->fetchAll();

  foreach ($data as $index => $row) {
    echo '<td>' . $row["board_id"] . '</td>';
    echo '<td>' . $row["member_id"] . '</td>';
    echo '<td>' . $row["comment_content"] . '</td>';
    $type = $row["comment_type"];
    switch ($type) {
      case '1':
        $type = "封鎖";
        break;
      default:
        $type = "正常";
        break;
    }

    echo '<tr>' . '<td>' . $type . '</td>';
    echo '<input type="hidden" name="CID" value="' . $row["comment_id"] . '"/>';
    echo '<input type="hidden" name="MID" value="' . $row["member_id"] . '"/>';
    echo '<td>' . '<button type="button" class="alert" id="' . $row["member_id"] . '">' . '<i class="fas fa-exclamation-circle">' . '</i>' . '</button>' . '</td>';
    echo '<td>' . '<a href="commentUpdate.php?CID=' . $row["comment_id"] . '">' . '查看' . '</a>' . '</td>' . '</tr>';
  }
} catch (PDOException $e) {
  echo 'Connection failed: ' . $e->getMessage();
}

require_once("../assets/php/PHPMailer/PHPMailerAutoload.php");

//取得POST過來的值
$MID = $_POST["MID"];

//建立SQL
$sql = "SELECT * FROM member WHERE `member_id` = ?";

//執行
$statement = $Util->getPDO()->prepare($sql);

//給值
$statement->bindValue(1, $MID);
$statement->execute();

$data = $statement->fetchAll();

foreach ($data as $index => $row) {

  $email = $row["member_account"];

  // 產生 Mailer 實體

  $mail = new PHPMailer();

  // 設定為 SMTP 方式寄信

  $mail->IsSMTP();

  // SMTP 伺服器的設定，以及驗證資訊

  $mail->Host = "smtp.gmail.com";

  $mail->Port = 465;

  $mail->SMTPAuth = true;

  $mail->SMTPSecure = 'ssl';

  $mail->SMTPDebug = SMTP::DEBUG_SERVER;

  $mail->SMTPOptions = array(
    'ssl' => array(
      'verify_peer' => false,
      'verify_peer_name' => false,
      'allow_self_signed' => true
    )
  );

  // 信件內容的編碼方式       

  $mail->CharSet = "utf-8";

  // 信件處理的編碼方式

  $mail->Encoding = "base64";

  // SMTP 驗證的使用者資訊

  $mail->Username = "ninocar2021@gmail.com";  //mail的帳號（需要完整的mail帳號，含@後都要填寫）

  $mail->Password = "team1ninocar";  //密碼

  // 信件內容設定  

  $mail->From = "ninocar2021@gmail.com"; //需要與上述的使用者資訊相同mail

  $mail->FromName = "NINO CAR"; //此顯示寄件者名稱

  $mail->Subject = "警告"; //信件主旨

  $mail->Body = '
  <div class="top" style="border-bottom:4px solid #E59807;margin:auto;text-align:center;width: 600px;padding:30px 0px">
  <h1 class="logo__h1">NiNO CAR</h1>
</div>
<div class="body" style="margin:auto;text-align:left;width:600px">
  <div class="title" style="padding:30px;padding-right:30px;font-size:20px;color:rgba(0,0,0,8);text-align:center;font-family:Microsoft JhengHei">
    <strong>警告信</strong>
  </div>
  <div class="text" style="font-size:16px;margin-bottom:30px;padding:30px;background-color:#ffffff">
    您的留言已被封鎖。<br />
    請注意不要發布攻擊性言語或妨礙他人觀感的留言。<br /><br />感謝配合。
  </div>
  <hr style="background-color: #E59807;margin-bottom: 30px;">
  <div class="bottom" style="width:600px;margin:auto;background-color:white;color:rgba(0,0,0,0.8)">
    <div style="padding:0px 30px 30px 30px;Font-size:14px">
      如有任何問題，歡迎透過 NiNO CAR 客服信箱 ninocar2021@gmail.com 與我們連繫!<br />
      敬祝 購物愉快<br />
      NiNO CAR 購物網服務團隊
    </div>
  </div>
</div>
<footer style="background-color:#E59807;width:600px;margin:auto;margin-bottom:50px;padding:30px 0px">
  <div class="button" style="text-align:center">
    <span>
      <a href="" style="text-decoration:none">
        <img src="https://ci4.googleusercontent.com/proxy/pKg7MgyN-DcW4K8kJaxGhbPQwkyLvhedJp7pEU-HBwXF7dDYeePcZzYrviDDDjF9k8AaJ5zXomCSe0uzd8zsX-yKKheBPa8h3Wi8vF-IXKywvJYEBOGNprUGbin7u47OhgXxmcPDI2b_QcI=s0-d-e1-ft#https://cdn-static.tibame.com/defaultImages/email_format/Artboard%E2%80%93Home3%403x.png" width="26" height="26" class="CToWUd">
        <strong style="Font-size:14px;Color:#ffffff;vertical-align:7px">NiNO CAR 官網</strong>
      </a>
    </span>
  </div>
</footer>
';   //信件內容

  $mail->IsHTML(true);


  // 收件人

  $mail->AddAddress($email, "會員"); //此為收件者的電子信箱及顯示名稱

  //寄送
  // $mail->Send()

  // 顯示訊息

  if (!$mail->Send()) {

    echo "Mail error: " . $mail->ErrorInfo;
  } else {

    echo "Mail sent";
  }
}
