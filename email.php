<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require './autoload.php';
if (isset($_POST["email"])) {
    # code...
    $email = $_POST['email'];
    $pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
    if(!preg_match($pattern, $email, $matches)){
        echo "<script>history.back(-1);alert('请从新输入')</script>";
    }
}else {
    echo "<script>history.back(-1);alert('请从新输入')</script>";
}
    $filename = "./.env";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize ($filename));
    $array =  explode("\r\n", $contents);
    $User_list = [];
    foreach ($array as $key => $value) {
      $values = explode('=',$value);
      $User_list[] = $values[1];
    }
    $Username = $User_list[0];
    $Possword = $User_list[1];
    fclose($handle);

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->CharSet = "UTF-8"; // 设置字符集编码 utf-8
    $mail->Host = 'smtp.163.com;';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = "$Username";                 // SMTP username
    $mail->Password = "$Possword";                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 994;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('$Username', '');
    $mail->addAddress($matches['0'], '');     // Add a recipient 

    //Attachments
    // $mail->addAttachment('');         // Add attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "=?UTF-8?B?" . base64_encode("苗忻简历") . "?=";
    $mail->Body    = '您好这是我的简历';

    $mail->send();
     echo "<script>alert('发送成功');history.back(-1);</script>";
} catch (Exception $e) {
    echo '邮件啊没有能成功发送';
}