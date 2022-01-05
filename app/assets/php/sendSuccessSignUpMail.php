<?php

try {

  require_once("./PHPMailer/PHPMailerAutoload.php");
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

  $mail->FromName = "NiNO CAR"; //此顯示寄件者名稱

  $mail->Subject = "註冊成功"; //信件主旨

  $mail->Body = '
  <div class="top" style="color:#522613;border-bottom:4px solid #FADD61;margin:auto;text-align:center;width: 600px;padding:10px 0px">
    <h1 class="logo__h1">NiNO CAR</h1>
  </div>
  <div class="body" style="margin:auto;text-align:left;width:600px">
    <div class="title" style="padding:30px;padding-right:30px;font-size:20px;color:#333333;text-align:center;font-family:Microsoft JhengHei">
      <strong>註冊成功通知</strong>
    </div>
  </div>
  <div class="text" style="color:#333333;font-weight:bold;font-size:16px;padding:30px;background-color:#ffffff;width: 600px;
  margin: auto;margin-bottom: 50px;">
    <div style="padding: 0px 30px">
      恭喜您成為新會員。<br />
      期望帶給您愉快的購物體驗，尋獲想要的商品。<br /><br />再次感謝您成為我們的新會員。
    </div>
  </div>
  <div class="bottom" style="color:#522613;width:600px;margin:auto;background-color:white;padding-top: 30px;
  border-top: 4px solid #FADD61;">
    <div style="padding:0px 30px 30px 30px;Font-size:14px">
      如有任何問題，歡迎透過 NiNO CAR 客服信箱 ninocar2021@gmail.com 與我們連繫!<br />
      敬祝 購物愉快<br />
      NiNO CAR 購物網服務團隊
    </div>
  </div>
  <footer style="background-color:#FADD61;width:600px;margin:auto;margin-bottom:50px;padding:30px 0px">
    <div class="button" style="text-align:center">
      <span>
        <a href="" style="text-decoration:none">
          <img src="https://ci4.googleusercontent.com/proxy/pKg7MgyN-DcW4K8kJaxGhbPQwkyLvhedJp7pEU-HBwXF7dDYeePcZzYrviDDDjF9k8AaJ5zXomCSe0uzd8zsX-yKKheBPa8h3Wi8vF-IXKywvJYEBOGNprUGbin7u47OhgXxmcPDI2b_QcI=s0-d-e1-ft#https://cdn-static.tibame.com/defaultImages/email_format/Artboard%E2%80%93Home3%403x.png" width="26" height="26" class="CToWUd" style="Color:#522613">
          <strong style="Font-size:14px;Color:#522613;vertical-align:7px">NiNO CAR 官網</strong>
        </a>
      </span>
    </div>
  </footer>
  ';   //信件內容

  $mail->IsHTML(true);

  // 收件人
  $data = json_decode(file_get_contents("php://input"));
  $mem_email = $data->account;


  $mail->AddAddress($mem_email, "新會員"); //此為收件者的電子信箱及顯示名稱

  // 顯示訊息

  if (!$mail->Send()) {

    echo "Mail error: " . $mail->ErrorInfo;
  } else {

    echo "Mail sent";
  }
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
