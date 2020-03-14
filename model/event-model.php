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
            // if(!is_int($id))               throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`."); 
            // if(!is_string($artist))        throw new InvalidArgumentException("Parameter '\$artist' is not of type `string`.");
            // if(!is_double($price))         throw new InvalidArgumentException("Parameter '\$price' is not of type `double`.");
            // if(!is_int($ticketsLeft))      throw new InvalidArgumentException("Parameter '\$ticketsLeft' is not of type `integer`.");
            // if(!is_object($programmeItem)) throw new InvalidArgumentException("Parameter '\$programmeItem' is not of type `object`.");
            // if(!is_object($image))         throw new InvalidArgumentException("Parameter '\$image' is not of type `object`.");
            // if(!is_int($eventTypeId))      throw new InvalidArgumentException("Parameter '\$eventTypeId' is not of type `integer`.");
            // if(!is_string($description))   throw new InvalidArgumentException("Parameter '\$description' is not of type `string`.");
            // if(!is_string($more))          throw new InvalidArgumentException("Parameter '\$more' is not of type `string`.");       
            
            // if(!$id >= 0)          throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            // if(!$price >= 0)       throw new UnexpectedValueException("Parameter '\$price' cannot be negative.");
            // if(!$ticketsLeft >= 0) throw new UnexpectedValueException("Parameter '\$ticketsLeft' cannot be negative.");
            // if(!$eventTypeId >= 0) throw new UnexpectedValueException("Parameter '\$eventTypeId' cannot be negative.");
            // json_decode($more); if(json_last_error() != JSON_ERROR_NONE) throw new UnexpectedValueException("Parameter '\$more' is not in a JSON format.");

            $this->id = $id;
            $this->artist = $artist;
            $this->price = $price;
            $this->ticketsLeft = $ticketsLeft;
            $this->programmeItem = $programmeItem;
            $this->image = $image;
            $this->eventTypeId = $eventTypeId;
            $this->description = $description;
            $this->more = json_decode($more);
        }

        public function getName() {
            if($this->eventTypeId === 1) { // If Dance
                return strval($this->more["session"]) ? strval($this->more["session"]) . " by " . $this->artist : $this->artist;
            } else if ($this->eventTypeId === 2) { // If Jazz
                return $this->artist;
            }
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

        public function __toString() {
            $output = "
            id: $this->id,\n
            artist: $this->artist,\n
            price: $this->price,\n
            ticketsLeft: $this->ticketsLeft,\n
            programmeItemId: {$this->programmeItem->id},\n
            imageId: {$this->image->id},\n
            eventTypeId: $this->eventTypeId,\n
            description: $this->description,\n
            more: $this->more\n\n
            ";

            return $output;
        }
    }
?>