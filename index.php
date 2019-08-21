<!DOCTYPE html>
<?php
if(!isset($_SESSION))
    session_start();
$_SESSION['currentpage']=$_SERVER['REQUEST_URI'];
?>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php include './header.php';?>
        <div class="heading">
            <img src="./images/heading.jpg"/>
        </div>
        
        <div class="row">
            <div class="column">
              <h2>Men</h2>
              <a href="male.php"><img src="./images/maleLinked.jpg"/></a>
            </div>

            <div class="column">
              <h2>Women</h2>
              <a href="female.php"><img src="./images/femaleLinked.jpg"/></a>
            </div>

            <div class="column">
              <h2>Kids</h2>
              <a href="kids.php"><img src="./images/kidsLinked.jpg"/></a>
            </div>
        </div>

        <?php include './footer.php';?>
        
    </body>
</html>