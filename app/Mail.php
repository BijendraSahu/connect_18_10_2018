<?php
/**
 * Created by Bijendra Sahu.
 * User: dubeyamit
 * Date: 27-01-2017
 * Time: 06:58 PM
 */

namespace App;


class Mail
{
    public $to;
    public $subject;
    public $body;

    public function send_mail()
    {
        if (!class_exists("phpmailer")) {
            require_once('class.phpmailer.php');
        }
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = false;
//        $mail->Host = 'smtpout.secureserver.net:80';
        $mail->Host = 'localhost';
        $mail->Username = 'info@connecting-one.com';
        $mail->Password = 'zmxncbv*123#';
        $mail->From = $mail->Username;
        $mail->FromName = "Connecting-one - Support Team";
        foreach (explode(",", $this->to) as $recepient)
            $mail->AddAddress($recepient);
        $mail->Subject = $this->subject;
        $mail->Body = $this->body;
        $mail->IsHTML(true);
        $mail->Port = 25;
        if (!$mail->Send()) {
            return false;

        } else {
            return true;
        }
    }
}