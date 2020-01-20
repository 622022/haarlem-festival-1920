<?php
    require_once("../lib/dal.php");
    require_once("../model/event-model.php");

    class eventService {
        private static $instance;
        private $dal;

        public function __construct() {
            $this->dal = dataLayer::getInstance();
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new eventService() : self::$instance;
        }

        public function getAllEvents() { // UNFINISHED
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                if (!$this->dal->doesUserExist($email)) {
                    try {
                        return $this->dal->registerUser(new User($email, $fullname, $password));
                    } catch(Exception $e) {
                        echo($e);
                    }
                }
            } else {
                throw new Exception("Invalid email format");
            }
        }

        public function getFullName($email) {
            return $this->dal->getFullName($email);
        }
    }
?>