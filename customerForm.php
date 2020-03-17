<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/customerForm.css">
    <title>Customer Form</title>

  </head>
  <body>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <div class="row">
            <div class="info-container">
                <div class="container">
                <form name="customerForm" action="payment.php" onsubmit="event.preventDefault(); validateForm();" method="post" required>

                    <div class="row">
                    <div class="heading">
                    <h3>Customer Information</h3>
                    <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                    <input type="text" id="fname" name="fullname" placeholder="Funny name">
                    <label for="email"><i class="fa fa-envelope"></i> Email</label>
                    <input type="text" id="email" name="email" placeholder="69@example.com">
            

                </div>
                    
                    <input type="submit" name="submit-btn" value="Continue to payment" class="btn">
                </form>
            </div>
        </div>

    <div class="cart-stuff">
        <h2>Cart Items</h2>
        <div class="container">
            <h4>Items
            <span class="price" style="color:black">
            <i class="shopping-cart"></i>
            <b>4</b>
            </span>
            </h4>
      
            <p>Total <span class="price" style="color:black"><b>$30</b></span></p>
        </div>
    </div>
    </div>
  
    </body>
</html>
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

