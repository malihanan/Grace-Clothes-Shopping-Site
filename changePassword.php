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
                echo '<div class="heading"><img src="./images/profileHeading.jpg"/></div>';
                echo "<div class='details'>
                   <form method='post'>
                    <table>
                        <tr>
                            <td>Current Password:</td>
                            <td><input type='password' name='oldpassword'/></td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td><input type='password' maxlength='10' name='newpassword' maxlength='15' minlength='7'/></td>
                        </tr>
                        <tr>
                            <td>Reenter New Password:</td>
                            <td><input type='password' maxlength='10' name='reenterpassword' maxlength='15' minlength='7'/></td>
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
                        $sql = $dbhandler->prepare("select * from grace_user where id=".$id);
                        $sql->execute();
                        $row = $sql->fetch();
                        if($row['password']!=$_POST['oldpassword'])
                            echo '<div class="notFilled">Incorrect Current Password</div>';
                        else if($_POST['newpassword']!=$_POST['reenterpassword'])
                            echo "<div class='notFilled'>Passwords don't match.</div>";
                        else{
                            $sql2 = $dbhandler->prepare("update grace_user set password=? where id=".$id);
                            $sql2->execute(array($_POST['newpassword']));
                            if($sql2!=0)
                                header('Location: profile.php');
                        }
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