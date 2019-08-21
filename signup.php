<?php
if(!isset($_SESSION))
    session_start();
?>
<html>
<head>
  <link rel="stylesheet" href="./css/login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign in</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Sign Up</p>
    <form class="form1" action="<?php $_PHP_SELF ?>" method="post">
        <input type="text" name="firstname" placeholder="First-name">
        <input type="text" name="lastname" placeholder="Last-name"> 
        <input type="email" name="email" align="center" placeholder="Email-ID">
        <input type="password" name="password" align="center" placeholder="Password" maxlength="15" minlength="7">
        <input type="number" name="contact" align="center" placeholder="Contact No." maxlength="10" minlength="10"><br/>
        <input type="radio" name="gender" value="Male">Male</input>
        <input type="radio" name="gender" value="Female">Female</input><br/><br/>
        <?php
            if(isset($_POST['register'])){
                if( !isset($_POST['firstname']) || !isset($_POST['lastname']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['contact']) || !isset($_POST['gender']))
                    echo '<div class="notFilled"> Enter details. </div><br/><br/>'
                    . '<input type="submit" name="register" value="Register">';
                else{
                    try{
                        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql="insert into grace_user(email, password, contact, gender, firstname, lastname) values(?,?,?,?,?,?)";
                        $query=$dbhandler->prepare($sql);
                        $query->execute(array($_POST['email'], $_POST['password'], $_POST['contact'], $_POST['gender'], $_POST['firstname'], $_POST['lastname']));
                        $sql2="select id from grace_user order by id desc limit 1";
                        $query2=$dbhandler->query($sql2);
                        $id = $query2->fetch(PDO::FETCH_COLUMN);
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                    }
                    echo '<div class="successful"> Successfully Registered. </div>';
                    $_SESSION['user']=$id;
                }
            }
            else{
                echo '<input type="submit" name="register" value="Register">';
            }
        ?>
        <br/><br/><br/>
        <a class="submit" href="index.php"> Home </a>
    </div>
</body>

</html>

