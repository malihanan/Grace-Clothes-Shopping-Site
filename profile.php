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
        
        <?php
            if(!isset($_SESSION['user']))
                echo '<h2> You are not logged in. </h2>';
            else{
                $id=$_SESSION['user'];
                try{
                        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql = $dbhandler->prepare("select * from grace_user where id=".$id);
                        $sql->execute();
                        $row = $sql->fetch();
                        echo '<div class="heading"><img src="./images/profileHeading.jpg"/></div>';
                        echo "<div class='details'>
                            <table>
                                <tr>
                                    <td>Name</td>
                                    <td colspan='2'>".$row['firstname']." ".$row['lastname']."</td>
                                </tr>
                                <tr>
                                    <td>Email-ID</td>
                                    <td colspan='2'>".$row['email']."</td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td>".$row['contact']."</td>
                                    <td><a href='changeContact.php'>Change</a></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td colspan='2'>".$row['gender']."</td>
                                </tr>
                                <tr>
                                    <td colspan='3'><a href='changePassword.php'>Change Password</a></td>
                                </tr>
                              </table>";
                        $stmt=$dbhandler->prepare("select * from grace_bought where uid=".$_SESSION{'user'});
                        $stmt->execute();
                        echo '<h2>Previously bought items:</h2></div><div class="details"><table>';
                        $c=0;
                        while ($rows = $stmt->fetch()) {
                            $c++;
                            if($c==1)
                                echo '<tr><th>Item</th>'
                                    . '<th>Name</th>'
                                    . '<th>Size</th>'
                                    . '<th>Price</th>'
                                    . '<th>Feedback</th></tr>';
                            $sql="select * from grace_products where id=".$rows['pid'];
                            $stmt2=$dbhandler->query($sql);
                            $row = $stmt2->fetch();
                            echo "<tr/><tr><td><a href='display.php?id=".$row['id']."'><div class='cartImg'><img src='".$row['image']."'/></div></a></td>".
                                    "<td>".$row['name']."</td>".
                                    "<td align='center'>".strtoupper($rows['size'])."</td>".
                                    "<td>Rs. ".$row['price']."</td>";
                            if($rows['review']==NULL && $rows['rate']==NULL)
                                echo "<td><a href='feedback.php?p=".$rows['pid']."'><div class='feedbackIcon'><img src='./images/review.png'></div></a></td>".
                                    "</tr>";
                            else
                                echo "<td><div class='feedbackIcon'><img src='./images/done.png'></div></td>".
                                    "</tr>";
                        }
                        echo '</table></div>';
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