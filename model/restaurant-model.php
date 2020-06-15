<?php 
    class Restaurant {
        public $id;
        public $name;
        public $price;
        public $address;
        public $firstSession;
        public $stars;
        public $seats;
        public $description;

        public function __construct($id, $name, $price, $address, $firstSession, $stars, $seats, $description) {
            $this->id = $id;
            $this->name = $name;
            $this->price = $price;
            $this->address = $address;
            $this->firstSession = $firstSession;
            $this->stars = $stars;
            $this->seats = $seats;
            $this->description = $description;
        }
    }
?>