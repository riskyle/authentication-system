<?php
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Mail
{
    public string $email, $name, $subject, $body;

    public function mailer()
    {
        $mail = new PHPMailer(true);

        try {
            // $mail->SMTPDebug = 2;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = env("MAIL_USERNAME");
            $mail->Password   = env("MAIL_PASSWORD");
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('security@gmail.com', 'Body Guard');
            $mail->addAddress($this->email, $this->name);

            $mail->isHTML(true);
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            $mail->AltBody = 'Body in plain text for non-HTML mail clients';
            $mail->send();
            // echo "Mail has been sent successfully!";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    public function send(string $email, string $name, string $subject, string $body)
    {
        $this->email = $email;
        $this->name =  $name;
        $this->subject =  $subject;
        $this->body =  $body;

        $this->mailer();
    }
}
