<?php
    require_once(__DIR__ . "/../lib/dal.php");
    require_once(__DIR__ . "/../model/event-model.php");
	require_once(__DIR__ . "/../model/programmeItem-model.php");

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
		
		public function generateEventCards($eventType) {
			$events = $this->getAllEvents(1);
	  
			$eventCards = [];

			foreach($events as &$event) {
				array_push($eventCards, 
					$this->generateEventCard(
						$event->artist,
						$event->price,
						$event->programmeItem->location,
						$event->programmeItem->startsAt,
						$event->programmeItem->endsAt,
						"imageUrl", // PLACEHOLDER
						"imageDescription" // PLACEHOLDER
					)
				);
			}

			return $eventCards;
		}

		private function generateEventCard($artist, $price, $location, $startTime, $endTime, $imageUrl, $imageDescription) {
			return "
			<section class=\"eventcard\">
			  <div id = \"box-container\">
				<img src=\"{$imageUrl}\" alt=\"$imageDescription\">
				<h2>€{$price}</h2>
				<button div id=\"addbtn\" type=\"button\">ADD</button>
				<h3>BACK2BACK by {$artist}</h3>
				<h4>{$location}</h4>
				<h4>{$startTime}-{$endTime}</h4>
			</section>
			";
		}

		public function getAllEvents($eventType) {
			$danceEvents = $this->dal->getEvents(1);
			$jazzEvents = $this->dal->getEvents(2);
			$foodEvents = $this->dal->getEvents(3);
			return array_merge($danceEvents, $jazzEvents, $foodEvents);
		}
	}
?>