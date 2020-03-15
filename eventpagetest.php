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
      // Setup

      function loadCart() {
        $.ajax({
          url:"./controller/cart-controller.php",
          method:"GET",
          data:{getCart:""},
          success: function(data) {
            var cart = data["cart"]; //var cart = data["cart"] ?? {}; // Chrome does not support coalescence yet.
            console.log(cart); // For debugging
            cart.forEach(function(item) { createItem(item.id, item.image, item.name, item.count, item.price); });   
          },
          error: function() {
            console.log("There was an error with the 'cart' AJAX call.");
          }
        });
      }





      // Interaction Events

      $(document).on("change", ".cartitem-count", function() {
        if($(this).val() < 1) { $(this).val(1); } // Only 1 or more is allowed

        let that = this;
        $.get("/controller/cart-controller.php", {itemId:getItemId(this), action:"setCount", count:this.value}).done(function() {
          updatePrice(getItemId(that)); //Update price if successfull
          $(this).data("lastCount", this.value); // Update last count
        }).fail(function() {
            //$(this).val($(this).data("lastCount") ?? $(this).defaultValue); // Undo change // Chrome does not support coalescence yet.
            $(that).val($(that).data("lastCount")); // Undo change
        });
      });

      $(document).on("click", ".cartitem-decrement", function() {
        var countElement = $(this).siblings(".cartitem-count");
        if(countElement.val() > 1) { // Do not decrement if result would become less than 1.
          let that = this;
          $.get("controller/cart-controller.php", {itemId:getItemId(this), action:"decrement"}).done(function() {
            updatePrice(getItemId(that)); //Update price if successfull
          }).fail(function() {
            countElement.val(+countElement.val()+1); // Undo change
          });
          countElement.val(+countElement.val()-1);
        }
      });

      $(document).on("click", ".cartitem-increment", function() {
        var countElement = $(this).siblings(".cartitem-count");
        let that = this;
        $.get("controller/cart-controller.php", {itemId:getItemId(this), action:"increment"}).done(function() {
          updatePrice(getItemId(that)); //Update price if successfull
        }).fail(function() {
          countElement.val(+countElement.val()-1); // Undo change
        });
        countElement.val(+countElement.val()+1);
      });
      
      $(document).on("click", ".cartitem-remove", function() {
        var cartItemElement = $(this).parent();
        $.get("controller/cart-controller.php", {itemId:getItemId(this), action:"remove"}).done(function() {
          cartItemElement.remove(); // Remove completely if successful
        }).fail(function() {
          cartItemElement.show(); // Re-appear if unsuccessfull (Undo change)
        });
        cartItemElement.hide(); // Hide until confirmed for removal
      });

      $(document).on("click", ".addbtn", function() {
        $.get("controller/cart-controller.php", {eventId: getEventId(this)}).done(function(data) {
          //var cartItem = data["item"] ?? {}; // Chrome does not support coalescence yet.
          if(data["item"]) {
            var cartItem = data["item"];
            createItem(cartItem.id, cartItem.image, cartItem.name, cartItem.count, cartItem.price);
          } else if (data["added"]) {
            let countElement = $(`.cartitem[name$="${data["itemId"]}"] .cartitem-count`);
            countElement.val(+countElement.val()+1);
            updatePrice(data["itemId"]);
          }
        });
      });





      // TOOLS
      function createItem(id, image, name, count, price) {
        $("#cart-items").append(generateItemHtml(id, image, name, count, price));
        var cartItemElement = $("#cart-items > .cartitem").last();
        cartItemElement.data("id", id);
        cartItemElement.children(".cartitem-count").data("lastCount", count);
        cartItemElement.children(".cartitem-price").data("singlePrice", price);
      }

      function generateItemHtml(id, image, name, count, price) {
        var html =
        `<div class="cartitem" name="cartitem-${id}">` +
        ` <img src="${image}">` +
        ` <p class="cartitem-name">${name}</p>` +
        ` <button class="cartitem-decrement">-</button>` +
        ` <input type="number" class="cartitem-count" min=1 max=10 value="${count}">` +
        ` <button class="cartitem-increment">+</button>` +
        ` <p class="cartitem-price">€${parseFloat((price*count).toFixed(2))}</p>` +
        ` <button class="cartitem-remove"><img src="/icon/delete.svg"></button>` +
        `</div>`;

        return html;
      }

      function getItemId(element) {
        return $(element).closest(".cartitem").data("id");
      }

      function getEventId(element) {
        return $(element.closest(".eventcard")).attr("name").match(/[0-9]+/)[0];
      }

      function updatePrice(itemId) {
        var cartItemElement = $(`.cartitem[name$="${itemId}"]`);
        var priceElement = cartItemElement.children(".cartitem-price");
        var countElement = cartItemElement.children(".cartitem-count");

        var newPrice = priceElement.data("singlePrice") * countElement.val();
        priceElement.text(`€${parseFloat(newPrice.toFixed(2))}`);
      }





      // Execution

      loadCart();
    });
    </script>
  </body>
</html>