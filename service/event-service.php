<?php
    require_once("../lib/dal.php");
    require_once("../model/event-model.php");
	require_once("../model/programmeItem-model.php");

    class eventService {
        private static $instance;
        private $dal;

        private function __construct() {
            $this->dal = dataLayer::getInstance();
		}

		// Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new eventService() : self::$instance;
		}
		

	}
?>