<?php 
    if (require_once('./includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include('./includes/header.php'); ?>
        <title>CMS – Events</title>
    </head>
    <body>
        <?php include('./includes/sidebar.php'); ?>
    </body>
</html>
<?php 
    } else {
        echo("You do not have access to view this page");
    }
?>