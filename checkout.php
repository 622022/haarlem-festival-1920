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
		<section id="cart">
			<div id="cart-items"></div>
			<p id="total-price"></p>
		</section>
		<form action="controller/checkout-controller.php" method="post">
			<label>Full Name</label><br>
			<input type="text"><br>
			<label>Email Address</label><br>
			<input type="email"><br><br>
			<input type="submit">Place Order</button>
		</form>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="scripts/cart.js"></script>
	</body>
</html>