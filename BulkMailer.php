<?php
require 'phpmailer/PHPMailerAutoload.php';

/**
 * 
 * @author Short N Sharp
 *
 */
class BulkMailer
{
    /**
     * Send bulk email with the given parameters
     * @param string $host
     * @param string $username
     * @param string $password
     * @param string $senderEmail
     * @param string $senderName
     * @param array $recipients with $name as the key and $email as the value 
     * @param string $subject
     * @param string $message
     * @return string $sentFlag
     */
    public function bulkEmail(
        $host, 
        $username, 
        $password, 
        $senderEmail,
        $senderName,
        array $recipients,
        $subject,
        $message
        )
    {
        $names = array_key($recipients);
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $host;
        $mail->SMTPAuth = true;
        $mail->Username = $username;
        $mail->Password = $password;
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom($senderEmail, $senderName);
        
        foreach ($names as $name)
        {
            $email = $recipients[$name];
            $mail->addAddress($email, $name);
        }
        
        $mail->Subject = $subject;
        $mail->Body = $message;
        
        if(!$mail->send()) {
            echo "Mailer Error:".$mail->ErrorInfo;
            $sentFlag = "False";
        } else {            
            $sentFlag = "True";
        }
        return $sentFlag;
    }
}
?>