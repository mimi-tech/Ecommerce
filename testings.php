
  <script>
 page();
          function page(){
              $.ajax({
                  url: "thankYou.php",
                  method: "POST",
                  data: {page:1},
                  success: function(data){
                      $("#pageno").html(data);
                  }
                   error : function(){alert("something went wrong");}
              })
          }
         $("body").delegate("#page","click",function(){
              var pn = $(this).attr("page");
               $.ajax({
                  url:"thankYou.php",
                  method: "POST",
                  data: {getProduct:1,setPage:1,pageNumber:pn},
                  success: function(data){
                      $("#get_Product").html(data);
                  }
              })
            
          })
        
</script> 
  