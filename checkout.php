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
            echo '<div class=details>'
                . '<table>'
                . '<th colspan="2">Order Placed Successfully!</th>'
                . '<tr>'
                    . '<td>Name:</td>'
                    . '<td>'.$_POST['name'].'</td>'
                . '</tr>'
                . '<tr>'
                    . '<td>Address:</td>'
                    . '<td>'.$_POST['address'].'</td>'
                . '</tr>'
                . '<tr>'
                    . '<td>Contact No.</td>'
                    . '<td>'.$_POST['contact'].'</td>'
                . '</tr>'
                . '</table>';
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="select * from grace_cart where uid=".$_SESSION['user'];
                $stmt=$dbhandler->query($sql);
                echo '<table>'.
                        '<th colspan="3">Items Bought: </th>';
                
                $total=0;
                while($rows=$stmt->fetch()){
                    $sql0="select * from grace_products where id=?";
                    $stmt0=$dbhandler->prepare($sql0);
                    $stmt0->execute(array($rows['pid']));
                    $row0=$stmt0->fetch();
                    echo '<tr>'
                        . '<td><img src="'. $row0['image'].'"/></td>'
                        . '<td>'. $row0['name'].'</td>'
                        . '<td>Rs.'. $row0['price'].'</td>'
                        . '</tr>';
                    $total+=$row0['price'];
                    $size=$rows['size'];
                    if($size == 's')
                        $sql1="update grace_products set s=s-1 where id=".$rows['pid'];
                    else if($size == 'm')
                        $sql1="update grace_products set m=m-1 where id=".$rows['pid'];
                    else
                        $sql1="update grace_products set l=l-1 where id=".$rows['pid'];
                    $stmt1=$dbhandler->query($sql1);
                    $sql2="insert into grace_bought(uid, pid, size, name, address, contact) values(?,?,?,?,?,?)";
                    $stmt2=$dbhandler->prepare($sql2);
                    $stmt2->execute(array($_SESSION['user'], $rows['pid'], $rows['size'], $_POST['name'], $_POST['address'], $_POST['contact']));
   
                }
                echo '<tr><td colspan="3">Total: Rs. '.$total.'</td></tr>'
                    . '</table>'
                    . '</div>';
                
                $sql3="delete from grace_cart where uid=".$_SESSION['user'];
                $stmt3=$dbhandler->query($sql3);
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