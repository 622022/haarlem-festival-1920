<?php 
    class ProgrammeItem {
        public $id;
        public $startsAt; // Epoch
        public $endsAt; // Epoch
		public $location;
		public $eventTypeId;

        public function __construct($id, $startsAt, $endsAt, $location, $eventTypeId) {
            is_int($id)          ?: throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`.");
            is_int($startsAt)    ?: throw new InvalidArgumentException("Parameter '\$startsAt' is not of type `integer` (Epoch).");
            is_int($endsAt)      ?: throw new InvalidArgumentException("Parameter '\$endsAt' is not of type `integer` (Epoch).");
            is_string($location) ?: throw new InvalidArgumentException("Parameter '\$location' is not of type `string`.");
            is_int($eventTypeId) ?: throw new InvalidArgumentException("Parameter '\$eventTypeId' is not of type `integer`.");


            $id >= 0            ?: throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            $startsAt >= 0      ?: throw new UnexpectedValueException("Parameter '\$startsAt' cannot be negative.");
            $endsAt >= 0        ?: throw new UnexpectedValueException("Parameter '\$endsAt' cannot be negative.");
            $eventTypeId >= 0   ?: throw new UnexpectedValueException("Parameter '\$eventTypeId' cannot be negative.");
            $startsAt < $endsAt ?: throw new UnexpectedValueException("Parameter '\$startsAt' must be lower than parameter '\$endsAt'.");

            $this->id = $id;
            $this->startsAt = $startsAt;
            $this->endsAt = $endsAt;
            $this->location = $location;
            $this->eventTypeId = $eventTypeId;
        }
    }
?>   