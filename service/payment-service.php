<?php
    require_once(__DIR__ . "/../lib/dal.php");

    class paymentService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
        }

         // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new paymentService() : self::$instance;
        }

        public function storePayment($method,$status,$details) {
            return $this->dal->insertPayment($method,$status,$details);
        }
    }
?>