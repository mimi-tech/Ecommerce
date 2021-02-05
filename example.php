 <?php include 'includes/head.php';?>
     
     
   <input type="password" name="player_password" id="pass_log_id" />

<span toggle="#pass_log_id" class="fa fa-fw fa-eye field_icon toggle-password"></span>

     
      <?php include 'includes/footer.php';?>
      
   
  <script>
   
    $("body").on('click', '.toggle-passwords', function() {
  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $("#pass_log_id");
  if (input.attr("type") === "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }

});
      </script>
  
  
   