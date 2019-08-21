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

        <div class="heading"><img src="./images/kidsHeading.jpg"/></div>
        <div class="row">
            <div class="column">
              <h2>Tops</h2>
              <a href="type.php?category=kids&type=tops"><img src="./images/ktops.jpg"/></a>
            </div>

            <div class="column">
              <h2>Sets</h2>
              <a href="type.php?category=kids&type=sets"><img src="./images/sets.png"/></a>
            </div>

            <div class="column">
              <h2>Bottoms</h2>
              <a href="type.php?category=kids&type=bottoms"><img src="./images/kbottoms.jpg"/></a>
            </div>
        </div>
        
        <?php include './footer.php';?>
        
    </body>
</html>