<?php 
    class Invoice {
        public $orderId;
        public $status;
        public $orderedAt;
        public $customerName;
        public $customerEmail;
        public $method;

        public function __construct($orderId, $status, $orderedAt, $customerName, $customerEmail, $method) {
            $this->orderId = $orderId;
            $this->status = is_numeric($status) ? $status : $this->getStatusInt($status);
            $this->orderedAt = $orderedAt;
            $this->customerName = $customerName;
            $this->customerEmail = $customerEmail;
            $this->method = is_numeric($method) ? $method : $this->getMethodInt($method);
        }

        public function getStatusString() {
            switch ($this->status) {
                case 0:
                    return 'PAID';
                case 1:
                    return 'REFUNDED';
                case 2:
                    return 'FAILED';
                case 3:
                    return 'OPEN';
                case 4:
                    return 'CANCELLED';
                case 5:
                    return 'EXPIRED';
                default:
                    return 'FAILED';
            }
        }

        private function getStatusInt($string) {
            switch (strtolower($string)) {
                case 'paid':
                    return 0;
                case 'refunded':
                    return 1;
                case 'failed':
                    return 2;
                case 'open':
                    return 3;
                case 'cancelled':
                    return 4;
                case 'expired':
                    return 5;
                case 'failed':
                    return 6;
                default:
                    return 2;
            }
        }

        public function getMethodString() {
            switch ($this->method) {
                case 1:
                    return 'IDEAL';
                case 2:
                    return 'CREDIT CARD';
                case 3:
                    return 'PAYPAL';
                case 4:
                    return 'ING HOMEPAY';
                default:
                    return 'INVALID';
            }
        }

        private function getMethodInt($string) {
            switch (strtolower($string)) {
                case 'ideal':
                    return  1;
                case 'credit card':
                    return 2;
                case 'paypal':
                    return 3;
                case 'ing homepay':
                    return 4;
                default:
                    return 0;
            }
        }
    }
?>