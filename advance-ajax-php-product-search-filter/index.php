<?php 

//index.php

include('../db.php');

?>

 <?php
                
                function sizesToArray($string){
    $sizesArray = explode(',',$string);
    $returnArray = array();
    foreach($sizesArray as $size){
        $s = explode(':',$size);
        $returnArray[] = array('size' => $s[0], 'quantity' => $s[1]);
        
    }
    return $returnArray;
}

function sizesToString($sizes){
   $sizeString = '';
    foreach($sizes as $size){
        $sizeString .= $size['size'].':'.$size['quantity'].',';
    }
    $trimmed = rtrim($sizeString, ',');
    return $trimmed;
    
}
        
        ?>
           
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Product filter in php</title>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Advance Ajax Product Filters in PHP</h2>
        	<br />
            <div class="col-md-2">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="500" />
                    <p id="price_show">700 - 65000</p>
                    <div id="price_range"></div>
                </div>				
                <div class="list-group">
					<h3>Brand</h3>
                    <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
					<?php

                   $sql = "SELECT DISTINCT(brand_name) FROM products  WHERE featured = '1' AND deleted = 0 ORDER BY id DESC ";
$lowItems = array();
     
$query = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($query)){
    $item = array();
    $item = array(
                        'id' => $row['id'],
                         
                        'brand' => $row['brand_name']
                         
                        );
                        $lowItems[] = $item;
    
    
}
                    ?>
                    <?php foreach($lowItems as $item):?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector brand" value="<?php echo $item['brand']; ?>"  > <?php echo $item['brand']; ?></label>
                    </div>
                   <?php endforeach; ?>
                    </div>
                </div>

				<div class="list-group">
					<h3>RAM</h3>
                    <?php

                    $queryc = "
                    SELECT DISTINCT(color) FROM products WHERE featured = '1' AND deleted = '0' ORDER BY color DESC
                    ";
                    $colorItems = array();
     
$queryc = mysqli_query($conn, $queryc);
while($row = mysqli_fetch_array($queryc)){
    $colors = array();
    $colors = array(
                        'id' => $row['id'],
                         
                        'color' => $row['color']
                         
                        );
                        $colorItems[] = $colors;
    
    
}
                    ?>
                    <?php foreach($colorItems as $colors):?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $colors['color']; ?>" > <?php echo $colors['color']; ?> GB</label>
                    </div>
                     <?php endforeach; ?>
                </div>
				
				<div class="list-group">
					<h3>Internal Storage</h3>
					 <?php
                   
        $iQuery = "SELECT DISTINCT(sizes)FROM products WHERE deleted = 0 AND featured = 1 ORDER BY sizes DESC";
                    $result = mysqli_query($conn, $iQuery);
        $sizeItems = array();
                while($product = mysqli_fetch_assoc($result)){
                    $items = array();
                    $sizes = sizesToArray($product['sizes']);
                    foreach($sizes as $size){
                     
                        $items = array(
                          
                        'size' => $size['size'],
                        
                        );
                        $sizeItems[] = $items;
                    }
                       
               
                }
            ?>
                   <?php foreach($sizeItems as $items):?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector storage" value="<?php echo $items['size']; ?>"  > <?php echo $items['size']; ?> GB</label>
                    </div>
                     <?php endforeach; ?>
                </div>
            </div>
<div class="example">
    <p> jnckjckdjhdjmknh</p>
</div>
            <div class="col-md-9">
            	<br />
                <div class="row filter_data">

                </div>
            </div>
        </div>

    </div>
    
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>


    filter_data();

    function filter_data()
    {
        jQuery('.example').css("display","block"); 
        $('.filter_data').html('<div id="loading" style="" ></div>');
         
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
       
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                //$('.filter_data').html(data);
                
                $('.filter_data').fadeOut('slow',function(){
                    
						$('.filter_data').html(data).fadeIn('fast');
                    
                    
                })
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
            jQuery('.example').css("display","none");
        });
        return filter;
        
    }

    $('.common_selector').click(function(){
        filter_data();
        jQuery('.example').css("display","none");
    });

    $('#price_range').slider({
        range:true,
        min:1000,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
            jQuery('.example').css("display","none");
        }
    });


</script>

</body>

</html>
