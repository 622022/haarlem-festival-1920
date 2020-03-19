<!DOCTYPE HTML>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="icon" href="/favicon.svg">
		<link rel="stylesheet" href="css/checkout.css">
		<title>Checkout</title>
	</head>
	<body>
		<section id="customer-info">
			<h3>Customer Information</h3>
			<form name="customerForm" action="payment.php" onsubmit="validateForm();" method="post" required>                   
				<label for="fullname">Full Name</label>
				<input type="text" id="fullname" name="fullname" placeholder="Funny name">
				<label for="email">Email</label>
				<input type="email" id="email" name="email" placeholder="email@example.com">
				<input type="submit" name="submit-btn" value="Continue to payment" class="btn">
			</form>
		</section>
		<section id="cart">
			<h2>Cart Items</h2>
			<div id="cart-items"></div>
			<p id="total-price"></p>
		</section>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="scripts/cart.js"></script>
		<script>
		function validateForm() {
				var x = document.forms["customerForm"]["fullname"].value;
				var y = document.forms["customerForm"]["email"].value;
				if (x == "") {
				alert("Name must be filled out");
				return false;
				}
				if(y == ""){
						alert("Email must be filled out");
				return false;
				}
				else{
						return true;
				}
		}
		</script>
	</body>
</html>