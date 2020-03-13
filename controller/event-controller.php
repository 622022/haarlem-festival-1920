<?php
    require_once(__DIR__ . "/../model/event-model.php");
    require_once(__DIR__ . "/../model/programmeItem-model.php");
    require_once(__DIR__ . "/../service/event-service.php");
    $eventService = eventService::getInstance();

    if (isset($_POST["confirm-edit-event"])) {
        try {
            $event = $eventService->getEvent($_POST['id']);
            $startDate = new DateTime($_POST['event-date'] . " " . $_POST['event-time']);
            $startDate = $startDate->getTimestamp();
            $endDate = $startDate + $_POST['event-duration'] * 60;
            
            $updatedProgrammeItem = new ProgrammeItem(
                $event->programmeItem->id,
                $startDate,
                $endDate,
                $_POST['event-location'],
                intval($_POST['event-type'])
            );

            $eventService->updateEvent(new Event(
                intval($_POST['id']),
                $_POST['event-name'],
                $_POST['event-price'],
                $event->ticketsLeft,
                $updatedProgrammeItem,
                $event->image,
                intval($_POST['event-type']),
                $event->description,
                $event->more)
            );
            //header("Location: ../cms/events.php");
        } catch(Exception $e) {
            echo($e);
        }
    }
?>