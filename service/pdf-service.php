<?php
    require_once(__DIR__ . "/../lib/pdf.php");

    class pdfService {
        private static $instance;
        private $pdf;

        public function __construct() {
           $this->pdf = pdfGenerator::getInstance();
        }

        // Initialize instance if not already intitialized. Then returns that instance.
        public static function getInstance() {
            return !self::$instance ? new pdfService() : self::$instance;
        }

        public function generatePdf()
        {
            $this->pdf->makePdf();
        }
    }
?>