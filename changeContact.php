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
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $id=$_SESSION['user'];
                $sql = $dbhandler->prepare("select * from grace_user where id=".$id);
                $sql->execute();
                $row = $sql->fetch();
                echo '<div class="heading"><img src="./images/profileHeading.jpg"/></div>';
                echo "<div class='details'>
                   <form method='post'>
                    <table>
                        <tr>
                            <td>Your current contact:</td>
                            <td colspan='2'>".$row['contact']."</td>
                        </tr>
                        <tr>
                            <td>New Contact:</td>
                            <td><input type='number' maxlength='10' name='contact'/></td>
                        </tr>
                        <tr>
                            <td><input type='submit' name='submit' value='Change'</td>
                            <td><input type='reset'/></td>
                        </tr>
                      </table>
                    </form>";
            }
            catch(PDOException $e){
                echo $e->getMessage();
                die();
            }
            
            if(isset($_POST['submit'])){
                if(!empty($_POST['oldpassword']) || !empty($_POST['newpassword']) || !empty($_POST['reenterpassword'])){
                    try{
                        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $id=$_SESSION['user'];
                        $sql2 = $dbhandler->prepare("update grace_user set contact=? where id=".$id);
                        $sql2->execute(array($_POST['contact']));
                        if($sql2!=0)
                            header('Location: profile.php');
                    } catch (Exception $ex) {
                        echo $ex->getMessage();
                        die();
                    }
                }
                else{
                    echo '<div class="notFilled">Enter all fields</div>';
                }
            }
        ?>
        
        <?php include './footer.php';?>
        
    </body>
</html>