<?php 
    class Event {
        public $id;
        public $artist;
        public $price;
        public $ticketsLeft;
        public $programmeItem;
        public $eventTypeId;
        public $imageId;
        public $description;
        public $more;
        // TODO: Start and end time
		
        public function __construct($id, $artist, $price, $ticketsLeft, $programmeItem, $eventTypeId, $imageId, $description, $more) {
            $this->id = $id;
            $this->artist = $artist;
			$this->price = $price;
			$this->ticketsLeft = $ticketsLeft;
			$this->programmeItem = $programmeItem;
			$this->eventTypeId = $eventTypeId;
			$this->imageId = $imageId;
            $this->description = $description;
            $this->more = $more;
        }

        public function getEventName() {
            switch ($this->eventTypeId) {
                case 1:
                    return 'Dance';
                case 2:
                    return 'Jazz';
                case 3:
                    return 'Food';
                default:
                    return 'Unknown';
            }
        }

        public function getEventStartDateTime() {

        }

        public function getEventEndDateTime() {

        }
    }
?>   
