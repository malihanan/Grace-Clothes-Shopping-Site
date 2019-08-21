<!DOCTYPE html>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
    <?php include './adminHeader.php';?>

    <?php
    try{
        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="Select * from grace_products where id=".$_GET['id'];
        $query=$dbhandler->prepare($sql);
        $query->execute();
        $row = $query->fetch();               
        echo "<form method='POST'>"
            . "<div class='details'>"
              . "<table>"
                . "<tr>"
                    . "<th width=5%>ID</th>"
                    . "<th width=25%>Name</th>"
                    . "<th>Image</th>"
                    . "<th>Small</th>"
                    . "<th>Medium</th>"
                    . "<th>Large</th>"
                    . "<th>Price</th>"
                    . "<th>Change</th>"
                . "</tr>"
                . "<tr>"
                    . "<td>".$row["id"]."</td>"
                    . "<td><input type='text' name='name' value='".$row["name"]."'/></td>"
                    . "<td> <img src='".$row['image']."'/></td>"
                    . "<td><input type='number' name='s' value='".$row["s"]."'/></td>"
                    . "<td><input type='number' name='m' value='". $row["m"]."'/></td>"
                    . "<td><input type='number' name='l' value='".$row["l"]."'/></td>"
                    . "<td><input type='number' name='price' value='".$row["price"]."'/></td>"
                    . "<td><input type='submit' value='Change' name='submit'/></td>"
                . "</tr>"
              . "</table>"
            . "</div>"
        . "</form>";
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
    
    if(isset($_POST['submit'])){
        if( empty($_POST['name']) || empty($_POST['s']) || empty($_POST['m']) || empty($_POST['l']) || empty($_POST['price']) ){
            echo '<h2 class="incorrect">Enter all fields.</h2>';
        }
        else{
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="update grace_products set  name ='".$_POST['name']."', s = ".$_POST['s'].
                        " , m = ".$_POST['m']. " ,l = ".$_POST['l'].
                        ", price = ".$_POST['price'] ." where id=".$_GET['id'];
                $query=$dbhandler->prepare($sql);
                $query->execute();
                echo 'sucessfully updated';
                header('Location: adminShow.php');
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
    }
 ?>