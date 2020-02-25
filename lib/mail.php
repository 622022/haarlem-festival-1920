<?php
    require_once(__DIR__ . "/../config/credentials.php");
    require_once(__DIR__ . "/../model/event-model.php"); 

    class dataLayer {
        private static $instance;
        private $conn;

        public function __construct() {
            $this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        // if this self instance then return new data layer otherwise ::(references constants or statics) do this
        public static function getInstance() {
            return !self::$instance ? new dataLayer() : self::$instance;
        }

        //call this from the login service and pass the email we get from the payment page?
        //this function to send after payment
        public function sendMail($to)
        {
            $to      = 'nobody@example.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = array(
            'From' => 'yomomma@example.com',
            'Reply-To' => 'yomomma@example.com',
            );

            mail($to, $subject, $message, $headers);
        }
        
        //when a user registers?
        public function sendRegisterMail($to)
        {
            $to      = 'nobody@example.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = array(
            'From' => 'yomomma@example.com',
            'Reply-To' => 'yomomma@example.com',
            );

            mail($to, $subject, $message, $headers);
        }


    }
?>