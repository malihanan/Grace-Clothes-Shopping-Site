<?php
if(!isset($_SESSION))
    session_start();
if(isset($_SESSION['user']))
    header('Location: index.php');
?>

<html>
<head>
  <link rel="stylesheet" href="./css/login.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign in</title>
</head>

<body>
  <div class="main">
    <p class="sign" align="center">Login</p>
    <form class="form1" action="<?php $_PHP_SELF ?>" method="post">
      <input name="email" type="text" align="center" placeholder="Email-ID">
      <input name="password" type="password" align="center" placeholder="Password"><br/><br/>
      <div class="captcha"><img src="captchafont.php"></div>
      <input type="text" name="vercode1" placeholder="Enter Code"/>
      
        <?php
            if(isset($_POST['login'])){
                if( empty($_POST['email']) || empty($_POST['password']))
                    echo '<div class="notFilled"> Enter details. </div>';
                else if ($_POST['vercode1'] != $_SESSION['vercode'] OR $_SESSION['vercode']=='')
                    echo '<div class="notFilled"> Incorrect verification code.</div>';
                else{
                    try{
                        $dbhandler = new PDO('mysql:host=localhost:3307;dbname=test','','');
                        $dbhandler->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                        $sql="select id from grace_user where email=? and password=?";
                        $query=$dbhandler->prepare($sql);
                        $query->execute(array($_POST['email'], $_POST['password']));
                        $id = $query->fetch(PDO::FETCH_COLUMN);
                        if(!$id)
                            echo '<div class="notFilled"> Incorrect credentials. </div><br/><br/>';
                        else{
                            if($id == 1)
                                header('Location: adminIndex.php');
                            else
                                header('Location: '.$_SESSION['currentpage']);
                            $_SESSION['user']=$id;
                        }
                    }
                    catch(PDOException $e){
                        echo $e->getMessage();
                        die();
                    }
                }
            }
            echo '<input type="submit" name="login" value="Login"/><br/><br/><br/>';
        ?>
        <a class="submit" href="index.php">Home</a><br/><br/><br/>
        <p class="create" align="center"><a href="signup.php">Create Account</p>
    </div>
</body>

</html>