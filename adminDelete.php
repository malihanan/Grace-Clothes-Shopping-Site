<!DOCTYPE html>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
    <?php include './adminHeader.php';
    
    try{
        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sql="Select * from grace_products where id=".$_GET['id'];
        $query=$dbhandler->prepare($sql);
        $query->execute();
        $row = $query->fetch();
        echo '<form method="post">
            <h2>Are you sure you want to delete the item?</h2>
            <div class="details">
                <table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Item</th>
                </tr>
                <tr>
                    <td>'.$row['id'].'</td>
                    <td>'.$row['name'].'</td>
                    <td rowspan="2"><img src="'.$row['image'].'"/></td>
                </tr>
                <tr>
                    <td><div class="yes"><input type="submit" name="yes" value="Yes"/></div></td>
                    <td><div class="no"><a href="adminShow.php">No</a></div></td>
                </tr>
                </table>
            </div>
        </form>';
    }
    catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
    
    if(isset($_POST['yes'])){
        try{
            $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="delete from grace_products where id =".$_GET['id'];
            $query=$dbhandler->prepare($sql);
            $query->execute();
            header('Location: adminShow.php');
        }
        catch(PDOException $e){
            echo $e->getMessage();
            die();
        }    
    }
    
    ?>