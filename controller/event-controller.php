<?php
    require_once(__DIR__ . "/../model/event-model.php");
    require_once(__DIR__ . "/../model/programmeItem-model.php");
    require_once(__DIR__ . "/../service/event-service.php");
    $eventService = eventService::getInstance();

    if (isset($_POST["confirm-edit-event"])) {
        try {
            $event = $eventService->getEvent($_POST['id']);
            
            $updatedPerogrammeItem = new ProgrammeItem($event->programmeItem->id,
            strtotime($_POST['event-start']),
            strtotime($_POST['event-end']),
            $_POST['event-location'],
            intval($_POST['event-type']));

            $eventService->updateEvent(new Event(
                intval($_POST['id']),
                $_POST['event-name'],
                $event->price,
                $event->ticketsLeft,
                $updatedProgrammeItem,
                $event->image,
                intval($_POST['event-type']),
                $event->description,
                $event->more));
            header("Location: ../cms/events.php");
        } catch(Exception $e) {
            echo($e);
        }
    }
?>