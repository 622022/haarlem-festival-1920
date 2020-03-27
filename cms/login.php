<html lang="en">
    <head>
        <?php include(__DIR__ . '/includes/header.php'); ?>
        <title>CMS – <?= $str['cms.login'] ?></title>
    </head>
    <body>
        <div id="background-section">
            <img src="../img/cms/waves.svg">
        </div>
        <div id="login-section">
            <div id="login-section-controls">
                <img src="../img/hf-logo.png" alt="Haarlem Festival Logo">
                <h1>Haarlem Festival</h1>
                <h2><?= $str['cms.login'] ?></h2>
                <form action="../controller/user-controller.php" method="post" name="login-form">
                    <input type="text" name="email" placeholder="<?= $str['cms.email'] ?>" required>
                    <input type="password" name="password" placeholder="<?= $str['cms.password'] ?>" required>
                    <div id="login-section-controls-rememberme">
                        <input type="checkbox" name="login-remember">
                        <?= $str['cms.remember-me'] ?>
                    </div>
                    <a id="login-section-controls-passreset" href="passreset.php"><?= $str['cms.forgot-password'] ?></a>
                    <a href="register.php">
                        <input type="button" value="<?= $str['cms.register'] ?>">
                    </a>
                    <input type="submit" name="login-button" value="<?= $str['cms.login'] ?>">
                </form>
            </div>
        </div>
    </body>
</html>