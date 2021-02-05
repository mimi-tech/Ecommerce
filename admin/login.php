<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:index.php");  
 }  
 

if ( isset($_GET['success']) && $_GET['success'] == 297 )
{
     // treat the succes case ex:
     $errTyp = "success";   
     $errMSG = "You have been Logged out successfully"; 
}
?>

 
   
     
               
  


 
 
 
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>FOREVER ADMIN</title>
  
  
     
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body style="background:#0a221f;">
  
 <div class="container">


      <div id="login" >

        <form method="post">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user" style="color:#e17339"></span><input type="text"  name="email" value="email" onBlur="if(this.value == '') this.value = 'email'" onFocus="if(this.value == 'email') this.value = ''" required style="background:white; font-family: 'PlayfairDisplay-Regular';" autocomplete="OFF"></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock" style="color:#e17339"></span><input type="password" name="pass"  value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required style="background:white; font-family: 'PlayfairDisplay-Regular';" autocomplete="off"></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" name="sub"  value="Login" style="color: black;
    border: solid 2px white;
    font-family: 'Cinzel Decorative Black';
   
     background: #e17339; "></p>

          </fieldset>

        </form>
     </div>
       

      </div> <!-- end login -->

    <?php echo $errMSG; ?>
    <div class="bottom">  <h3><a style="font-family: 'PlayfairDisplay-Regular';">FOREVER HOMEPAGE</a></h3></div>
  
  
</body>
</html>

<?php
   include('db.php');
  
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $email = mysqli_real_escape_string($con,$_POST['email']);
      $mypassword = mysqli_real_escape_string($con,$_POST['pass']); 
      
      $sql = "SELECT id FROM user WHERE email = '$email' and password = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['user'] = $email;
         
         header("location: index.php?success=1");
      }else {
         echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
      }
   }
?>
