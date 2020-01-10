<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="event.css">
    <title>Dance event</title>
  </head>
  <body>
    <div class="navbar">
      <a href="#DANCE">DANCE</a>
      <a href="#JAZZ">JAZZ</a>
      <a href="#FOOD">FOOD</a>
    </div>

    <div class="row">
        <div class="col-xl">
        <h2>TITLE HEADING</h2>
        <button type="button" class="btn btn-primary"> Add </button>
        <div class="col"></div>
        <div class="col"></div>
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