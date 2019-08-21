<?php
if(!isset($_SESSION))
    session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php include './header.php';
        if(strcmp($_GET['type'], 'all')!=0 && strcmp($_GET['category'], 'all')!=0)
            echo '<div class="heading"><img src="./images/'.$_GET['type'].'Heading.jpg"/></div>';
        try{
            $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            if(strcmp($_GET['category'],'all')==0 && strcmp($_GET['type'],'all')==0){
                $sql="select * from grace_products";
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute();
            }
            else if(strcmp($_GET['category'], 'all')==0){
                $sql="select * from grace_products where type=?";
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute(array($_GET['type']));
            }
            else if(strcmp($_GET['type'],'all')==0){
                $sql="select * from grace_products where category=?";
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute(array($_GET['category']));
            }
            else{
                $sql="select * from grace_products where category=? and type=?";
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute(array($_GET['category'], $_GET['type']));
            }
            echo '<div class="display">';
            $count=0;
            echo '<table>';
            while ($row = $stmt->fetch()) {
                if($count==3){
                    echo '</tr>';
                    $count=0;
                }
                if($count==0)
                    echo '<tr>';
                echo "<td><a href='display.php?id=".$row['id']."'><img src='".$row['image']."'/></a><br />\n";
                echo $row['name']."<br />\n";
                echo "Rs. ".$row['price']."<br />\n</td>";
                $count++;
            }
            echo '</table>';
            echo '</div>';
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        include './footer.php';?>
        
    </body>
</html>