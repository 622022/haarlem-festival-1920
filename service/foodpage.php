<!DOCTYPE HTML>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.svg">
    <link rel="stylesheet" href="css/event.css">
    <title>Food Event</title>
  </head>
  <body>
    <header>
      <nav>
        <ul class="navbarlist">
          <li class="navbaritems"><a class="active" href="#dance">DANCE</a></li>
          <li class="navbaritems jazz"><a div id= "jazz" href="#jazz">JAZZ</a></li>
          <li class="navbaritems food"><a div id= "food" href="#food">FOOD</a></li>
        </ul>
      </nav>  
    </header>

    <div class="Sort">
      <table>
        <tr>
          <td>Sorting by</td>
          <td><select id="sort">       
            <option selected value="TIME_ASC" id="time-asc">Time asc.</option>
            <option value="TIME_DESC" id="time-desc">Time desc.</option>
            <option value="PRICE_ASC" id="price-asc">Price asc.</option>
            <option value="PRICE_DESC" id="price-desc">Price desc.</option>
          </select></td>
        </tr>
      </table>
    </div>

    <section class="filter">
      <h3>Filters</h3>
      <div id=filter-Food>
        <h4 id="Food">Restaurants</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Restaurant Mr. & Mrs."/>Restaurant Mr. & Mrs.</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Restaurant ML"/>Restaurant ML</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Restaurant Fris"/>Restaurant Fris</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Specktakel"/>Specktakel</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Grand Cafe Brinkman"/>Grand Cafe Brinkman</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Urban Frenchy Bistro Toujours"/>Urban Frenchy Bistro Toujours</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="The Golden Bull"/>The Golden Bull</label>
        </div>
      </div>
      <div id=filter-Food>
        <h4 div id="Food">Date</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Session 1"/>Session 1</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Session 2"/>Session 2</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Session 3"/>Session 3</label>
        </div>
      </div>  
      <div id=filter-Food>
        <h4 div id="Food">Food Types</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Dutch"/>Dutch</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Fish"/>Fish</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Seafood"/>Seafood</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="European"/>European</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="French"/>French</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="International"/>International</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Asian"/>Asian</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Modern"/>Modern</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Steakhouse"/>Steakhouse</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Argentinian"/>Argentinian</label>
        </div>
      </div>  
    </section>

    <section id="cards"></section>

    <div id="cart-wrapper">
      <button id=cart-circle>
        <img id="cart-icon" src="https://cdns.iconmonstr.com/wp-content/assets/preview/2013/240/iconmonstr-shopping-cart-3.png" alt="Click to view cart contents">
    </button>
    </div>

    <section id="cart">
      <div id="cart-items"> <!-- Generate Cart Items Here --> </div>
      <p id="total-price"> <!-- Total Price Here --> </p>
      <button id="checkout" type="button" onclick="location.href='checkout.php';">Checkout</button>

      <!-- location.href just for checking the flow here -->
    </section>

    
    <!-- The Modal -->
    <div id="myModal" class="modal">
    <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2 id="day1" >Friday</h2>
        <h3 id="dag1" >€125,-</h3>
        <button id="btn1" class="addbtn" type="button" name="add">ADD</button>
        <h2 id="day2">Saturday</h2>
        <h3 id="dag2" >€150,-</h3>
        <button id="btn2" class="addbtn" type="button" name="add">ADD</button>
        <h2 id="day3">Sunday</h2>
        <h3 id="dag3" >€150,-</h3>
        <button id="btn3" class="addbtn" type="button" name="add">ADD</button>
      </div>
        <h3 id="description">You can buy the passes for one day or 3 days!</h3>

    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("all-accessbtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
          modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
          }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/eventcards.js"></script>
    <script src="scripts/cart.js"></script>
  </body>
</html>