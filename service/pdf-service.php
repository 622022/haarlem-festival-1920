<?php
    require_once(__DIR__ . "/../lib/pdf.php");

    class pdfService {
        private static $instance;
        private $pdf;

        public function __construct() {
            self::$instance = $this; 
            $this->pdf = PDF::getInstance();
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new pdfService() : self::$instance;
        }

        public function generatePdf($items,$totalPrice,$date)
        {
            $this->pdf->makePdf($items,$totalPrice,$date);
        }
    }
?>