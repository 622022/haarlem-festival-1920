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
          <li class="navbaritems"><a div id= "jazz" href="#jazz">JAZZ</a></li>
          <li class="navbaritems"><a div id= "food" href="#food">FOOD</a></li>
        </ul>
      </nav>  
    </header>

    <section class = "all-access">
      <h2>You can save upto <span>*50%</span> off if you buy an all-access pass </h2>
      <button div id="all-accessbtn" type="button">All-access pass</button>
      <h3>or</h3>
      <h4>order-seperately</h4>
    </section>

    <section class="events">
      <hr>
      <h3>July 27th</h3>
      <div id="u1477" class="ax_default box_1">
          <div id="u1477_div" class=""></div>
          <div id="u1477_text" class="text " style="display:none; visibility: hidden">
            <p>yo whataipbj</p>
          </div>
        </div>
      </div>

   

    

    <!-- <?php
    function generateProjectCard($projectName, $projectDescription, $projectLanguage)
    {
        $projectLink = preg_replace("/[^a-zA-Z]/", "", strtolower(preg_replace("/\|.*/", "", $projectName)));
        $projectName = preg_replace("/\|/", "", $projectName);
        echo
            '<a href="projects/'.$projectLink.'.php" class="project-card">
                <img src="i/a/pro/'.$projectLink.'-banner.png" alt="'.$projectName.' screenshot">
                <h2>'.$projectName.'</h2>
                <p>'.$projectDescription.'</p>
                <img src="i/a/ico/'.$projectLanguage.'.svg" alt="'.$projectLanguage.' Logo" class="project-card-lang">
            </a>';
    }
    ?> 
  </body>
</html>