<?php
    session_start();
    require_once(__DIR__ . "/../service/restaurant-service.php");
    require_once(__DIR__ . "/../model/restaurant-model.php");
    $restaurantService = restaurantService::getInstance();


    if (isset($_POST['confirm-edit-restaurant'])) {
        $restaurantService->updateRestaurant(new Restaurant(
            $_POST['id'],
            $_POST['restaurant-name'],
            intval($_POST['restaurant-price']),
            $_POST['restaurant-address'],
            $_POST['restaurant-firstsession'],
            intval($_POST['restaurant-stars']),
            intval($_POST['restaurant-seats']),
            $_POST['restaurant-description']
        ));
        header('Location: ../cms/restaurants.php');
    }

    if (isset($_POST['delete-restaurant'])) {
        echo "deleting restaurant ". $_POST['id'];
        $restaurantService->deleteRestaurant($_POST['id']);
        header('Location: ../cms/restaurants.php');
    }
?> 