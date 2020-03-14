<?php 
    class ProgrammeItem {
        public $id;
        public $startsAt; // Epoch
        public $endsAt; // Epoch
		public $location;
		public $eventTypeId;

        public function __construct($id, $startsAt, $endsAt, $location, $eventTypeId) {
            // if(!is_int($id))          throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`.");
            // if(!is_int($startsAt))    throw new InvalidArgumentException("Parameter '\$startsAt' is not of type `integer` (Epoch).");
            // if(!is_int($endsAt))      throw new InvalidArgumentException("Parameter '\$endsAt' is not of type `integer` (Epoch).");
            // if(!is_string($location)) throw new InvalidArgumentException("Parameter '\$location' is not of type `string`.");
            // if(!is_int($eventTypeId)) throw new InvalidArgumentException("Parameter '\$eventTypeId' is not of type `integer`.");


            // if(!$id >= 0)            throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            // if(!$startsAt >= 0)      throw new UnexpectedValueException("Parameter '\$startsAt' cannot be negative.");
            // if(!$endsAt >= 0)        throw new UnexpectedValueException("Parameter '\$endsAt' cannot be negative.");
            // if(!$eventTypeId >= 0)   throw new UnexpectedValueException("Parameter '\$eventTypeId' cannot be negative.");
            // if(!$startsAt < $endsAt) throw new UnexpectedValueException("Parameter '\$startsAt' must be lower than parameter '\$endsAt'.");

            $this->id = $id;
            $this->startsAt = $startsAt;
            $this->endsAt = $endsAt;
            $this->location = $location;
            $this->eventTypeId = $eventTypeId;
        }
    }
?>