<?php 
    class Ticket {
        public $orderId;
        public $status;
        public $price;
        public $uuid;

        public function __construct($orderId, $status, $price, $uuid) {
            $this->orderId = $orderId;
            $this->status = is_numeric($status) ? $status : $this->getStatusInt($status);
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

        private function getStatusInt($string) {
            switch (strtolower($string)) {
                case 'valid':
                    return  1;
                case 'redeemed':
                    return 2;
                case 'cancelled':
                    return 3;
                case 'expired':
                    return 4;
                case 'invalid':
                    return 5;
                case 'i\'m a monkey':
                    return 6;
                default:
                    return 5;
            }
        }
    }
?>