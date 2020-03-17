<?php
	class Checkout {
		private static $instance;
		
        public function __construct() {
        }

         // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new Checkout() : self::$instance;
		}
		
		public function checkout() {
			$uid = uniqid();
		}
	}
?>