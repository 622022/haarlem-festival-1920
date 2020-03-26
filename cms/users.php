<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – <?= $str['cms.users'] ?></title>
    </head>
    <body>
        <?php include(__DIR__ . '/includes/sidebar.php'); ?>
        <h1 id="title-text"><?= $str['cms.users'] ?></h1>
        <?php
            if (isset($_GET['userid'])) {
                require_once('../service/user-service.php');
                $user = userService::getInstance()->getUser(intval($_GET['userid']));
                if ($user) {
                    ?>
                    <div id="edit-container">
                        <h1 id="edit-text"><?= strtoupper($str['cms.edit-user']) ?> <?= $user->id ?></h1>
                        <form action="../controller/user-controller.php" method="post" name="edit-event">
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.full-name'] ?></label>
                                <input type="text" name="user-fullname" value="<?= $user->fullName ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.email'] ?></label>
                                <input type="text" name="user-email" value="<?= $user->email ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.password'] ?></label>
                                <input type="password" minlength="4" name="user-password" value="" placeholder="<?= $str['cms.unchanged'] ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label"><?= $str['cms.admin'] ?></label>
                                <input type="checkbox" name="user-admin" <?= $user->isAdmin ? 'checked' : '' ?>>
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['userid'] ?>"/>
                            <input type="submit" name="confirm-edit-user" value="<?= $str['cms.edit-user'] ?>">
                            <input class='button-right' type="submit" name="delete-user" value="<?= $str['cms.delete-user'] ?>">
                            <a href="users.php"><?= $str['cms.close'] ?></a>
                        </form>
                    </div>
                    <?php
                }
            }
        ?>
        <div id="event-container">
            <?php 
                require_once('../service/user-service.php');
                $users = userService::getInstance()->getUsers();
                for ($i=0; $i < count($users); $i++) { 
                    $user = $users[$i];
                    ?>
                        <div class="event-card">
                        <h1><?= $user->fullName ?></h1>
                        <h2><?= $user->email ?></h2>
                        <h3><?= $user->isAdmin ? $str['cms.volunteer'] : $str['cms.user'] ?></h3>
                        <a href="users.php?userid=<?= $user->id ?>" class="card-button"><?= $str['cms.edit-user'] ?></a>
                        </div>
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