<?php
    require_once(__DIR__ . "/../lib/dal.php");
    require_once(__DIR__ . "/../model/event-model.php");
	require_once(__DIR__ . "/../model/programmeItem-model.php");

    class eventService {
        private static $instance;
        private $dal;

        public function __construct() {
			self::$instance = $this; 
            $this->dal = dataLayer::getInstance();
		}

		// Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new eventService() : self::$instance;
		}

		public function getAllEvents($eventType) {
			$danceEvents = $this->dal->getEvents(1);
			$jazzEvents = $this->dal->getEvents(2);
			$foodEvents = $this->dal->getEvents(3);
			return array_merge($danceEvents, $jazzEvents, $foodEvents);
		}

		public function getSortedEvents($eventType){
			$danceEvents = $this->dal->sortEvents(1);
			$jazzEvents = $this->dal->sortEvents(2);
			$foodEvents = $this->dal->sortEvents(3);
			return array_merge($danceEvents, $jazzEvents, $foodEvents);
		}

		public function getEvent($eventId) {
			return $this->dal->getEventById($eventId);
		}

		public function updateEvent($event) {
			return $this->dal->updateEvent($event);
		}
	}
?>