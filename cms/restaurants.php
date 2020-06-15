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
        <?php
            if (isset($_GET['restaurantid'])) {
                require_once('../service/restaurant-service.php');
                $restaurant = restaurantService::getInstance()->getRestaurant(intval($_GET['restaurantid']));
                if ($restaurant) {
                    ?>
                    <div id="edit-container" style="z-index: 1000;">
                        <h1 id="edit-text"><?= strtoupper($str['cms.edit-restaurant']) ?> <?= $restaurant->id ?></h1>
                        <form action="../controller/restaurant-controller.php" method="post" name="edit-restaurant">
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.restaurant-name'] ?></label>
                                <input type="text" name="restaurant-name" value="<?= $restaurant->name ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.address'] ?></label>
                                <input type="text" name="restaurant-address" value="<?= $restaurant->address ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.first-session'] ?></label>
                                <input type="text" name="restaurant-firstsession" value="<?= $restaurant->firstSession ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.description'] ?></label>
                                <input type="text" name="restaurant-description" value="<?= $restaurant->description ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.price'] ?></label>
                                <input type="number" name="restaurant-price" step="0.01" value="<?= $restaurant->price ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.restaurant-seats'] ?></label>
                                <input type="number" name="restaurant-seats" step="1" value="<?= $restaurant->seats ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.restaurant-stars'] ?></label>
                                <input type="number" min-value="0" max-value="5" name="restaurant-stars" step="1" value="<?= $restaurant->stars ?>">
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['restaurantid'] ?>"/>
                            <input type="submit" name="confirm-edit-restaurant" value="<?= $str['cms.edit-restaurant'] ?>">
                            <input class='button-right' type="submit" name="delete-restaurant" value="<?= $str['cms.delete-restaurant'] ?>">
                            <a href="restaurants.php"><?= $str['cms.close'] ?></a>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>
        <div id="edit-container">
            <?php
                require_once('../service/restaurant-service.php');
                $restaurants = restaurantService::getInstance()->getAllRestaurants();
                
                foreach ($restaurants as $restaurant) {
                    ?>
                        <div style="display: inline;" class="restaurants-item"><?= $restaurant->name ?></div>
                        <a style="position: absolute; right: 0;"href="restaurants.php?restaurantid=<?= $restaurant->id ?>">Edit</a>
                        <br>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have permission to view this page");
    }
?>