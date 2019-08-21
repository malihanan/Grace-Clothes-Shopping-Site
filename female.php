<!DOCTYPE html>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php include './header.php';?>
            
        <div class="heading"><img src="./images/womenHeading.jpg"/></div>
        <div class="row">
            <div class="column">
              <h2>Tops</h2>
              <a href="type.php?category=female&type=tops"><img src="./images/tops.jpg"/></a>
            </div>

            <div class="column">
              <h2>Bottoms</h2>
              <a href="type.php?category=female&type=bottoms"><img src="./images/fbottoms.jpg"/></a>
            </div>

            <div class="column">
              <h2>Traditional</h2>
              <a href="type.php?category=female&type=traditional"><img src="./images/traditional.jpg"/></a>
            </div>
        </div>
        
        <?php include './footer.php';?>
        
    </body>
</html>