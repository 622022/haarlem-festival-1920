<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.svg">
    <link rel="stylesheet" href="css/event.css">
    <title>Dance event</title>
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

    <section class = "all-access">
      <h2>You can save up to <span>*50%</span> off if you buy an all-access pass </h2>
      <button div id="all-accessbtn" type="button">All-access pass</button>
      <h3>or</h3>
      <h4>order-separately</h4>
    </section>

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
      <div id=filter-artist>
        <h4 id="Artist">Artists</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Nicky Romero"/>Nicky Romero</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Afrojack"/>Afrojack</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Tiësto"/>Tiësto</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Hardwell"/>Hardwell</label>
        </div>
        <div class="checkbox">
          <label id="artist-fix"><input type="checkbox" name="Armin van Buuren"/>Armin van Buuren</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Martin Garrix"/>Martin Garrix</label>
        </div>
      </div>
      <div id=filter-location>
        <h4 div id="Location">Locations</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Lichtfabriek"/>Lichtfabriek</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Club Stalker"/>Club Stalker</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Jopenkerk"/>Jopenkerk</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="XO the Club"/>XO the Club</label>
        </div>
        <div class="checkbox">
          <label id="location-fix"><input type="checkbox" name="Caprera Openluchttheater"/>Caprera Openluchttheater</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" name="Club Ruis"/>Club Ruis</label>
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
      <button id="checkout" type="button" onclick="location.href='customerForm.php';">Checkout</button>

      <!-- location.href just for checking the flow here -->
    </section>

    

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="scripts/eventcards.js"></script>
    <script src="scripts/cart.js"></script>
  </body>
</html>