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
      <div id="cart-items">
        <!-- Generate Cart Items Here -->   
      </div>
      <h3 name="Total-Price"><!-- Total Price Here --></h3>
      <button id="checkout" type="button">Checkout</button>
    </section>

    

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(function() {
      var filter = {artists:[], locations:[]};
      var sort = $("#sort").val();

      function generateEventCards() {
        var data = {};

        filter["artists"].length > 0 || filter["locations"].length > 0 ? data["filter"] = filter : null;        
        sort.length > 0 ? data["sort"] = sort : null;
        
        $.ajax({
          url:"./controller/ajax/eventcards-handler.php",
          method:"POST",
          data:data, // Put filter and sort options here.
          success: function(data) {
            $("#cards").html(data);
          },
          error: function() {
            console.log("There was an error with the 'cards' AJAX call.");
          }
        });
      }

      $(".filter input[type=checkbox]").change(function() {
        if($(this).closest("#filter-artist").length) {
          if(this.checked) {
            filter["artists"].push(this.name);
          } else {
            let index = filter["artists"].indexOf(this.name);
            if(index != -1) {
              filter["artists"].splice(index, 1);
            }
          }
        } else if($(this).closest("#filter-location").length) {
          if(this.checked) {
            filter["locations"].push(this.name);
          } else {
            let index = filter["locations"].indexOf(this.name);
            if(index != -1) {
              filter["locations"].splice(index, 1);
            }
          }
        }

        generateEventCards();
      });

      $("#sort").change(function() {
        sort = this.value;
        generateEventCards();
      });

      generateEventCards();
    });
    </script>

    <script>
    $(function() {
      function loadCart() {
        $.ajax({
          url:"./controller/cart-controller.php",
          method:"GET",
          data:{getCart:""},
          success: function(data) {
            //var cart = data["cart"] ?? {}; // Chrome does not support coalescence yet.
            var cart = data["cart"];
console.log(cart);
            var html = "";
            cart.forEach(function(item) {
              html += generateItemHtml(item.id, item.image, item.name, item.count, item.price);
            });
            // EXAMPLE: `$_SESSION["cart"]["items"][0]["event"], $_SESSION["cart"]["items"][0]["count"]`;        
            $("#cart-items").html(html);
          },
          error: function() {
            console.log("There was an error with the 'cart' AJAX call.");
          }
        });
      }

      $(".cartitem-count").change(function() {
        //$.get(`/controller/cart-controller.php?itemId={$i}&action=setCount&count=${this.value}`);
        $.get("/controller/cart-controller.php", {itemId:getItemId(this, ".cartitem"), action:"setCount", count:this.value}).fail(function() {
            //this.val(this.data("lastCount") ?? this.defaultValue); // Undo change // Chrome does not support coalescence yet.
            this.val(this.data("lastCount") ? this.data("lastCount") : this.defaultValue); // Undo change
        });

        this.data("lastCount", this.value); // Update last count
      });

      $(".cartitem-decrement").click(function() {
        var countElement = this.siblings(".cartitem-count");
        $.get("controller/cart-controller.php", {itemId:getItemId(this, ".cartitem"), action:"decrement"}).fail(function() {
          countElement.val(++this.value); // Undo change
        });
        countElement.val(--this.value);
      });

      $(".cartitem-increment").click(function() {
        var countElement = this.siblings(".cartitem-count");
        $.get("controller/cart-controller.php", {itemId:getItemId(this, ".cartitem"), action:"increment"}).fail(function() {
          countElement.val(--this.value); // Undo change
        });
        countElement.val(++this.value);
      });
      
      $(".cartitem-remove").click(function() {
        var cartItemElement = this.parent();
        $.get("controller/cart-controller.php", {itemId:getItemId(this, ".cartitem"), action:"remove"}).done(function() {
          cartItemElement.remove(); // Remove completely if successful
        }).fail(function() {
          cartItemElement.show(); // Re-appear if unsuccessfull (Undo change)
        });
          cartItemElement.hide(); // Hide until confirmed for removal
      });

      $(".addbtn").click(function() {
        $.get("controller/cart-controller.php", {eventId: getItemId(this, ".eventcard")}).done(function(data) {
          //var cartItem = data["item"] ?? {}; // Chrome does not support coalescence yet.
          var cartItem = data["item"];
          var html = generateItemHtml(cartItem.id, cartItem.image, cartItem.name, cartItem.count, cartItem.price);
          $("#cart-items").append(html);
        });
      });

      // TOOLS
      function generateItemHtml(id, image, name, count, price) {
        var html =
        `<div class="cartitem" name="cartitem-${id}">` +
        ` <img src="${image}">` +
        ` <p class="cartitem-name">${name}</p>` +
        ` <button class="cartitem-decrement">-</button>` +
        ` <input type="number" class="cartitem-count" min=1 max=10 value="${count}">` +
        ` <button class="cartitem-increment">+</button>` +
        ` <p class="cartitem-price">${price*count}</p>` +
        ` <button class="cartitem-remove"><img src="/icon/delete.svg"></button>` +
        `</div>`;

        return html;
      }

      function getItemId(element, parentElement) {
        return element.closest(parentElement).attr("name").search(/[0-9]+/);
      }

      function updatePrice(element) {

      }

      loadCart();
    });
    </script>
  </body>
</html>