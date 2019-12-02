<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>

<div class="form">
<h1>Registration</h1>
<form name="registration" action="controller/UserController.php" method="post">
<input type="text" name="reg_username" placeholder="Username" required />
<input type="email" name="reg_email" placeholder="Email" required />
<input type="password" name="reg_password" placeholder="Password" required />
<input type="submit" name="submit" value="Register" />
</form>
<br /><br />


</body>
</html>