
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
 
 <!-- Page Content -->
    <div class="container">
        <div class="row">
        	<br />
        	<h2 align="center">Advance Ajax Product Filters in PHP</h2>
        	<br />
            <div class="col-md-3">                				
				<div class="list-group">
					<h3>Price</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="65000" />
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


