<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../css/cms.css" />
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
                <h2>Registration</h2>
                <form action="../controller/user-controller.php" method="post" name="registration-form">
                    <input type="text" name="email" placeholder="Email Address" required>
                    <input type="text" name="fullname" placeholder="Full Name" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="register-button" value="Register">
                </form>
            </div>
        </div>
    </body>
</html>