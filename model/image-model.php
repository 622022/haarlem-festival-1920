<?php 
    class Image {
        public $id;
		public $url;
		public $description;
		
        public function __construct($id, $url, $description) {
            if(!is_int($id))             throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`.");
            if(!is_string($url))         throw new InvalidArgumentException("Parameter '\$url' is not of type `string`.");
            if(!is_string($description)) throw new InvalidArgumentException("Parameter '\$description' is not of type `string`.");

            if(!id >= 0)                               throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            if(!filter_var($url, FILTER_VALIDATE_URL)) throw new UnexpectedValueException("Parameter '\$url' is not a valid URL.");

            $this->id = $id;
            $this->url = $url;
            $this->description = $description;
        }
    }
?> 