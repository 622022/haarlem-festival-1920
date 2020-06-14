<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . "/config/credentials-example.php");
    require_once($_SERVER['DOCUMENT_ROOT'] . "/model/event-model.php"); 
    require_once($_SERVER['DOCUMENT_ROOT'] ."/APIs/PHPmailer/PHPMailerAutoload.php");

    // needs some cleaning
    

    class Mail {
        private static $instance;
        private $mail;

        public function __construct() { 
            self::$instance = $this; 
        }

        public static function getInstance() {
            return !self::$instance ? new Mail() : self::$instance;
        }

        //stuff can be made into a function for easier and better version later
        public function sendPdfMail($doc,$email){
            try {
                //Server settings
                $mail = new PHPMailer(true);
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'jumbomumbo399@gmail.com';                     // SMTP username
                $mail->Password   = 'Haarlem123!';                               // SMTP password
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //using a throwaway acocunt to test for now
                $mail->setFrom('jumbomumbo399@gmail.com', 'Mailer');
                //specify users to send to
                $mail->addAddress($email, 'Joe User');     // Add a recipient
                

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Haarlem festival tickets receipt.';
                $mail->Body    = 'We wish you a fun time! <b>at Haarlem Festival!</b>';
                $mail->addStringAttachment($doc,'details.pdf');
                // $mail->Send();

                $mail->send();
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }

        //use this for forget password and change stuff accordingly
        public function sendNormalMail(){
            try {
                //Server settings
                $mail = new PHPMailer(true);
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'jumbomumbo399@gmail.com';                     // SMTP username
                $mail->Password   = 'Haarlem123!';                               // SMTP password
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //using a throwaway acocunt to test for now
                $mail->setFrom('jumbomumbo399@gmail.com', 'Mailer');
                //specify users to send to
                $mail->addAddress('joe@gmail.com', 'Joe User');     // Add a recipient
                

                // Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Here is the subject';
                $mail->Body    = 'This is the HTML message body';
                // $mail->addStringAttachment($doc,'details.pdf');
                $mail->Send();

                
                //echo 'Message has been sent';
            } catch (Exception $e) {
                //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }


            
    }
?>