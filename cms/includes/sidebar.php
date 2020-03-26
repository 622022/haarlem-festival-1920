<?php isset($_SESSION) || session_start(); ?>
<div id="sidebar-top">
    <div id="sidebar-navigator">
        <?php 
            preg_match('/\/cms\/(\w+)\.php/i', $_SERVER['REQUEST_URI'], $matches);
            echo(ucfirst($matches[1]));
        ?>
    </div>
    <div id="sidebar-account">
        <?php 
            require_once(__DIR__ . '/../../service/login-service.php');
            $user = loginService::getInstance()->getFullName($_SESSION['USER']);
            if ($user != null) {
                echo($user);
            } else {
                session_destroy();
                header('location: ./login.php');
            }
        ?>
        <a href="../controller/logout.php"><?= $str['cms.log-out'] ?></a>
    </div>  
</div>
<div id="sidebar">
    <h1>Haarlem Festival</h1>
    <h2><?= $str['cms.subtitle'] ?></h2>
    <a href="./events.php" class="sidebar-item">
        <img src="../img/cms/calendar.svg">
        <?= $str['cms.events'] ?>
    </a>
    <a href="./users.php" class="sidebar-item">
        <img src="../img/cms/user.svg">
        <?= $str['cms.users'] ?>
    </a>
    <a href="./tickets.php" class="sidebar-item">
        <img src="../img/cms/tickets.svg">
        <?= $str['cms.tickets'] ?>
    </a>
    <a href="./restaurants.php" class="sidebar-item">
        <img src="../img/cms/restaurant.svg">
        <?= $str['cms.restaurants'] ?>
    </a>
    <a href="./invoices.php" class="sidebar-item">
        <img src="../img/cms/receipt.svg">
        <?= $str['cms.invoices'] ?>
    </a>
    <!-- Translations footer -->
    <div id="sidebar-translations">
        <a href="../controller/language-controller.php">
            <img src="../img/cms/translate.svg">
            <?= isset($_SESSION['lang']) ? $_SESSION['lang'] === 'en' ? 'English' : 'Nederlands' : 'English' ?>
        </a>
    </div>
</div>