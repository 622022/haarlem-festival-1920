<?php
  require_once(__DIR__ . "/service/event-service.php");
  $eventService = eventService::getInstance();
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
    <hr>
    <h3>July 27th</h3>

    <?php
      $eventCards = $eventService->generateEventCards(1);
      foreach ($eventCards as &$eventCard) {
        echo $eventCard;
      }
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
            <option></option>
            <option id="Time">Time</option>
            <option id="Price asc">Price asc.</option>
            <option id="Price desc">Price desc.</option>
          </select></td>
        </tr>
      </table>
    </div>

    <section class="shopping cart">

    </section>

  </body>
</html>