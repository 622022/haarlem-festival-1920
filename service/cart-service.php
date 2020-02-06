<?php
    require_once(__DIR__ . "/../lib/dal.php");

    class cartService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
        }

         // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new cartService() : self::$instance;
        }

        public function getEventById($eventId) {
            return $dal->getEventById($eventId);
        }
    }
?>