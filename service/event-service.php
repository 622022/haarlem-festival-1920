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
					$this->generateEventCard($event)
				);
			}

			return $eventCards;
		}

		private function generateEventCard($event) {
			return "
			<section class=\"eventcard\">
			  <div class = \"box-container\">
				<img src=\"{$event->imageUrl}\" alt=\"$event->imageDescription\">
				<h2>€{$event->price}</h2>
				<button div id=\"addbtn\" type=\"button\" name=\"add-$event->id\"action=\"controller/cart-controller.php?eventId=$event->id\">ADD</button>
				<h3>BACK2BACK by {$event->artist}</h3>
				<h4>{$event->programmeItem->location}</h4>
				<h4>{$event->programmeItem->startTime}-{$event->programmeItem->endTime}</h4>
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