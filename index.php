<?php 

//index.php

include('database_connection.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> something </title>      
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
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="products.css">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <header>
        <div class = "hero">        
            <nav>
                <a href="'#"><img src="photo.png" class = "logo"></a>
                <ul>
                    <li><a href="'#">HOME</a></li>
                    <li><a href="products.php">PRODUCTS</a></li>
                    <li><a href="'#">TIERS</a></li>
                    <li><a href="'#">CART</a></li>
                </ul>
                <a href="'#"><button type="button">Log Out</button></a>
            </nav>
        </div>
    </header>

    <main>        
        <div class="container">
            <div class="row">
        	    <br />
        	    <h2 align="center">Our Products</h2>
        	    <br />
                <div class="custom">
                    <div class="col-md-3" style="background-color: rgba(62, 181, 153, 0.3);border-radius:25px;">
				        <div class="list-group">
                            <h2 align="center" style="color: black;"> Filter <h2>
                            <div>
                            <hr class="h">
                            </div>
                            <br />
                            <h3 align="center" style="color: black;">Price</h3>
					        <input type="hidden" id="hidden_minimum_price" value="0" />
                            <input type="hidden" id="hidden_maximum_price" value="250000" />
                            <p id="price_show">0 - 250000</p>
                            <div id="price_range"></div>
                        </div>				
                        <div class="list-group">
                            <h3 align="center" style="color: black;">Brand</h3>
                            <div style="height: auto; overflow-y: auto; overflow-x: hidden; color:black;">
					        <?php

                            $query = "SELECT DISTINCT(brand) FROM product WHERE stat = '1' ORDER BY Id DESC";
                            $statement = $connect->prepare($query);
                            $statement->execute();
                            $result = $statement->fetchAll();
                            foreach($result as $row)
                            {
                            ?>
                            <div class="list-group-item checkbox" style="background-color: rgba(62, 181, 153, 0.3);">
                                <label><input type="checkbox" class="common_selector brand" value="<?php echo $row['brand']; ?>"  > <?php echo $row['brand']; ?></label>
                            </div>
                            <?php
                            }

                            ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-9">
            	    <br />
                    <div class="row filter_data">

                    </div>
                </div>
            </div>

        </div>

    </main>
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>
<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:0,
        max:250000,
        values:[0, 250000],
        step:200,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});
</script>
    <footer>
        
    </footer>

</body>
</html>