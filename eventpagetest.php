<?php
  session_start();
  require_once(__DIR__ . "/service/event-service.php");
  $eventService = eventService::getInstance();  

  function generateEventCard($event) {
    return "
    <section class=\"eventcard1\">
      <div class=\"box-container\">
      <img src=\"{$event->image->url}\" alt=\"{$event->image->description}\">
      <h2>€{$event->price}</h2>
      <button id=\"addbtn\" type=\"button\" name=\"add-{$event->id}\" action=\"controller/cart-controller.php?eventId={$event->id}\">ADD</button>
      <h3>{$event->getName()}</h3>
      <h4>{$event->programmeItem->location}</h4>
      <h4>{$event->programmeItem->startsAt}-{$event->programmeItem->endsAt}</h4>
    </section>
    ";
  }

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

    <script>
    
    $(function(){
      $("#product").change(function(){
          var selectedValue = $(this).children("option:selected").val();
          if(selectedValue == 1){
            //generateSortedEvent();
            alert("You have selected this value - " + selectedValue);
            //$(".eventcard").hide();
            //$(".eventcard1").show();
            //generateEvent().stop();
            
          }
         
       });
    });
    </script>


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
    <hr>
    <h3>July 27th</h3>

    <section id="cards">
    <hr>
    <h3>July 27th</h3>
    <?php generateEvent(); ?>
    </section>

    <?php

      function generateSortedEvent()
      {
        $eventService = eventService::getInstance();
        $events = $eventService->getSortedEvents(1);
        foreach($events as &$event) { echo generateSortedEventCard($event); }
      }
      function generateEvent()
      {
        $eventService = eventService::getInstance();
        $events = $eventService->getAllEvents(1);
        foreach($events as &$event) { echo generateEventCard($event); }
      }
      //foreach($events as &$event) { echo generateEventCard($event); }
      generateEvent();
      //generateSortedEvent();
    ?>

    <div class="filter">
      <h3>Filters</h3>
      <h4 div id="Artist">Artists</h4>
        <div class="checkbox">
          <label><input type="checkbox" rel="Nicky Romero" onchange="change()"/>Nicky romero</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Afrojack" onchange="change()"/>Afrojack</label>
       </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Tiesto" onchange="change()"/>Tiesto</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Hardwell" onchange="change()"/>Hardwell</label>
        </div>
      <h4 div id="Location">Locations</h4>
        <div class="checkbox">
          <label><input type="checkbox" rel="Nicky Romero" onchange="change()"/>Lichtfabriek</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Afrojack" onchange="change()"/>Club Stalker</label>
       </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Tiesto" onchange="change()"/>Jopenkerk</label>
        </div>
        <div class="checkbox">
          <label><input type="checkbox" rel="Hardwell" onchange="change()"/>XO the Club</label>
        </div>   
    </div>

    <div class="Sort">
      <table>
        <tr>
          <td>Sorting by</td>
          <td><select name="product" id="product">
            
            <option selected value="0" id="Time">Time</option>
            <option value="1" id="Price asc">Price asc.</option>
            <option value="2" id="Price desc">Price desc.</option>
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
      $.ajax({
        url:""
      });
    }
    </script>

  </body>
</html>