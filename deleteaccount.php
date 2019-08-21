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
        
        <form method="post">
            <div class="details">
                <table>
                    <th colspan="2">Are you sure you want to delete your account?</th>
                    <tr></div>
                        <td><div class="yes"><input type="submit" name="yes" value="Yes"/></div></td>
                        <td><div class="no"><a href="index.php">No</a></div></td>
                    </tr>
                </table>
            
        </form>
        
        <?php
        if(isset($_POST['yes'])){
            try{
                $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $sql="delete from grace_user where id=".$_SESSION['user'];
                $stmt=$dbhandler->prepare($sql);
                $stmt->execute();
                header('Location: logout.php');
            }
            catch(PDOException $e){
                echo $e->getMessage().'<br><br><br><br><br><br>';
                die();
            }       
        }
        
        include './footer.php';?>
        
    </body>
</html>