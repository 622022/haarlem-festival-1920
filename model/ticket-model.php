<?php 
    class Ticket {
        public $orderId;
        public $status;
        public $price;
        public $uuid;

        public function __construct($orderId, $status, $price, $uuid) {
            $this->orderId = $orderId;
            $this->status = $status;
            $this->price = $price;
            $this->uuid = $uuid;
        }

        public function getStatusString() {
            switch ($this->status) {
                case 1:
                    return  'Valid';
                case 2:
                    return 'Redeemed';
                case 3:
                    return 'Cancelled';
                case 4:
                    return 'Expired';
                case 5:
                    return 'Invalid';
                case 69:
                    return 'I\'m a monkey';
                default:
                    return 'Invalid';
            }
        }
    }
?>