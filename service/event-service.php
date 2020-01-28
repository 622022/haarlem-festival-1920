<?php
    require_once("../lib/dal.php");
    require_once("../model/event-model.php");
	require_once("../model/programmeItem-model.php");

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
			$events = $this->dal->getEvents($eventType);
	  
			foreach($events as &$event) {
			  $this->generateEventCard(
				$event->artist,
				$event->price,
				$event->programmeItem->location,
				$event->programmeItem->startsAt,
				$event->programmeItem->endsAt,
				"imageUrl", // PLACEHOLDER
				"imageDescription" // PLACEHOLDER
			  );
			} 
		}

		private function generateEventCard($artist, $price, $location, $startTime, $endTime, $imageUrl, $imageDescription) {
			echo ("
			<section class=\"eventcard\">
			  <div id = \"box-container\">
				<img src=\"{$imageUrl}\" alt=\"$imageDescription\">
				<h2>€{$price}</h2>
				<button div id=\"addbtn\" type=\"button\">ADD</button>
				<h3>BACK2BACK by {$artist}</h3>
				<h4>{$location}</h4>
				<h4>{$startTime}-{$endTime}</h4>
			</section>
			");
		}
	}
?>