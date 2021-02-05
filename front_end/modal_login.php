
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
     <link rel="stylesheet" href="bootstrap/css/jquery.wm-zoom-1.0.min.css">
      
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
      <link href = "bootstrap/css/jquery-ui.css" rel = "stylesheet">
    
       <!-- Bootstrap -->
   <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="bootstrap/css/styles.css">
   
<link rel="stylesheet" href="../star-rating/style.css">
<link rel="stylesheet" href="/chilee/sass/styles.css">
 
   
  </head>
  <body>
  
  
  <a data-toggle="modal" data-target="#modalLoginForm" style="color:black;font-family: 'Cinzel Decorative Black'; font-size:15px;" class="nav-modal"><span class="glyphicon glyphicon-log-in" style="color:#e17339; cursor:pointer;"></span>  Login </a>
 
      
  
    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center" >
                <h4 class="modal-title w-100 font-weight-bold">Sign in</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
               <p class="statusMsg"></p>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="on" id="myForm">

                
                <div class="md-form mb-5">
                   
            <div class="form-group">    
             <input type="email"id="inputEmail" name="email" class="form-control" placeholder="Enter Your email address"   style="height:50px;"  value="<?php echo $email; ?>" required/>
                </div> 
         
           
        <br>
             
                         </div>

              
            <div class="form-group">    
             <input type="password"id="inputName" name="password" class="form-control" placeholder="Enter Your password"  style="height:50px;"  value="<?php echo $password ?>" required/>
                </div> 
        
         
        <br><br>
              <div class="form-group"> 
              <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <button type="button" class="btn btn-primary submitBtn" onclick="submitContactForm()">SUBMIT</button>
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
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="../bootstrap/js/jquery-ui.js">
       </script>
            
     <script>
function submitContactForm(){
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
     var email = $('#inputEmail').val();
    var name = $('#inputName').val();
   
        $.ajax({
            
            url:'modal_submit.php',
           method: 'POST',
           data : {userLogin:1,userEmail:email,userPassword:name},
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(msg){
                if(msg == 'Yes'){
                     $('#inputEmail').val('');
                    $('#inputName').val('');
                   
                    window.location.href = "home_page2.php";
                          
                   
                }else{
                    $('.statusMsg').html('<span style="color:red;">Wrong email or password, please try again.</span>');
                }
                if(msg == 'Invalid'){
                     $('#inputEmail').val('');
                    $('#inputName').val('');
                    $('.statusMsg').html('<span style="color:red;">No such user in our database, please try again.</span>');
                }
                
                if(msg == 'Empty'){
                     $('#inputEmail').val('');
                    $('#inputName').val('');
                    $('.statusMsg').html('<span style="color:red;">Please enter your email and password.</span>');
                }
                
                if(msg == 'Wrong'){
                     $('#inputEmail').val('');
                    $('#inputName').val('');
                    $('.statusMsg').html('<span style="color:red;">Please enter a valid email.</span>');
                }
                
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
         

</script>
   
    </body>
</html> 
           
        