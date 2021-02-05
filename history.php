<!DOCTYPE>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>store</title>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <script src="bootstrap/js/bootstrap.min.js"></script>
    
       <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="bootstrap/css/main.css">
<link rel="stylesheet" href="../star-rating/style.css">
  
   
  </head>
  <body>
    <div id="wrapper">
        
        <!-- /. NAV SIDE  -->
            
            
        <div id="page-wrapper" >
            <div id="page-inner">
			 <div class="row">
                    <div class="col-md-12">
                        <h1 class="page-header">
                           Payment Details<small> </small>
                        </h1>
                    </div>
                </div> 
                 <!-- /. ROW  -->
				 
				 
            <div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                          
                                           <th>S/N</th>
                                           
											<th>Items</th>
											<th>quantity</th>
											<th>size</th>
											
											<th>Sub_price</th>
											
											
											<th>Date & Time</th>
											
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
									<?php
                                        session_start();
                                        $user_id = $_SESSION["uid"];
										include ('db.php');
										$sql="SELECT * FROM semi_posts WHERE user_id = '$user_id' ";
										$re = mysqli_query($conn,$sql);
										while($row = mysqli_fetch_array($re))
										{
										
											$no = $no + 1;
                                             $qty = $row["quantity"];
                                             $pro_price = $row["sub_prices"];   
											 $price_array = array($pro_price);
                                            $total_sum = array_sum($price_array);
                                            $total_amt = $total_amt + $total_sum;     
                                                 
                                            $It_array = array($qty);
                                            $It_total = array_sum($It_array);
                                            $item_count = $item_count + $It_total;     
											
												echo"<tr>
                                                <td>$no</td>
													
													<td>".$row['items']."</td>
													<td>".$row['quantity']."</td>
													<td>".$row['sizes']."</td>
													
													<td>".$row['sub_prices']."</td>
													
                                                    <td>".$row['date_added']."</td>
													
													
													</tr>";
											
										}
										
									?>
                                    
           
                                    </tbody>
                                </table>
                             <div class="col-sm-6"></div>
                             <div class="col-sm-6">
                             <table class="table table-bordered table-condensed text-right">
            <legend>Total</legend>
            <thead class="totals-table-header">
                <th>Total items</th>
                
                <th>Grand Total</th>

            </thead>

            <tbody>
                <tr>
                    <td>
                        <?php echo $item_count; ?>
                    </td>
                    
                    <td class="bg-success">
                        <?php echo $total_amt; ?>
                    </td>
                </tr>
            </tbody>
        </table>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <!--End Advanced Tables -->
                </div>
            </div>
                <!-- /. ROW  -->
            
                </div>
               
            </div>
        
               
    </div>
             <!-- /. PAGE INNER  -->
            
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
      
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
     
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
         <!-- Custom Js -->
    <script src="assets/js/custom-scripts.js"></script>
    
   
</body>
</html>
