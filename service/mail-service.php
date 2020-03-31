<?php
    require_once(__DIR__ . "/../lib/mail.php");

    class mailService {
        private static $instance;
        private $mail;

        public function __construct() {
            $this->mail = Mail::getInstance();
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new mailService() : self::$instance;
        }

        public function sendPdf($doc) {
			$this->mail->sendPdfMail($doc); 
        }
        
        //use this to send your forget password email and send values accordingly
        public function sendNormalEmail(){
            $this->mail->sendNormalMail();
        }

    }
?>