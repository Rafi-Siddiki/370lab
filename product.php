<?php
    // index.php

    include('database_connection.php');

    $id = "";
    if(isset($_GET["id"]))
    {
        $id = $_GET["id"];
    }
    $sql_query = "SELECT * FROM product WHERE Id=:id";
    $statement = $connect->prepare($sql_query);
    $statement->bindParam(':id', $id);
    $statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Product</title>      
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="product.css">
</head>
<body>
    <header>
        <div class="hero">        
            <nav>
                <a href="#"><img src="photo.png" class="logo"></a>
                <ul>
                    <li><a href="#">HOME</a></li>
                    <li><a href="products.php">PRODUCTS</a></li>
                    <li><a href="#">TIERS</a></li>
                    <li><a href="#">CART</a></li>
                </ul>
                <a href="#"><button type="button">Log Out</button></a>
            </nav>
        </div>
    </header>
    <main>
        <?php
            if ($statement->rowCount() > 0)
            {
                while($row = $statement->fetch(PDO::FETCH_ASSOC))
                {
        ?>
                    <div id="wrapper-div">
                        <div id="main-div" class ="clearfix">
                            <div id="image-box">
                                <img src="image/<?php echo $row['image']; ?>" style="width: 400px; height:400px"/>
                            </div>                                                  
                            <div id="name-box">
                                <p><?php echo $row['name']; ?></p>
                                <br />
                                <p>৳<?php echo $row['price']; ?></p>
                                <br />
                                <a href="'#"><button class = "button-cart">Add To Cart</button></a>
                            </div>
                        </div>
                    </div>
                    <div>
                    <div id="editline">
                        <hr class="line-product">
                    <div>
                    <div id="wrapper-div2">
                        <div id="main-div2" class ="clearfix2">
                            <div id="info-box">
                                <p align="center" style="font-size: 35px; padding-top:2%;"> Description <p>
                                <p style="font-size: 20px;"><?php echo $row['info']; ?></p>
                            </div>                                                  
                            <div id="rev-box">
                                <p align="center" style="font-size: 35px; padding-top:2%;"> Reviews <p>
                                <a href="'#"><button class = "button-review">Add Your Review</button></a>
                            </div>
                        </div>
                    </div>


        <?php
                }
            }
        ?>
    </main>
    <footer>
        
    </footer>
</body>
</html>