<?php
	require_once(__DIR__ . "/../../service/event-service.php");
	$eventService = eventService::getInstance();  

	$events = $eventService->getAllEvents(1);
	
	
	function generateEventCard($event) {
		return "
		<section class=\"eventcard\" name=\"eventcard-$event->id\">
		  <div class=\"box-container\">
		  <img src=\"{$event->image->url}\" alt=\"{$event->image->description}\">
		  <h2>€{$event->price}</h2>
		  <button class=\"addbtn\" type=\"button\" name=\"add-{$event->id}\" action=\"controller/cart-controller.php?eventId={$event->id}\">ADD</button>
		  <h3>{$event->getName()}</h3>
		  <h4>{$event->programmeItem->location}</h4>
		  <h4>" . date("H:i", $event->programmeItem->startsAt) . " - " . date("H:i", $event->programmeItem->endsAt) . "</h4>
		</section>
		";
	}

	function generateEventCards(&$events) {
		$html = "";

		$eventsByDateList = sortEventsByDate($events);
		foreach($eventsByDateList as &$eventsByDate) {
			$date = date("F jS", $eventsByDate[0]->programmeItem->startsAt);
			$html .= "<hr> <h3>$date<h3>";
			foreach($eventsByDate as &$event) {
				$html .= generateEventCard($event);
			}
		}

		return $html;
	}

	function sortEventsByDate(&$events) { // Takes array of events and splits up into arrays of events divided by date.
		$eventsByDateList = [];

		array_push($eventsByDateList, [$events[0]]); // Initiate starting date array.
		for($i = 1; $i < count($events); $i++) {
			$isNewDate = true;
			foreach($eventsByDateList as &$eventsByDate) { // Add to array with corresponding date.
				if(date('Y-m-d', $events[$i]->programmeItem->startsAt) === date('Y-m-d', $eventsByDate[0]->programmeItem->startsAt)) {
					array_push($eventsByDate, $events[$i]); 
					$isNewDate = false;
					break;
				}
			}

			if($isNewDate) { array_push($eventsByDateList, [$events[$i]]); } // If date does not correspond with existing array then make a new array for the new date.

			usort($eventsByDateList, function($a, $b) { return $a[0]->programmeItem->startsAt <=> $b[0]->programmeItem->startsAt; }); // Sort the date arrays.
		}

		return $eventsByDateList;
	}

	if($_POST){
		if(isset($_POST["filter"])) {
			if(isset($_POST["filter"]["artists"])) {
				$newEvents = [];
				//$filteredArtists = is_array($_POST["filter"]["artists"]) && count($_POST["filter"]["artists"]) > 0 ? $_POST["filter"]["locations"] : [""];
				$filteredArtists = $_POST["filter"]["artists"] ?? [null];
				foreach($filteredArtists as &$filteredArtist) {
					foreach($events as &$event) {
						if(strpos(strtolower($event->artist), strtolower($filteredArtist)) !== false && !in_array($event, $newEvents)) {
							array_push($newEvents, $event);
						}
					}
				}
				$events = $newEvents;
			}	
			if(isset($_POST["filter"]["locations"])) {
				$newEvents = [];
				//$filteredLocations = is_array($_POST["filter"]["locations"]) && count($_POST["filter"]["locations"]) > 0 ? $_POST["filter"]["locations"] : [""];
				$filteredLocations = $_POST["filter"]["locations"] ?? [null];
				foreach($filteredLocations as &$filteredLocation) {
					foreach($events as &$event) {
						if(strtolower($filteredLocation) === strtolower($event->programmeItem->location)) {
							array_push($newEvents, $event);
						}
					}
				}
				$events = $newEvents;
			}
		}
		if(isset($_POST["sort"])){
			if($_POST["sort"] === "TIME_ASC") {
				usort($events, function($a, $b) { return $a->programmeItem->startsAt > $b->programmeItem->startsAt; } );
			} else if($_POST["sort"] === "TIME_DESC") {
				usort($events, function($a, $b) { return $a->programmeItem->startsAt < $b->programmeItem->startsAt; } );
			} else if($_POST["sort"] === "PRICE_ASC") {
				usort($events, function($a, $b) { return $a->price > $b->price; } );
			} else if($_POST["sort"] === "PRICE_DESC") {
				usort($events, function($a, $b) { return $a->price < $b->price; } );
			}
		}
	}

	echo generateEventCards($events);
?>