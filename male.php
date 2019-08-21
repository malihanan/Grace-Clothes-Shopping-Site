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

        <div class="heading"><img src="./images/menHeading.jpg"/></div>        
        <div class="row">
            <div class="column">
              <h2>T-Shirt</h2>
              <a href="type.php?category=male&type=t-shirt"><img src="./images/tshirt.jpg"/></a>
            </div>

            <div class="column">
              <h2>Shirt</h2>
              <a href="type.php?category=male&type=shirt"><img src="./images/shirt.jpg"/></a>
            </div>

            <div class="column">
              <h2>Bottoms</h2>
              <a href="type.php?category=male&type=bottoms"><img src="./images/bottoms.jpg"/></a>
            </div>
        </div>
        
        <?php include './footer.php';?>
        
    </body>
</html>