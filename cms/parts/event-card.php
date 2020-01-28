<?php $currentEvent ?>

<div class="event-card">
    <h1><?php echo $currentEvent->getEventName() ?></h1>
    <h2><?php echo $currentCardData->artist ?></h2>
    <h3>January 1st – 00:00 - 00:00</h3>
    <button>Edit Event</button>
</div>

<?php 
    public function setCurrentEvent($event) {
        $currentEvent = $event;
    }
?>