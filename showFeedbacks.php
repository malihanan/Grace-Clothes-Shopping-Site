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
        <?php
        if(isset($_SESSION['user']) && $_SESSION['user']==1)
            include './adminHeader.php';
        else
            include 'header.php';
        
        try{
            $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="select distinct uid, review, rate from grace_bought where pid=".$_GET['id'];
            $stmt=$dbhandler->query($sql);
            echo '<div class="details">'
                    . "<table>"
                    . "<th>Name</th>"
                    . "<th>Review</th>"
                    . "<th>Rating</th>";
            while($row = $stmt->fetch()){
                if($row['review']!=NULL || $row['rate']!=NULL){
                    $sql2="select * from grace_user where id=".$row['uid'];
                    $stmt2=$dbhandler->query($sql2);
                    $row2=$stmt2->fetch();
                    echo "<tr/><tr>"
                        . "<td>".$row2['firstname']." ".$row2['lastname']."</td>"
                        . "<td>";
                        if($row['review']!=NULL) echo $row['review'];
                    echo "</td><td><div class='rateIcon'>";
                    if($row['rate']!=NULL){
                        if($row['rate']=='good')
                            echo '<img src="./images/good.jpg"/>';
                        else if($row['rate']=='avg')
                            echo '<img src="./images/avg.jpg"/>';
                        else
                            echo '<img src="./images/bad.jpg"/>';
                    }
                    echo "</div></td></tr>";
                }
            }
            echo "</table></div></div></div>";
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }
        
        if(isset($_SESSION['user']) && $_SESSION['user']==1){}
        else
            include './footer.php';
    ?>
    </body>
</html>