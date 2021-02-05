
  <footer class="text-center" id="footer">&copy; 2019-2020 kmc technology  </footer>
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      
      
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    
    
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
      
 
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
       
    
   <script>
       function updateSizes(){
         var sizeString = '';
           for(var i=1;i<=12;i++){
               if(jQuery('#size'+i).val() !=''){
                   sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
               }
           }
           
           jQuery('#sizes').val(sizeString);
       }
       
       function get_child_options(selected){
           if(typeof selected === 'undefined'){
               var selected ='';
           }
           var parentID = jQuery('#parent').val();
           jQuery.ajax({
              url : '/chilee/admin/includes/child_categories.php',
               type: 'POST',
               data: {parentID : parentID, selected: selected},
               success: function(data){
                   jQuery('#child').html(data);
               },
               error: function(){alert("Something went wrong with the child options")},
           });
       }
//jQuery('select[name="parent"]').change(get_child_options);



</script>
  
      
    </body>
</html>
   
      