<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>store</title>
<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link  href="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
      <script src="../bootstrap/js/bootstrap.min.js"></script>
    
       <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

  
  </head>
  <body>
  
                    <button style="text-decoration:none; color:blue;" data-toggle="modal" data-target="#checkoutModal">Update Profile</button>

  
        <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
                    </div>
                    <div class="modal-body">
                        <form action="tet.php" method="post" id="payment_form">
                           <span class="bg-danger" id="payment_errors"></span>
                            <div id="step1" style="display:block;">
                               
                                
                                 <div class="row">
                
                <div class="col-md-12 col-sm-12">
                    <div class="panel panel">
                        <div class="panel-heading">
                            PERSONAL INFORMATION
                        </div>
                       
                        <div class="panel-body">
                            <div class="row">
                               <div class="statusMsg"></div>
                                    <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>First Name</label>
                                            <input name="fName" class="form-control" value="<?php echo  $_SESSION["u_first"]; ?>" id="inputName" required >
                                            
                               </div>
                                   
                                  
                                   
                                    </div>
                                    
                                     <div class="col-sm-6 col-sm-6">
							  <div class="form-group">
                                            <label>Last Name</label>
                                            <input name="lName" class="form-control" value="<?php echo  $_SESSION["u_last"]; ?>" id="inputLame" required>
                                            
                               </div>
                                    </div>
                                    
                                </div>
                                
                                
                                 <div class="row">
                                <div class="col-sm-6 col-sm-6">
                                
							   <div class="form-group">
                                            <label>Mobile</label>
                                            <input name="phone" class="form-control" value="<?php echo  $_SESSION["u_phone"]; ?>" id="inputPhone" required>
                                            
                               </div>
                                     </div>
                                     
                                     <div class="col-sm-6 col-md-6">
							   <div class="form-group">
                                            <label>Email</label>
                                            <input name="email" type="email" class="form-control" value="<?php echo  $_SESSION["u_email"]; ?>" id="inputEmail"required>
                                         </div>
                               </div>
                                </div>
                                
                                 <div class="row">
                                <div class="col-sm-12">
                                
							   <div class="form-group">
                                            <label>Shipping Address</label>
                                   <textarea class="form-control" name="address" id="inputAddress"><?php echo  $_SESSION["u_address"];?></textarea>
                                            
                               </div>
                                     </div>
                                     
                                     
                                </div>
                                
                                 <div class="form-group"> 
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               
                <button type="submit" class="btn btn-primary submitBtn" onclick="submitContactForm()">Update</button>
                    </div>
                                
                        </div>  
                        </div>
                        </div>
                        </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
</div>

 
   
  <footer class="text-center" id="footer">&copy; 2019-2020 kmc technology  </footer>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
     
      
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script>
          
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
     
    var fname = $('#inputName').val();
    var lame = $('#inputLame').val();
    var phone = $('#inputPhone').val();
    var email = $('#inputEmail').val();
    var address = $('#inputAddress').val();
   
        $.ajax({
            
            url:'check.php',
           method: 'POST',
           data : {userLogin:1,userName:fname,userLame:lame,userPhone:phone,userEmail:email,userAddress:address},
            beforeSend: function () {
               $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'Yes'){
                     
                    
                     $('.statusMsg').html('<span style="color:green;">Your profile has been updated.</span>');
                }else{
                    $('.statusMsg').html('<span style="color:red;">Wrong email or password, please try again.</span>');
                }
                 
                
                 if(msg == 'empty'){
                   
                     
                    $('.statusMsg').html('<span style="color:red;">Please enter your first name </span>');
                }
                
                if(msg == 'complete'){
                     
                    $('.statusMsg').html('<span style="color:red;">your first name should be at least three characters.</span>');
                }
                
                if(msg == 'invalid'){
                     
                    $('.statusMsg').html('<span style="color:red;">Name must contain uppercase.</span>');
                }
                    
                    
                    
                    
                     if(msg == 'emptys'){
                    
                    $('.statusMsg').html('<span style="color:red;">Please enter your last name.</span>');
                }
                
                if(msg == 'completes'){
                     
                    $('.statusMsg').html('<span style="color:red;">your last name should be at least three characters.</span>');
                }
                
                if(msg == 'invalid'){
                     
                    $('.statusMsg').html('<span style="color:red;"> last Name must contain uppercase.</span>');
                }
                    
                    
               
                    
                    
                     if(msg == 'invalidEmail'){
                    
                    $('.statusMsg').html('<span style="color:red;">Invalid Email.</span>');
                }
                
                if(msg == 'doubleEmail'){
                     
                    $('.statusMsg').html('<span style="color:red;">Email already exist</span>');
                }
                
               
                    
                    
                    
                    
                  if(msg == 'phoneEmpty'){
                    
                    $('.statusMsg').html('<span style="color:red;">Please enter your phone number.</span>');
                }
                
                if(msg == 'phoneError'){
                     
                    $('.statusMsg').html('<span style="color:red;">your mobile number should be 11 digits</span>');
                }
                
                if(msg == 'invalidPhone'){
                     
                    $('.statusMsg').html('<span style="color:red;"> Mobile Number is invalid.</span>');
                }   
                    
                
                    
                     if(msg == 'addressError'){
                     
                    $('.statusMsg').html('<span style="color:red;"> Please enter your shipping address.</span>');
                }   
                
                if(msg == 'no'){
                     
                    $('.statusMsg').html('<span style="color:red;"> Please enter your shipping address.</span>');
                }   
                
                if(msg == 'danger'){
                     
                    $('.statusMsg').html('<span style="color:red;"> danger </span>');
                }   
                
                //$('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            },
             error : function(){alert("some went wrong");}
        });
    
        
}
               
      </script>
    
    </body>
</html>