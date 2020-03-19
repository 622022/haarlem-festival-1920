<?php
if($_POST["submit-btn"]) {
	$fullName = $_POST["fullname"];
	$email = $_POST["email"];
	header("Location: ../payment.php");
} else {
	http_response_code(400);
}
?>