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
        
        <?php include './header.php';

        try{
            $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="select * from grace_products where id=".$_GET['id'];
            $stmt=$dbhandler->query($sql);
            $row = $stmt->fetch();
            echo '<div class="display">';
            echo "<div class='row'><div class='column'><img src='".$row['image']."'/></div>".
                    "<div class='column'>"
                    . "<div class='details'>"
                    . "<table>"
                    . "<th colspan='2'>".$row['name']."</th>"
                    . "<tr>"
                    . "<td>Price: </td>"
                    . "<td>Rs. ".$row['price']."</td>"
                    . "</tr>";
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        include './footer.php';?>
        
        <form action="<?php $_PHP_SELF ?>" method="post">
                <tr>
                    <td>Size:</td>
                    <td>
                        <input type="radio" name="size" value="s">Small</input>
                        <input type="radio" name="size" value="m">Medium</input>
                        <input type="radio" name="size" value="l">Large</input>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="buy" value="Add to Cart"/></td>
                </tr>
                <tr>
                    <td colspan="2"><div class='linkText'><a href="showFeedbacks.php?id=<?php echo $_GET['id']; ?>">Show Feedbacks</a></div></td>
                </tr>
        </form>
        
        <?php
        if(isset($_POST['buy'])){
            if(isset($_SESSION['user'])){
                if(!isset($_POST['size']))
                    echo '<tr></td colspan="2"><div class="notFilled">Please select size</div></td></tr>';
                else{
                    try{
                        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql="select ".$_POST['size']." from grace_products where id=".$_GET['id'];
                        $stmt=$dbhandler->query($sql);
                        $row = $stmt->fetch(PDO::FETCH_COLUMN);
                        if($row==0)
                            echo '<tr><td colspan="2"><div class="notFilled">Size not available.</div></td></tr>';
                        else{
                            $sql="insert into grace_cart(uid, pid, size) values(".$_SESSION['user'].",".$_GET['id'].",'".$_POST['size']."')";
                            $stmt=$dbhandler->query($sql);
                            echo '<tr><td colspan="2"><div class="successful">successfully added item.</div></tr></td></table></div></div>';
                        }
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                    }
                }
            }
            else{
                header('Location: login.php');
            }
        }
        ?>
        <br/><br/><br/>
    </body>
</html>