<?php 
    class Event {
        public $artist;
        public $price;
        public $type;
        public $location;
        public $startsAt;
        public $endsAt;

        public function __construct($artist, $price, $type, $location, $startsAt, $endsAt) {
            $this->artist = $artist;
            $this->price = $price;
            $this->type = $type;
            $this->location = $location;
            $this->startsAt = $startsAt;
            $this->endsAt = $endsAt;
        }

        public function __get($duration) {
            return $this->endsAt - $this->startsAt;
        }
    }
?>    