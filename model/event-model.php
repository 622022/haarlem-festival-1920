<?php 
    class Event {
        public $id;
        public $artist;
        public $price;
        public $ticketsLeft;
        public $programmeItem; // Is a class
        public $image; // Is a class
        public $eventTypeId;     
        public $description;
        public $more;
		
        public function __construct($id, $artist, $price, $ticketsLeft, $programmeItem, $image, $eventTypeId, $description, $more) {
            is_int($id)               ?: throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`."); 
            is_string($artist)        ?: throw new InvalidArgumentException("Parameter '\$artist' is not of type `string`.");
            is_double($price)         ?: throw new InvalidArgumentException("Parameter '\$price' is not of type `double`.");
            is_int($ticketsLeft)      ?: throw new InvalidArgumentException("Parameter '\$ticketsLeft' is not of type `integer`.");
            is_object($programmeItem) ?: throw new InvalidArgumentException("Parameter '\$programmeItem' is not of type `object`.");
            is_object($image)         ?: throw new InvalidArgumentException("Parameter '\$image' is not of type `object`.");
            is_int($eventTypeId)      ?: throw new InvalidArgumentException("Parameter '\$eventTypeId' is not of type `integer`.");
            is_string($description)   ?: throw new InvalidArgumentException("Parameter '\$description' is not of type `string`.");
            is_string($more)          ?: throw new InvalidArgumentException("Parameter '\$more' is not of type `string`.");       
            
            $id >= 0          ?: throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            $price >= 0       ?: throw new UnexpectedValueException("Parameter '\$price' cannot be negative.");
            $ticketsLeft >= 0 ?: throw new UnexpectedValueException("Parameter '\$ticketsLeft' cannot be negative.");
            $eventTypeId >= 0 ?: throw new UnexpectedValueException("Parameter '\$eventTypeId' cannot be negative.");

            $this->id = $id;
            $this->artist = $artist;
            $this->price = $price;
            $this->ticketsLeft = $ticketsLeft;
            $this->programmeItem = $programmeItem;
            $this->image = $image;
            $this->eventTypeId = $eventTypeId;
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