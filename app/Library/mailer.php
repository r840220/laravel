<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/6/7
 * Time: 下午 02:15
 */

namespace shopping_mall\Library;

use PHPMailer;


class mailer
{
    protected $mail;

    public function __construct(){
        $this->mail = new PHPMailer();
        $this->mail->IsSMTP(); //設定使用SMTP方式寄信
        $this->mail->SMTPAuth = true; //設定SMTP需要驗證
        $this->mail->SMTPSecure = "ssl"; // Gmail的SMTP主機需要使用SSL連線
        $this->mail->Host = "smtp.gmail.com"; //Gamil的SMTP主機
        $this->mail->Port = 465; //Gamil的SMTP主機的埠號(Gmail為465)。
        $this->mail->CharSet = "utf-8"; //郵件編碼
        $this->mail->Username = "ncues0222008"; //Gamil帳號
        $this->mail->Password = "e601210E3211"; //Gmail密碼
        $this->mail->From = "ncues0222008@gmail.com "; //寄件者信箱
        $this->mail->FromName = "馬榮"; //寄件者姓名

    }

    public function send($email, $subject, $body)
    {
        $this->mail->AddAddress($email); //收件者郵件及名稱
        $this->mail->AddBCC("ncues0222008@gmail.com"); //設定 密件副本收件者
        $this->mail->Subject = $subject; //郵件標題
        $this->mail->Body = $body; //郵件內容
        $this->mail->IsHTML(true); //郵件內容為html
        if (!$this->mail->Send()) {

            echo "Error: " . $this->mail->ErrorInfo;

        } else {

            echo "<b>歡迎您加入會員</b>";
        }
    }
}