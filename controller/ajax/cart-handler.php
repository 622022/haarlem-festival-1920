<?php
	require_once(__DIR__ . "/../../service/cart-service.php");
	$cartService = cartService::getInstance();  

	$event = $eventService->getAllEvents(1);

	
	
?>