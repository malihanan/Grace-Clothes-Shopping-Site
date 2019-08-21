<div class="header">
    <h2>Grace</h2>
</div>

<div class="topnav">
    <a href="index.php">Home</a>
    <?php
        if(isset($_SESSION['user'])){
            echo '<a href="profile.php">Profile</a>'.
                    '<a href="cart.php">Cart</a>';
        }
        else{
            echo '<a href="login.php">Login</a>';
        }
    ?>
    <form action="search.php">
        <input type="text" name="search" placeholder="Search..">
        <button><img src="./images/search.png" height="30px"></button>
    </form>
</div>