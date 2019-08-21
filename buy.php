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
        
        <?php include './header.php';

        if(isset($_SESSION['user'])){
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="select * from grace_cart where uid=".$_SESSION['user'];
                $stmt=$dbhandler->query($sql);
                $notany=0;
                $price=0;   $c=1;
                while($rows=$stmt->fetch()){
                    $notany++;
                    if($notany==1){
                        echo '<div class="details">';
                        echo '<table>';
                        echo '<th>Sr No.</th><th>Items in Cart</th><th>Size</th><th>Price</th>';
                    }
                    $sql="select * from grace_products where id=".$rows['pid'];
                    $stmt2=$dbhandler->query($sql);
                    $row = $stmt2->fetch();
                    echo "<tr><td>".$c."</td><td>".$row['name']."</td>";
                    echo "<td align='center'>".strtoupper($rows['size'])."</td>";
                    echo "<td>Rs. ".$row['price']."</td></tr>";
                    $price+=$row['price'];
                    $c+=1;
                }
                if($notany==0){
                    echo '<div class="details"><table><tr><td><div class="yes"><a href="index.php">Proceed To Buy</a></div></td></tr></table></div>';
                }
                else{
                    echo '<td/><td/><td/><td/><strong>Total: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Rs. '.$price.'</strong></td></tr></table></div>';
                    echo '<form action="checkout.php" method="post">
                        <div class="details">
                            <table>
                            <th colspan="2">Enter Shipping Details</th>
                                <tr>
                                    <td>Name of Receiver:</td>
                                    <td><input type="text" name="name"></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><textarea name="address"></textarea></td>
                                </tr>
                                <tr>
                                    <td>Contact No.:</td>
                                    <td><input type="number" name="contact"></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><div class="yes"><input type="submit" name="submit" value="Check Out"/></div></td>
                                </tr>
                            </table>
                        </div>
                    </form>';
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