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
          <form action="<?php $_PHP_SELF ?>" method="post">
            <div class="details">
            <table>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category" onchange="this.form.submit()">
                            <option name="male" value="male" <?php if(isset($_POST["category"]) && $_POST["category"]=="male"){echo "selected=selected";}?> > Male </option>
                            <option name="female" value="female" <?php if(isset($_POST["category"]) && $_POST["category"]=="female"){echo "selected=selected";}?> > Female </option>
                            <option name="kids" value="kids" <?php if(isset($_POST["category"]) && $_POST["category"]=="kids"){echo "selected=selected";}?> > Kids </option>
                        </select>
                    </td>
                </tr>
        </form>
         <form action="<?php $_PHP_SELF ?>" method="post">
            <?php
            if(isset($_POST['category']))
                echo '<input type="hidden" name="category" value="'.$_POST['category'].'"/>';
            else
                echo '<input type="hidden" name="category" value="male"/>';
            ?>
                <tr>
                    <td>Type:</td>
                    <td>
                        <?php
                        if(isset($_POST['category'])){
                            if($_POST['category']=='kids'){
                                echo '
                                <select name="type">
                                    <option name="tops" selected>Tops</option>
                                    <option name="bottoms">Bottoms</option>
                                    <option name="sets">Sets</option>
                                </select>';
                            }
                            elseif ($_POST['category']=='female') {
                                echo '
                                <select name="type">
                                    <option name="tops">Tops</option>
                                    <option name="bottoms">Bottoms</option>
                                    <option name="traditional">Traditional</option>
                                </select>';
                            }
                            else{
                                echo '
                                <select name="type">
                                    <option name="tshirt">T-Shirt</option>
                                    <option name="shirt">Shirt</option>
                                    <option name="bottoms">Bottoms</option>
                                </select>';
                            }
                        }
                        else{
                            echo '
                            <select name="type">
                                <option name="tshirt">T-Shirt</option>
                                <option name="shirt">Shirt</option>
                                <option name="bottoms">Bottoms</option>
                            </select>';
                        }
                        ?>
                        </td></tr>
          <tr>
                    <td><input type="submit" name="submit" value="submit"/></td>
                    <td><input type="reset"/></td>
                </tr>
         </table>
       </form>
<?php
    if(isset($_POST['submit'])){
        if( !isset($_POST['category']) || !isset($_POST['type'])){
            echo '<h2 class="incorrect">Enter all fields.</h2>';
    }
    else{
        try{
            $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
            $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $sql="Select * from grace_products where category='".$_POST['category'].
                    "'and type='".$_POST['type']."'";
            $query=$dbhandler->prepare($sql);
            $query->execute();
            if (count($query)  > 0) {
            echo "<div class='details'>"
                . "<table>"
                    . "<tr>"
                    . "<th width=5%>ID</th>"
                    . "<th>Item</th>"
                    . "<th>Name</th>"
                    . "<th>Small</th>"
                    . "<th>Medium</th>"
                    . "<th>Large</th>"
                    . "<th>Price</th>"
                    . "<th>Update</th>"
                    . "<th>Delete</th>"
                    . "<th>FeedBacks</th>"
                    . "</tr>";
    // output data of each row
    while($row = $query->fetch()) {
        echo "<tr>"
            . "<td>".$row["id"]."</td>"
            . "<td><img src='".$row['image']."'/></td>"
            . "<td>".$row["name"]."</td>"
                . "<td>".$row["s"]."</td>"
                . "<td>".$row["m"]."</td>"
                . "<td>".$row["l"]."</td>"
                . "<td>Rs. ".$row["price"]."</td>"
                . "<td><a href='adminUpdate.php?id=".$row['id']."'>UPDATE</a></td>"
                . "<td><a href='adminDelete.php?id=".$row['id']."'>DElETE</a></td>"
                . "<td><a href='showFeedbacks.php?id=".$row['id']."'>Feedbacks</a></td>"
                . "</tr>";
    }
    echo "</table></div>";
} else {
    echo "0 results";
}
                    }
                    catch(PDOException $e){
                            echo $e->getMessage();
                            die();
                                           }
                                           
  }
  }
  ?>
</body>

        
        
       </html> 
        