<?php
	session_start();

	$items = [];

	for($i = 0; $i < $_SESSION["cart"]["items"]; $i++) {
		$item = $_SESSION["cart"]["items"][$i];
		$itemMessageData = ["id" => $i, $item["event"]->image->url, $item["event"]->getName(), $item["count"], $item["event"]->price];
		array_push($items, $itemMessageDate);
	}

	echo $items;
?>