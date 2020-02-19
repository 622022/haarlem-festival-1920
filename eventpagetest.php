<?php
  // CONCEPT
  // function generateCart() {
  //   $html = "";
  //   for($i = 0; $i < count($_SESSION["cart"]["items"]); $i++) {
  //     $item = $_SESSION["cart"]["items"][$i];
  //     $html += "
  //     <div class=\"box-container\">
  //     <p>" . $item["event"]->price * $item["count"] . "</p>
  //     <input type=\"text\" class=\"count\" name=\"count-{$i}\ action=\"controller/cart-controller.php?itemId={$i}&action=setCount&count={$count}\"> <!-- count??? -->
  //     <button class=\"increment\" name=\"increment-{$i}\" action=\"controller/cart-controller.php?itemId={$i}&action=increment\"
  //     <p>" . $item["event"]->getName() . "</p>
  //     <button class=\"decrement\" name=\"decrement-{$i}\" action=\"controller/cart-controller.php?itemId={$i}&action=decrement\"
  //     <button class=\"remove\" name=\"remove-{$i}\" action=\"controller/cart-controller.php?itemId={$i}&action=remove\"
  //     ";
  //   }
  //   return $html;
  // }

  //$events = $eventService->getAllEvents(1);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
      <h2>You can save upto <span>*50%</span> off if you buy an all-access pass </h2>
      <button div id="all-accessbtn" type="button">All-access pass</button>
      <h3>or</h3>
      <h4>order-seperately</h4>
    </section>

    <section id="cards"></section>

    <section class="filter">
      <h3>Filters</h3>
      <div id=filter-artist>
        <h4 id="Artist">Artists</h4>
        <div class="checkbox">
          <label><input type="checkbox" name="Nicky Romero"/>Nicky romero</label>
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
      </div>  
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

    <section class="cart">
      <?php 
      //generateCart();      
      ?>

      <!-- Total Price Here -->
      <!-- Checkout Button Here -->
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
        console.log(data);
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

  </body>
</html>