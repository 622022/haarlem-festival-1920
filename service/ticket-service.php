<?php
    require_once(__DIR__ . "/../lib/dal.php");
    require_once(__DIR__ . "/../model/ticket-model.php");

    class ticketService {
        private static $instance;
        private $dal;

        public function __construct() {
            self::$instance = $this; 
            $this->dal = dataLayer::getInstance();
		}

		// Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new ticketService() : self::$instance;
        }
        
        public function getTicket($uuid) {
            return $this->dal->getTicket($uuid);
        }

        public function ticketExists($uuid) {
            return $this->dal->ticketExists($uuid);
        }

        public function updateTicket($ticket) {
            return $this->dal->updateTicket($ticket);
        }
	}
?>