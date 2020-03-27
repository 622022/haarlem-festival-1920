<?php
    isset($_SESSION) || session_start();
    require_once(__DIR__ . '/../../lib/strings.php');
    $str = $strings[$_SESSION['lang'] ?? 'en'];
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../css/cms.css" />