<?php
	require_once(__DIR__ . "/../lib/dal.php");
	 
	class checkoutService {
		private static $instance;
		private $dal;
		
		public function __construct() {
			$this->dal = dataLayer::getInstance();
		}

		// Initialize instance if not already intitialized. Then returns that instance.
		public static function getInstance() {
			return !self::$instance ? new checkoutService() : self::$instance;
		}

		public function pushPayment($method, $status, $details) {
			return $this->dal->insertPayment($method, $status, $details); //Returns ID
		}

		public function pushCustomer($name, $email) {
			return $this->dal->insertCustomer($name, $email); //Returns ID
		}

		public function pushOrder($customerId, $paymentId) {
			return $this->dal->insertOrder($customerId, $paymentId); //Returns ID
		}

		public function pushTicket($eventId, $orderId, $price) {
			return $this->dal->insertTicket($eventId, $orderId, $price);
		}

		public function getUid($id) {
			return $this->dal->fetchUid($id); //Returns UID
		}
	}
?>