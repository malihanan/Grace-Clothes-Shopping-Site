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

        if(isset($_SESSION['user'])){
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="select * from grace_cart where uid=".$_SESSION['user'];
                $stmt=$dbhandler->query($sql);
                $notany=0;
                echo '<div class="details">';
                echo '<table>';
                $price=0; $c=0;
                while($rows=$stmt->fetch()){
                    $notany++;
                    if($notany==1){
                        echo '<th>Item</th>'
                        . '<th>Name</th>'
                                . '<th>Size</th>'
                                . '<th>Price</th>'
                                . '<th>Remove Product</th>';
                    }
                    $sql="select * from grace_products where id=".$rows['pid'];
                    $stmt2=$dbhandler->query($sql);
                    $row = $stmt2->fetch();
                    echo "<tr><td><a href='display.php?id=".$row['id']."'><div class='cartImg'><img src='".$row['image']."'/></div></a></td>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td align='center'>".strtoupper($rows['size'])."</td>";
                    echo "<td>Rs. ".$row['price']."</td>";
                    echo "<td><a href='remove.php?p=".$rows['pid']."'><div class='crossIcon'><img src='images/cross.png'></div></a></td></tr>";
                    $price+=$row['price'];
                }
                if($notany==0){
                    echo '<h2>Empty Cart!</h2>'.
                            '<div class="details"><table><td><div class="yes"><a href="index.php">Proceed to Buy</a></div></td></table></div>';
                }
                else{
                echo '<td colspan="4"><h2>Total Price: Rs. '.$price.'</h2></td>';
                echo '<td><div class="yes"><a href="buy.php">Proceed to Buy</a></div></td>';
                echo '</table>';
                echo '</div>';
                }
            }
            catch(PDOException $e){
                echo $e->getMessage().'<br><br><br><br><br><br>';
                die();
            }
        }
        else{
            header('Location: login.php');
        }
        
        include './footer.php';?>
        
    </body>
</html>