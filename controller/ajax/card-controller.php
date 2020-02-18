<?php
	require_once(__DIR__ . "/service/event-service.php");
	$eventService = eventService::getInstance();  

	$events = $eventService->getAllEvents(1);
	
	function generateEventCard($event) {
		return "
		<section class=\"eventcard\">
		  <div class=\"box-container\">
		  <img src=\"{$event->image->url}\" alt=\"{$event->image->description}\">
		  <h2>€{$event->price}</h2>
		  <button id=\"addbtn\" type=\"button\" name=\"add-{$event->id}\" action=\"controller/cart-controller.php?eventId={$event->id}\">ADD</button>
		  <h3>{$event->getName()}</h3>
		  <h4>{$event->programmeItem->location}</h4>
		  <h4>{$event->programmeItem->startsAt}-{$event->programmeItem->endsAt}</h4>
		</section>
		";
	}

	
	foreach($events as &$event) { $data .= generateEventCard($event); }

	echo $data;
?>