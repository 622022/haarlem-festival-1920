<?php 
    class Image {
        public $id;
		public $url;
		public $description;
		
        public function __construct($id, $url, $description) {
            is_int($id)             ?: throw new InvalidArgumentException("Parameter '\$id' is not of type `integer`.");
            is_string($url)         ?: throw new InvalidArgumentException("Parameter '\$url' is not of type `string`.");
            is_string($description) ?: throw new InvalidArgumentException("Parameter '\$description' is not of type `string`.");

            id >= 0                                                                 ?: throw new UnexpectedValueException("Parameter '\$id' cannot be negative.");
            filter_var($url, FILTER_VALIDATE_URL)                                   ?: throw new UnexpectedValueException("Parameter '\$url' is not a valid URL.");
            substr($url, 0, 7 ) === "http://" || substr($url, 0, 8 ) === "https://" ?: throw new UnexpectedValueException("Parameter '\$url' is not in the `http(s)` protocol.");

            $this->id = $id;
            $this->url = $url;
            $this->description = $description;
        }
    }
?> 