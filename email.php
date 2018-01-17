<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require './autoload.php';
    
function sendMail($email){
$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->CharSet = "UTF-8"; // 设置字符集编码 utf-8
    $mail->Host = 'smtp.163.com;';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = '';                 // SMTP username
    $mail->Password = '';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 994;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('', '');
    $mail->addAddress($email, '');     // Add a recipient 

    //Attachments

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "=?UTF-8?B?" . base64_encode("") . "?=";
    $mail->Body    = '';

    return $mail->send();
}
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'email';
try{
    $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM email_list WHERE status = '0'";
    $connn= $conn->query($sql);
}catch(Exception $e){
    echo $e;
}
foreach ($connn as $value) {
    if(sendMail($value['useremail'])){
    $sqli ="UPDATE email_list SET status = 1 WHERE id = '$value[id]'";
    $conn->exec($sqli);
    }
    sleep(3);
        
 }
        