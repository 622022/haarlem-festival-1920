<?php 
    class Restaurant {
        public $name;
        public $price;
        public $address;
        public $firstSession;
        public $stars;
        public $seats;
        public $description;

        public function __construct($name, $price, $address, $firstSession, $stars, $seats, $description) {
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