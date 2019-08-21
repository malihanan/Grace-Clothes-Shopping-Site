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
                        
                    </td>
                </tr>
                <tr>
                    <td>Image:</td>
                    <td><input type="file" name="image"/></td>
                </tr>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" name="name" placeholder="name"/></td>
                </tr>
                <tr>
                    <td>S:</td>
                    <td><input type="number" name="s"/></td>
                </tr>
                <tr>
                    <td>M:</td>
                    <td><input type="number" name="m"/></td>
                </tr>
                <tr>
                    <td>L:</td>
                    <td><input type="number" name="l"/></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="number" name="price"/></td>
                </tr>
        </table><table>
                <tr>
                    <td><input type="submit" name="submit" value="Submit"/></td>
                    <td><input type="reset"/></td>
                </tr>
            </table>
            </div>
        </form>
        
        <?php
        if(isset($_POST['submit'])){
            if( !isset($_POST['category']) || !isset($_POST['type']) || empty($_POST['image']) || empty($_POST['name']) || empty($_POST['s']) || empty($_POST['m']) || empty($_POST['l']) || empty($_POST['price']) ){
                echo '<h2 class="incorrect">Enter all fields.</h2>';
                if( !isset($_POST['category']))
                        echo 'lol';
            }
            else{
                try{
                    $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                    $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $sql="insert into grace_products(category, type, image, name, s, m, l, price)"
                            . "values(?,?,?,?,?,?,?,?)";
                    $query=$dbhandler->prepare($sql);
                    $query->execute(array($_POST['category'], $_POST['type'], $_POST['image'], $_POST['name'], $_POST['s'], $_POST['m'], $_POST['l'], $_POST['price']));
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