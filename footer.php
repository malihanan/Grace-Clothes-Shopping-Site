<?php
if(!isset($_SESSION))
    session_start();
?>
<div class="empty"/>
<div class="footer">
    <?php
        if(isset($_SESSION['user'])){
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="select * from grace_user where id=".$_SESSION['user'];
                $stmt = $dbhandler->query($sql);
                $row = $stmt->fetch();
                echo '<div class="welcome">Happy Shopping '.$row['firstname'].' '.$row['lastname'].'!</div>';
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
        }
    ?>
    
    <a href="aboutUs.php">Contact Us</a>
    <?php
        if(isset($_SESSION['user'])){
            echo '<a href="deleteaccount.php">Delete Account</a>'.
                    '<a href="logout.php">LogOut</a>';
        }
    ?>
</div>