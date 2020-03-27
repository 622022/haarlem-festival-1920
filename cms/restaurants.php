<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – Restaurants</title>
    </head>
    <body>
        <?php include(__DIR__ . '/includes/sidebar.php'); ?>
        <h1 id="title-text">Restaurants</h1>
    </body>
</html>
<?php 
    } else {
        echo("You do not have permission to view this page");
    }
?>