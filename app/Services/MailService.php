<?php
/**
 * MailService
 */
namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class MailService
{

    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer();

        if (DEBUG){
            $this->mail->SMTPDebug = SMTP::DEBUG_SERVER;
        }
        if (MAIL_PROVIDER == 'smtp') {
            $this->mail->isSMTP();
            $this->mail->Host = MAIL_SMTP_HOST;
            $this->mail->SMTPAuth = true;
            $this->mail->Username = MAIL_SMTP_USERNAME;
            $this->mail->Password = MAIL_SMTP_PASSWORD;
            $this->mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $this->mail->Port = MAIL_SMTP_PORT;
        }
    }

    /**
     *
     * @param String $from
     * @param String $fromName
     * @param String $to
     * @param String $toName
     * @param String $subject
     * @param String $body
     * @return Boolean
     */
    public function sendmail(String $from, String $fromName, String $to, String $toName, String $subject, String $body, Bool $html = FALSE)
    {
        if ($html) {
            $this->mail->isHTML(TRUE);
        }
        $this->mail->setFrom($from, $fromName);
        $this->mail->addAddress($to, $toName);
        $this->mail->Subject = $subject;
        $this->mail->Body = $body;

        return $this->mail->send();
    }
}