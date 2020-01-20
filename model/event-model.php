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
		
        public function __construct($id, $artist, $price, $ticketsLeft, $programmeItem, $eventTypeId, $imageId, $description, $more) {
            $this->id = $id;
            $this->artist = $artist;
			$this->price = $price
			$this->ticketsLeft = $ticketsLeft
			$this->programmeItem = $programmeItem;
			$this->eventTypeId = $eventTypeId;
			$this->imageId = $imageId;
            $this->description = $description;
            $this->more = $more;
        }
    }
?>   
