<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – Register</title>
    </head>
    <body>
        <div id="background-section">
            <img src="../img/cms/waves.svg">
        </div>
        <div id="login-section">
            <div id="login-section-controls">
                <img src="../img/hf-logo.png" alt="Haarlem Festival Logo">
                <h1>Haarlem Festival</h1>
                <h2><?= $str['cms.registration'] ?></h2>
                <form action="../controller/user-controller.php" method="post" name="registration-form">
                    <input type="text" name="email" placeholder="<?= $str['cms.email'] ?>" required>
                    <input type="text" name="fullname" placeholder="<?= $str['cms.full-name'] ?>" required>
                    <input type="password" name="password" placeholder="<?= $str['cms.password'] ?>" required>
                    <input type="submit" name="register-button" value="<?= $str['cms.register'] ?>">
                    <!-- Checkbox input for admin bool here? -->
                </form>
            </div>
        </div>
    </body>
</html>