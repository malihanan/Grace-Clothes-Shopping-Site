<!DOCTYPE html>
<html>
    <head>
        <title>Grace</title>
        <link rel="stylesheet" href="./css/main.css">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        
        <?php include './header.php';
        $string=strtolower($_GET['search']);
        $type='all';
        $category='all';
        
        if(strpos($string, 'male') !== false)
                $category='male';
        if(strpos($string, 'female') !== false)
                $category='female';
        if(strpos($string, 'kid') !== false)
                $category='kids';
        if(strpos($string, 'shirt') !== false)
                $type='shirt';
        if(strpos($string, 'tshirt') !== false)
                $type='tshirt';
        if(strpos($string, 'bottom') !== false || strpos($string, 'pant') !== false)
                $type='bottoms';
        if(strpos($string, 'traditional') !== false || strpos($string, 'kurt') !== false)
                $type='traditional';
        if(strpos($string, 'top') !== false)
                $type='tops';
        if(strpos($string, 'set') !== false)
                $type='sets';
        
        header('Location: type.php?category='.$category.'&type='.$type);
        include './footer.php';?>
        
    </body>
</html>