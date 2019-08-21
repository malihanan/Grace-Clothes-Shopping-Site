<!DOCTYPE html>
<?php
if(!isset($_SESSION))
    session_start();
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
        
        <form method="post">
            <div class="details">
                <table>
                    <th>Give your review here:</th>
                    <tr>
                        <td><textarea name="review" placeholder="Not more than 500 letters :)"></textarea></td>
                    </tr>
                    <tr>
                        <td><div class="rateIcon">
                            <input type="radio" name="rate" value="good"><img src="./images/good.jpg"/></input>
                            <input type="radio" name="rate" value="avg"><img src="./images/avg.jpg"/></input>
                            <input type="radio" name="rate" value="bad"><img src="./images/bad.jpg"/></input></div>
                        </td>
                    </tr>
                    <tr>
                        <td><div class="yes"><input type="submit" name="submit" value="Submit"/></div></td>
                    </tr>
                </table>
            </div>
        </form>
        
        <?php
        
        if(isset($_POST['submit'])){
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="update grace_bought set review=?, rate=? where uid=? and pid=?";
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute(array($_POST['review'], $_POST['rate'], $_SESSION['user'], $_GET['p']));
                header('Location: profile.php');
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
        
        ?>
        
        <?php include './footer.php';?>
        
    </body>
</html>