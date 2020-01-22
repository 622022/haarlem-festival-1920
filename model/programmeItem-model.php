<?php 
    class ProgrammeItem {
        public $id;
        public $startsAt;
        public $endsAt;
		public $location;
		public $eventTypeId;

        public function __construct($id, $startsAt, $endsAt, $location, $eventTypeId) {
            $this->id = $id;
            $this->startsAt = $startsAt;
            $this->endsAt = $endsAt;
            $this->location = $location;
            $this->eventTypeId = $eventTypeId;
        }
    }
?>   