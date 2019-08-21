<!DOCTYPE html>
<?php
if(!isset($_SESSION))
    session_start();

try{
    $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $sql="delete from grace_cart where uid=".$_SESSION['user']." and pid=?";
    $stmt=$dbhandler->prepare($sql);
    $stmt->execute(array($_GET['p']));
    header('Location: cart.php');
}
catch(PDOException $e){
    echo $e->getMessage().'<br><br><br><br><br><br>';
    die();
}       
?>