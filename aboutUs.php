<!DOCTYPE html>
<?php
if(!isset($_SESSION))
    session_start();
?>
<html>
    <head>
        <title>About US</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php include './header.php';?>
        
        <div class="container">
            <img src="images/background.jpg"/>
            <div class="containee">
                <h2>Connect with us through social media:</h2><br/><br/>
                <table>
                    <tr>
                        <td>Email Us:</td>
                        <td><a href="mailto:malihanan09@gmail.com">connect@grace.com</a></td>
                    </tr>
                    <tr>
                        <td>Instagram:</td>
                        <td><a href="https://instagram.com/mia9059">@grace</a></td>
                    </tr>
                    <tr>
                        <td>Facebook:</td>
                        <td><a href="https://m.facebook.com">@grace_page</a></td>
                    </tr>
                    <tr>
                        <td>Twitter:</td>
                        <td><a href="https://twitter.com/mia9059">@grace</a></td>
                    </tr>
                </table><br/><br/><br/>
                  <p>
                    Get the latest trends here.<br/>
                    We at grace are a community of people who believe in delivering the best.<br/>
                    Give a boost of style in your lifestyle.<br/>
                    Get the best brands at affordable rates.<br/><br/>
                </p>
                <h2>
                    We Thank You for the visit!
                </h2>
            </div>
        </div>
        <!--
        <div class="heading"><img src="./images/connectHeading.jpg"/></div>
        <table>
            <tr>
                <td>Contact Us:</td>
                <td>8758550122</td>
            </tr>
            <tr>
                <td>Email Us:</td>
                <td><a href="mailto:malihanan09@gmail.com">connect@grace.com</a></td>
            </tr>
            <tr>
                <td>Instagram:</td>
                <td><a href="https://instagram.com/mia9059">@grace</a></td>
            </tr>
            <tr>
                <td>Facebook:</td>
                <td><a href="https://m.facebook.com">@grace_page</a></td>
            </tr>
            <tr>
                <td>Twitter:</td>
                <td><a href="https://twitter.com/mia9059">@grace</a></td>
            </tr>
        </table>
        <h2>
            We Thank You for the visit!
        </h2>
-->
        <?php include './footer.php';?>
        
    </body>
</html>

