<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../css/cms.css" />
        <title>CMS – Login</title>
    </head>
    <body>
        <div id="background-section">
            <img src="../img/cms/waves.svg">
        </div>
        <div id="login-section">
            <div id="login-section-controls">
                <img src="../img/hf-logo.png" alt="Haarlem Festival Logo">
                <h1>Haarlem Festival</h1>
                <h2>Admin Login</h2>
                <form action="../controller/user-controller.php" method="post" name="login-form">
                    <input type="text" name="email" placeholder="Email Address" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <div id="login-section-controls-rememberme">
                        <input type="checkbox" name="login-remember">
                        Remember me
                    </div>
                    <a id="login-section-controls-passreset" href="passreset.php">Forgot Password</a>
                    <a href="register.php">
                        <input type="button" value="Register">
                    </a>
                    <input type="submit" name="login-button" value="Login">
                </form>
            <div>
        </div>
    </body>
</html>