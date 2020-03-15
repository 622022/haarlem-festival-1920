<?php 
    if (require_once(__DIR__ . '/includes/admin-check.php')) {
?>
<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – Users</title>
    </head>
    <body>
        <?php include(__DIR__ . '/includes/sidebar.php'); ?>
        <h1 id="title-text">Users</h1>
        <?php
            if (isset($_GET['userid'])) {
                require_once('../service/user-service.php');
                $user = userService::getInstance()->getUser(intval($_GET['userid']));
                if ($user) {
                    ?>
                    <div id="edit-container">
                        <h1 id="edit-text">EDIT USER <?= $user->id ?></h1>
                        <form action="../controller/user-controller.php" method="post" name="edit-event">
                            <div class="textbox-area">
                                <label class="textbox-label">Full name</label>
                                <input type="text" name="user-fullname" value="<?= $user->fullName ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Email</label>
                                <input type="text" name="user-email" value="<?= $user->email ?>">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Password</label>
                                <input type="password" minlength="4" name="user-password" value="" placeholder="(unchanged)">
                            </div>
                            <div class="textbox-area">
                                <label class="textbox-label">Admin</label>
                                <input type="checkbox" name="user-admin" <?= $user->isAdmin ? 'checked' : '' ?>>
                            </div>
                            <input type="hidden" name="id" value="<?= $_GET['userid'] ?>"/>
                            <input type="submit" name="confirm-edit-user" value="Edit User">
                            <a href="users.php">Close</a>
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
                        <h3><?= $user->isAdmin ? 'Volunteer' : 'User' ?></h3>
                        <a href="users.php?userid=<?= $user->id ?>" class="card-button">Edit User</a>
                        </div>
                    <?php
                }
            ?>
        </div>
    </body>
</html>
<?php 
    } else {
        echo("You do not have access to view this page");
    }
?>