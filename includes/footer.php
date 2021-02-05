
  <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
      <script src="../bootstrap/js/jquery-ui.js"></script>
      
   <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
      <script src="bootstrap/js/jquery.wm-zoom-1.0.min.js"></script>
    <script src="bootstrap/js/jqzoom.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
     
     <script src="bootstrap/bootbox.min.js"></script>
    <script>
function detailsmodal(id){
var data = {"id" : id};
jQuery.ajax({
    url : <?php echo BASEURL;?>+'includes/detailsmodal.php',
    method : "post",
    data : data,
    success : function(data){
    jQuery('body').append(data);
    jQuery('#details-modal').modal('toggle');    
    },
    error : function(){
        alert("wrong");
    }
});    
 
}
        
        function update_cart(mode,edit_id,edit_size){
            var data = {"mode" : mode, "edit_id" : edit_id, "edit_size" : edit_size};
             var success = '';
            jQuery.ajax({
               url : '/chilee/admin/parsers/update_cart.php',
                method : "post",
                data : data,
                success : function(){
                   window.setTimeout(function(){window.location.reload()},3000)
                    success += '<p class="text-success text-center">Product updated successfully</p>';
                    jQuery('#remove_success').html(success);
                },
                error : function(){alert("something is wrong");},
            });
        }
        
        /*
        $('#counter').click(function() {
    $('.count').html(function(i, val) { return val*1+1 });
    Materialize.toast('You have clicked me!', 2000)
});
*/
        
        
        function add_to_cart(){
        jQuery('#modal_errors').html("");
         
        var size = jQuery('#size').val();
        var quantity = jQuery('#quantity').val(); 
        var avaliable = jQuery('#avaliable').val();
        var error = '';
        var success = '';    
        var data = jQuery('#add_product_form').serialize();
        if(size == '' || quantity == '' || quantity == 0){
            error += '<p class="text-danger text-center">You must choose a size and quantity</p>';
            jQuery('#modal_errors').html(error);
            return;
            
        } else if(quantity > avaliable){
            error += '<p class="text-danger text-center">There are only '+avaliable+' avaliable</p>';
            jQuery('#modal_errors').html(error);
            return;
        }else{
            jQuery.ajax({
                url : '/chilee/admin/parsers/add_cart.php',
                method : 'post',
                data : data,
                success : function(){
                  
                    // window.setTimeout(function()1000)
                    success += '<p class="text-success text-center">Product updated successfully</p>';
                     jQuery('#modal_success').html(success);
                   //$('#myModal2  ').modal('show');
            return;
                    
                    //location.reload();
                },
                error : function(){alert("something went wrong");}
            });
          
            
        }
       
        }
        
        
        
        
        $("body").delegate(".update","click",function(event){
            event.preventDefault();
            var pid = $(this).attr("update_id");
            var qty = $("#qty-"+pid).val();
            var price = $("#price-"+pid).val();
            var total = $("#total-"+pid).val();
             var success = '';
            $.ajax({
                url: "/chilee/cart.php",
                method:  "POST",
                data : {updateProduct:1,updateId:pid,qty:qty,price:price,total:total},
                success: function(){
                     window.setTimeout(function(){window.location.reload()},3000)
                    success += '<p class="text-success text-center">Product updated successfully</p>';
            jQuery('#remove_success').html(success);
                }
            })
        })
        
         $("body").delegate(".remove","click",function(event){
            event.preventDefault();
            var pid = $(this).attr("remove_id");
             var success = '';
            $.ajax({
                url:  "cart.php",
                method: "POST",
                data:  {removeFromCart:1,removeId:pid},
                success: function(){
                     window.setTimeout(function(){window.location.reload()},3000)
                    success += '<p class="text-danger text-center">Product deleted successfully</p>';
            jQuery('#remove_success').html(success);
          
                    
                }
            })
        })
       
        
        
        
        
function submitContactForm(){
    jQuery('#update_errors').html("");
    var number = /^\d{11}$/;
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var fname = $('#inputName').val();
    var lame = $('#inputLame').val();
    var phone = $('#inputPhone').val();
    var email = $('#inputEmail').val();
    var address = $('#inputAddress').val();
    var success = '';
    var error = '';
   if(fname.trim() == '' ){
         error += '<p class="text-danger text-center">Please enter Your First Name Correctly</p>';
            jQuery('#update_errors').html(error);
          
        return ;
       
   }else if(lame.trim() == '' ){
       error += '<p class="text-danger text-center">Please enter Your Last Name Correctly</p>';
            jQuery('#update_errors').html(error);
          
        return ;
    }else if(email.trim() == '' ){
        error += '<p class="text-danger text-center">Please enter Your Email Address Correctly</p>';
            jQuery('#update_errors').html(error);
          
        return ;
    }else if(email.trim() != '' && !reg.test(email)){
       error += '<p class="text-danger text-center">Please enter a valid Email Address </p>';
            jQuery('#update_errors').html(error);
          return ;
        
        
    }else if(phone.trim() == '' ){
        error += '<p class="text-danger text-center">Please enter Your Mobile Number </p>';
            jQuery('#update_errors').html(error);
          return ;
    }else if(phone.trim() != '' && !number.test(phone)){
        error += '<p class="text-danger text-center">Please enter correct Mobile Number </p>';
            jQuery('#update_errors').html(error);
          return ;
    }else{
    $.ajax({
            type:'POST',
            url:'/chilee/submit_form.php',
           data : {userLogin:1,userName:fname,userLame:lame,userPhone:phone,userEmail:email,userAddress:address},
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(){
                 success += '<p class="text-success text-center">Profile Updated successfully</p>';
            jQuery('.statusMsg').html(success);
                
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
           
        
        
              
function submitUpdateForm(){
    jQuery('#update_error').html("");
    var number = /^\d{11}$/;
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var fname = $('#inputNames').val();
    var lame = $('#inputLames').val();
    var phone = $('#inputPhones').val();
    var email = $('#inputEmails').val();
    var address = $('#inputAddresss').val();
    var success = '';
    var error = '';
   if(fname.trim() == '' ){
         error += '<p class="text-danger text-center">Please enter Your First Name Correctly</p>';
            jQuery('#update_error').html(error);
          
        return ;
       
   }else if(lame.trim() == '' ){
       error += '<p class="text-danger text-center">Please enter Your Last Name Correctly</p>';
            jQuery('#update_error').html(error);
          
        return ;
    }else if(email.trim() == '' ){
        error += '<p class="text-danger text-center">Please enter Your Email Address Correctly</p>';
            jQuery('#update_error').html(error);
          
        return ;
    }else if(email.trim() != '' && !reg.test(email)){
       error += '<p class="text-danger text-center">Please enter a valid Email Address </p>';
            jQuery('#update_error').html(error);
          return ;
        
        
    }else if(phone.trim() == '' ){
        error += '<p class="text-danger text-center">Please enter Your Mobile Number </p>';
            jQuery('#update_error').html(error);
          return ;
    }else if(phone.trim() != '' && !number.test(phone)){
        error += '<p class="text-danger text-center">Please enter correct Mobile Number </p>';
            jQuery('#update_error').html(error);
          return ;
    }else{
    $.ajax({
            type:'POST',
            url:'/chilee/update_form.php',
           data : {userLogin:1,userName:fname,userLame:lame,userPhone:phone,userEmail:email,userAddress:address},
            beforeSend: function () {
                $('.submitBtn').attr("disabled","disabled");
                $('.modal-body').css('opacity', '.5');
            },
            success:function(){
                 success += '<p class="text-success text-center">Profile Updated successfully</p>';
            jQuery('.statusMsg').html(success);
                
                $('.submitBtn').removeAttr("disabled");
                $('.modal-body').css('opacity', '');
            }
        });
    }
}
        
        
        
        
      function check_address(){
         jQuery('#step').css("display","none");
         jQuery('#step_2').css("display","block");
         jQuery('#next_button').css("display","none"); 
         jQuery('#update_button').css("display","none"); 
         jQuery('#bak_button').css("display","inline-block"); 
         jQuery('#checkout_button').css("display","inline-block");
         jQuery('#updateModalLabel').html("Enter Your Card Details");  
      }
        
      function bak_button(){
         jQuery('#step').css("display","block");
         jQuery('#step_2').css("display","none");
         jQuery('#next_button').css("display","inline-block"); 
         jQuery('#update_button').css("display","inline-block"); 
         jQuery('#bak_button').css("display","none"); 
         jQuery('#checkout_button').css("display","none");
         jQuery('#updateModalLabel').html("Shipping Address");  
      }  
        
      $("#search-group").hide();
    
         $(".open_search").click(function(){
  $("#search-group").slideToggle(500);
  $(".open_search").hide();
       return false;
         });
        
        
       $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
}); 
        
    </script>
    
    
   
     
     
     
  <script>
  $( function() {
  	
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 700, 20000 ],
      slide: function( event, ui ) {
        $( "#amount" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount" ).val(  + $( "#slider-range" ).slider( "values", 0 ) +
      " - " + $( "#slider-range" ).slider( "values", 1 ) );
  
    var loader="<img src='/chilee/images/loading.gif' />";
   
  $('.ui-slider-handle').on('click',function(){
	  $('.content').html(loader);
   jQuery('.test').css("display","none");
  	  var min_price=$( "#slider-range" ).slider( "values", 0 );
	  var max_price=$( "#slider-range" ).slider( "values", 1 );
	  
	
	
	var qs="min_price="+min_price+"&max_price="+max_price;
		//alert(ctr_id);
		
		$.ajax({
			url:'fetch_data.php',
			type:'GET',
			data:qs,
			success:function(output){
					$('.content').fadeOut('slow',function(){
						$('.content').html(output).fadeIn('fast');
					
					});
					
				
					}
		
		});
	
	 
  
  });
  
  
  
  
  } );
  </script>
     
     
     
      
  <script>
  $( function() {
  	
    $( "#price-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 700, 20000 ],
      slide: function( event, ui ) {
        $( "#amount_category" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount_category" ).val(  + $( "#price-range" ).slider( "values", 0 ) +
      " - " + $( "#price-range" ).slider( "values", 1 ) );
  
    var loader="<img src='/chilee/images/loading.gif' />";
   
  $('.ui-slider-handle').on('click',function(){
	  $('.content_category').html(loader);
   jQuery('.test').css("display","none");
  	  var min_price=$( "#price-range" ).slider( "values", 0 );
	  var max_price=$( "#price-range" ).slider( "values", 1 );
	  
	
	
	var qs="min_price="+min_price+"&max_price="+max_price;
		//alert(ctr_id);
		
		$.ajax({
			url:'fetch_category.php',
			type:'GET',
			data:qs,
			success:function(output){
					$('.content_category').fadeOut('slow',function(){
						$('.content_category').html(output).fadeIn('fast');
					
					});
					
				
					}
		
		});
	
	 
  
  });
  
  
  
  
  } );
  </script>
    
    
        
  <script>
  $( function() {
  	
    $( "#search-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 700, 20000 ],
      slide: function( event, ui ) {
        $( "#amount_search" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount_search" ).val(  + $( "#search-range" ).slider( "values", 0 ) +
      " - " + $( "#search-range" ).slider( "values", 1 ) );
  
    var loader="<img src='/chilee/images/loading.gif' />";
   
  $('.ui-slider-handle').on('click',function(){
	  $('.content_search').html(loader);
   jQuery('.test').css("display","none");
  	  var min_price=$( "#search-range" ).slider( "values", 0 );
	  var max_price=$( "#search-range" ).slider( "values", 1 );
	  
	
	
	var qs="min_price="+min_price+"&max_price="+max_price;
		//alert(ctr_id);
		
		$.ajax({
			url:'fetch_search.php',
			type:'GET',
			data:qs,
			success:function(output){
					$('.content_search').fadeOut('slow',function(){
						$('.content_search').html(output).fadeIn('fast');
					
					});
				
					}
		
		});
	
  });
 
  } );
      
  
  </script>
    
      
      
  <script>
  $( function() {
  	
    $( "#recent-range" ).slider({
      range: true,
      min: 0,
      max: 100000,
      values: [ 700, 20000 ],
      slide: function( event, ui ) {
        $( "#amount_recent" ).val( ui.values[ 0 ] + " - " + ui.values[ 1 ] );
      }
    });
    $( "#amount_recent" ).val(  + $( "#recent-range" ).slider( "values", 0 ) +
      " - " + $( "#recent-range" ).slider( "values", 1 ) );
  
    var loader="<img src='/chilee/images/loading.gif' />";
   
  $('.ui-slider-handle').on('click',function(){
	  $('.front_content').html(loader);
   jQuery('.test').css("display","none");
  	  var min_price=$( "#recent-range" ).slider( "values", 0 );
	  var max_price=$( "#recent-range" ).slider( "values", 1 );
	  
	
	
	var qs="min_price="+min_price+"&max_price="+max_price;
		//alert(ctr_id);
		
		$.ajax({
			url:'recent_products.php',
			type:'GET',
			data:qs,
			success:function(output){
					$('.front_content').fadeOut('slow',function(){
						$('.front_content').html(output).fadeIn('fast');
					
					});
					
				
					}
		
		});
	
  });
  
  
  } );
  </script>
     
     
<script>
    
$(document).ready(function(){

    front_content();

    function front_content()
    {
        $('.front_content').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"recent_products.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                //$('.filter_data').html(data);
                $('.front_content').fadeOut('slow',function(){
                    
						$('.front_content').html(data).fadeIn('fast');
                })
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
            jQuery('.test').css("display","none");
        });
        return filter;
        
    }

    $('.common_selector').click(function(){
        front_content();
        jQuery('.test').css("display","block");
    });

    

});
    
   
</script>

    
  
    <script>
    
$(document).ready(function(){

    content_category();

    function content_category()
    {
        $('.content_category').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_category.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                //$('.filter_data').html(data);
                $('.content_category').fadeOut('slow',function(){
                    
						$('.content_category').html(data).fadeIn('fast');
                })
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
            jQuery('.test').css("display","none");
        });
        return filter;
        
    }

    $('.common_selector').click(function(){
        content_category();
        jQuery('.test').css("display","block");
    });

   

});
    
   
</script>
    
    
    <script>
    
$(document).ready(function(){

    content_search();

    function content_search()
    {
        $('.content_search').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_search.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
            success:function(data){
                //$('.filter_data').html(data);
                $('.content_search').fadeOut('slow',function(){
                    
						$('.content_search').html(data).fadeIn('fast');
                })
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
            jQuery('.test').css("display","none");
        });
        return filter;
        
    }

    $('.common_selector').click(function(){
        content_search();
        jQuery('.test').css("display","block");
    });

    

});
    
   
</script>

    
    
     <script>
         
function closeModal(){
 //jQuery('#details-modal').modal('hide');  
//setTimeout(function(){
    //jQuery('#details-modal').remove();
    //jQuery('.modal-backdrop').remove();
//},500); 
     //location.reload();
    
    
    
}
    </script>
    
    <script> 
        //$(window).load(function(){        
   //$('#myModal2  ').modal('show');
    //}); </script>

      
      <script>
    function save(){
        $('#save_feedback').html('Product deleted successfully');
        $('#save_feedback').fadeIn(3000);
        $('#save_feedback').delay(50000);
         $('#save_feedback').fadeOut(2000);
    }
    </script>
      
      
      
      
      
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
        var ram = get_filter('ram');
        var storage = get_filter('storage');
        $.ajax({
            url:"fetch_index.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, brand:brand, ram:ram, storage:storage},
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
            jQuery('.test').css("display","none");
        });
        return filter;
    }

    $('.common_selector').click(function(){
        jQuery('.test').css("display","block");
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:700,
        max:65000,
        values:[1000, 65000],
        step:500,
        stop:function(event, ui)
        {
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
             jQuery('.test').css("display","none");
            filter_data();
        }
    });
    
   
});
</script>
     
    



<script>
$(document).ready(function(){
$('.delete_employee').click(function(e){
e.preventDefault();
var empid = $(this).attr('data-emp-id');
var parent = $(this).parent("td").parent("tr");
bootbox.dialog({
message: "Are you sure you want to Delete ?",
title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
buttons: {
success: {
label: "No",
className: "btn-success",
callback: function() {
$('.bootbox').modal('hide');
}
},
danger: {
label: "Delete!",
className: "btn-danger",
callback: function() {
$.ajax({
type: 'POST',
url: 'deleted.php',
data: 'empid='+empid
})
.done(function(response){
bootbox.alert(response);
parent.fadeOut('slow');
})
.fail(function(){
bootbox.alert('Error....');
})
}
}
}
});
});
});
</script>
     
     
<script>
$(document).ready(function(){
$('.delete_all').click(function(e){
e.preventDefault();

bootbox.dialog({
message: "Are you sure you want to Delete ?",
title: "<i class='glyphicon glyphicon-trash'></i> Delete !",
buttons: {
success: {
label: "No",
className: "btn-success",
callback: function() {
$('.bootbox').modal('hide');
}
},
danger: {
label: "Delete!",
className: "btn-danger",
callback: function() {
$.ajax({
type: 'POST',
url: 'delete_all.php',

})
.done(function(response){
//bootbox.alert(response);

     $('#test').fadeOut('slow');
     jQuery('#remove_success').html('<p class="text-success text-center">Product deleted successfully</p>');            
     window.setTimeout(function(){window.location.reload()},1000)
                   
       
    
})
.fail(function(){
bootbox.alert('Error....');
})
}
}
}
});
});
});
</script>
     
     
    <script>
    
        function add_to_cart_product(){
        jQuery('#modal_errors').html("");
         
        var size = jQuery('#size').val();
        var quantity = jQuery('#quantity').val(); 
        var avaliable = jQuery('#avaliable').val();
        var error = '';
        var success = '';    
        var data = jQuery('#add_product_form').serialize();
        if(size == '' || quantity == '' || quantity == 0){
            error += '<p class="text-danger text-center">You must choose a size and quantity</p>';
            jQuery('#modal_errors').html(error);
            return;
            
        } else if(quantity > avaliable){
            error += '<p class="text-danger text-center">There are only '+avaliable+' avaliable</p>';
            jQuery('#modal_errors').html(error);
            return;
        }else{
            jQuery.ajax({
                url : '/chilee/admin/parsers/add_cart.php',
                method : 'post',
                data : data,
                success : function(){
                 
                    success += '<p class="text-success text-center">Product added successfully</p>';
                     jQuery('#modal_success').html(success);
                   
            return;
                    
                    
                },
                error : function(){alert("something went wrong");}
            });
          
            
        }
       
        }
        
    </script> 
     
     
<script>
      jQuery('#size').change(function(){
          var avaliable = jQuery('#size option:selected').data("avaliable");
          jQuery('#avaliable').val(avaliable);   
      });
      
      $(function () {
  $('.fotorama').fotorama({'loop':true,'autoplay':true});
});
      
 
</script>
     
    <script>
    $(function() {
	// rating form hide/show
 	$( "#rateProduct" ).click(function() {
		$("#ratingDetails").hide();
		$("#ratingSection").show();
	});	
	$( "#cancelReview" ).click(function() {
		$("#ratingSection").hide();
		$("#ratingDetails").show();		
	});	
	// implement start rating select/deselect
	$( ".rateButton" ).click(function() {
		if($(this).hasClass('btn-grey')) {			
			$(this).removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).prevAll('.rateButton').removeClass('btn-grey btn-default').addClass('btn-warning star-selected');
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');			
		} else {						
			$(this).nextAll('.rateButton').removeClass('btn-warning star-selected').addClass('btn-grey btn-default');
		}
		$("#rating").val($('.star-selected').length);		
	});
	// save review using Ajax
	$('#ratingForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			type : 'POST',
			url : 'saveRating.php',
			data : formData,
			success:function(response){
				 $("#ratingForm")[0].reset();
				 window.setTimeout(function(){window.location.reload()},3000)
			}
		});		
	});
});
        
        
  $(".rating-stars").hide();
  $("#show-rating").click(function(){
  $(".rating-stars").fadeIn(500);
	  $(".out-of").fadeIn(500);
   $("#show-all-rating").fadeIn(500);
      $("#show-rating").hide(); 
        });
        
        $("#show-all-rating").click(function(){
          $(".rating-stars").hide(); 
			$(".out-of").hide();
			$("#show-rating").fadeIn(500);
			$("#show-all-rating").hide();
        });
    </script> 
     
     
     <script>
    $(document).ready(function(){ 
	showComments();
	$('#commentForm').on('submit', function(event){
		event.preventDefault();
		var formData = $(this).serialize();
		$.ajax({
			url: "comments.php",
			method: "POST",
			data: formData,
			dataType: "JSON",
			success:function(response) {
				if(!response.error) {
					$('#commentForm')[0].reset();
					$('#commentId').val('0');
               
					$('#message').html(response.message);
					showComments();
				} else if(response.error){
					$('#message').html(response.message);
				}
			}
		})
	});	
	$(document).on('click', '.reply', function(){
		var commentId = $(this).attr("id");
        
		$('#commentId').val(commentId);
       
		$('.name').focus();
	});
});
// function to show comments
function showComments()	{
	$.ajax({
		url:"show_comments.php",
		method:"POST",
		success:function(response) {
			$('#showComments').html(response);
		}
	})
}

    </script>
     
      <script>
     $("#showComments").hide();
  $(".show-all-questions").click(function(){
  $("#showComments").fadeIn(500);
	   $(".close-questions").fadeIn(500);
  
$(".show-all-questions").hide();
      
        })
        
       
          
          $(".close-questions").click(function(){
             $("#showComments").hide(); 
             $(".show-all-questions").fadeIn(500);
               $(".close-questions").hide();
          })
    </script>
      
      
      <script>
     $('.tile')
    // tile mouse actions
    .on('mouseover', function(){
      $(this).children('.photo').css({'transform': 'scale('+ $(this).attr('data-scale') +')'});
    })
    .on('mouseout', function(){
      $(this).children('.photo').css({'transform': 'scale(1)'});
    })
    .on('mousemove', function(e){
      $(this).children('.photo').css({'transform-origin': ((e.pageX - $(this).offset().left) / $(this).width()) * 100 + '% ' + ((e.pageY - $(this).offset().top) / $(this).height()) * 100 +'%'});
    })
    // tiles set up
    .each(function(){
      $(this)
        // add a photo container
        .append('<div class="photo"></div>')
        // some text just to show zoom level on current item in this example
        //.append('<div class="txt"><div class="x">'+ $(this).attr('data-scale') +'x</div></div>')
        // set up a background image for each tile based on data-image attribute
        .children('.photo').css({'background-image': 'url('+ $(this).attr('data-image') +')'});
    })

    </script>
      
     <script>
        $(document).ready(function(){
         
       $('.my-zoom-1').WMZoom();    
        
      

  config : {

    inner : true

  }


        });

       </script>
      
      
      
       <script>
        $(document).ready(function(){
         
       $('.my-zoom-2').WMZoom();    
    
  config : {

    inner : true

  }
        });

       </script>
      
      
      <script>
     $(".sample-image-zero").click(function(){
        
     location.reload();
          $(".sample-image-three").css("border","solid 2px white"); 
        });      
          
    $(".sample-image-one").click(function(){
         $(".sample-image-two").css("border","solid 2px white");
         $(".sample-image-one").css("border","solid 2px red");
  $(".hide-image").hide();
        $(".show-sample-image-zero").hide();
        $(".show-sample-image-two").hide();
        $(".show-sample-image-three").hide();
   $(".show-sample-image-one").fadeIn(500);

        });
          
           $(".sample-image-two").click(function(){
  $(".sample-image-one").css("border","solid 2px white");
  $(".sample-image-two").css("border","solid 2px red");
  $(".hide-image").hide();
  $(".show-sample-image-zero").hide();
                $(".show-sample-image-one").hide();
        //$(".show-sample-image-two").hide();
        $(".show-sample-image-three").hide();              
  $(".show-sample-image-two").fadeIn(500);

        });
          
          
           $(".sample-image-three").click(function(){
        $(".sample-image-two").css("border","solid 2px white");
         $(".sample-image-three").css("border","solid 2px red");       
  $(".hide-image").hide();
$(".show-sample-image-zero").hide();
               $(".show-sample-image-one").hide();
        $(".show-sample-image-two").hide();
        //$(".show-sample-image-three").hide();
   $(".show-sample-image-three").fadeIn(500);

        });
    </script>
      
      <script type="text/javascript">
$(document).ready(function(){
    $(".addtowishlist").on('click', function(evt) {
       var link_data = $(this).data('data');
       $.ajax({
          type: "POST",
          url: 'addtoWishlist.php',
          data: ({product_id: link_data}),
          success: function(data) {
               if(data == '1')
               {
                  $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"red"})
               }
               else{
                   $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"black"})
               }
          }   
           
       });   
    }); 
});
</script>
    
    
    
    
    <script>
    const LiquidButton = class LiquidButton {
  constructor(svg) {
    const options = svg.dataset;
    this.id = this.constructor.id || (this.constructor.id = 1);
    this.constructor.id++;
    this.xmlns = 'http://www.w3.org/2000/svg';
    this.tension = options.tension * 1 || 0.4;
    this.width   = options.width   * 1 || 200;
    this.height  = options.height  * 1 ||  50;
    this.margin  = options.margin  ||  40;
    this.hoverFactor = options.hoverFactor || -0.1;
    this.gap     = options.gap     ||   5;
    this.debug   = options.debug   || false;
    this.forceFactor = options.forceFactor || 0.2;
    this.color1 = options.color1 || '#36DFE7';
    this.color2 = options.color2 || '#8F17E1';
    this.color3 = options.color3 || '#BF09E6';
    this.textColor = options.textColor || '#FFFFFF';
    this.text = options.text    || 'Button';
    this.svg = svg;
    this.layers = [{
      points: [],
      viscosity: 0.5,
      mouseForce: 100,
      forceLimit: 2,
    },{
      points: [],
      viscosity: 0.8,
      mouseForce: 150,
      forceLimit: 3,
    }];
    for (let layerIndex = 0; layerIndex < this.layers.length; layerIndex++) {
      const layer = this.layers[layerIndex];
      layer.viscosity = options['layer-' + (layerIndex + 1) + 'Viscosity'] * 1 || layer.viscosity;
      layer.mouseForce = options['layer-' + (layerIndex + 1) + 'MouseForce'] * 1 || layer.mouseForce;
      layer.forceLimit = options['layer-' + (layerIndex + 1) + 'ForceLimit'] * 1 || layer.forceLimit;
      layer.path = document.createElementNS(this.xmlns, 'path');
      this.svg.appendChild(layer.path);
    }
    this.wrapperElement = options.wrapperElement || document.body;
    if (!this.svg.parentElement) {
      this.wrapperElement.append(this.svg);
    }

    this.svgText = document.createElementNS(this.xmlns, 'text');
    this.svgText.setAttribute('x', '50%');
    this.svgText.setAttribute('y', '50%');
    this.svgText.setAttribute('dy', ~~(this.height / 8) + 'px');
    this.svgText.setAttribute('font-size', ~~(this.height / 3));
    this.svgText.style.fontFamily = 'sans-serif';
    this.svgText.setAttribute('text-anchor', 'middle');
    this.svgText.setAttribute('pointer-events', 'none');
    this.svg.appendChild(this.svgText);

    this.svgDefs = document.createElementNS(this.xmlns, 'defs')
    this.svg.appendChild(this.svgDefs);

    this.touches = [];
    this.noise = options.noise || 0;
    document.body.addEventListener('touchstart', this.touchHandler);
    document.body.addEventListener('touchmove', this.touchHandler);
    document.body.addEventListener('touchend', this.clearHandler);
    document.body.addEventListener('touchcancel', this.clearHandler);
    this.svg.addEventListener('mousemove', this.mouseHandler);
    this.svg.addEventListener('mouseout', this.clearHandler);
    this.initOrigins();
    this.animate();
  }

  get mouseHandler() {
    return (e) => {
      this.touches = [{
        x: e.offsetX,
        y: e.offsetY,
        force: 1,
      }];
    };
  }

  get touchHandler() {
    return (e) => {
      this.touches = [];
      const rect = this.svg.getBoundingClientRect();
      for (let touchIndex = 0; touchIndex < e.changedTouches.length; touchIndex++) {
        const touch = e.changedTouches[touchIndex];
        const x = touch.pageX - rect.left;
        const y = touch.pageY - rect.top;
        if (x > 0 && y > 0 && x < this.svgWidth && y < this.svgHeight) {
          this.touches.push({x, y, force: touch.force || 1});
        }
      }
      e.preventDefault();
    };
  }

  get clearHandler() {
    return (e) => {
      this.touches = [];
    };
  }

  get raf() {
    return this.__raf || (this.__raf = (
      window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      function(callback){ setTimeout(callback, 10)}
    ).bind(window));
  }

  distance(p1, p2) {
    return Math.sqrt(Math.pow(p1.x - p2.x, 2) + Math.pow(p1.y - p2.y, 2));
  }

  update() {
    for (let layerIndex = 0; layerIndex < this.layers.length; layerIndex++) {
      const layer = this.layers[layerIndex];
      const points = layer.points;
      for (let pointIndex = 0; pointIndex < points.length; pointIndex++) {
        const point = points[pointIndex];
        const dx = point.ox - point.x + (Math.random() - 0.5) * this.noise;
        const dy = point.oy - point.y + (Math.random() - 0.5) * this.noise;
        const d = Math.sqrt(dx * dx + dy * dy);
        const f = d * this.forceFactor;
        point.vx += f * ((dx / d) || 0);
        point.vy += f * ((dy / d) || 0);
        for (let touchIndex = 0; touchIndex < this.touches.length; touchIndex++) {
          const touch = this.touches[touchIndex];
          let mouseForce = layer.mouseForce;
          if (
            touch.x > this.margin &&
            touch.x < this.margin + this.width &&
            touch.y > this.margin &&
            touch.y < this.margin + this.height
          ) {
            mouseForce *= -this.hoverFactor;
          }
          const mx = point.x - touch.x;
          const my = point.y - touch.y;
          const md = Math.sqrt(mx * mx + my * my);
          const mf = Math.max(-layer.forceLimit, Math.min(layer.forceLimit, (mouseForce * touch.force) / md));
          point.vx += mf * ((mx / md) || 0);
          point.vy += mf * ((my / md) || 0);
        }
        point.vx *= layer.viscosity;
        point.vy *= layer.viscosity;
        point.x += point.vx;
        point.y += point.vy;
      }
      for (let pointIndex = 0; pointIndex < points.length; pointIndex++) {
        const prev = points[(pointIndex + points.length - 1) % points.length]; 
        const point = points[pointIndex];
        const next = points[(pointIndex + points.length + 1) % points.length];
        const dPrev = this.distance(point, prev);
        const dNext = this.distance(point, next);

        const line = {
          x: next.x - prev.x,
          y: next.y - prev.y,
        };
        const dLine = Math.sqrt(line.x * line.x + line.y * line.y);

        point.cPrev = {
          x: point.x - (line.x / dLine) * dPrev * this.tension,
          y: point.y - (line.y / dLine) * dPrev * this.tension,
        };
        point.cNext = {
          x: point.x + (line.x / dLine) * dNext * this.tension,
          y: point.y + (line.y / dLine) * dNext * this.tension,
        };
      }
    }
  }

  animate() {
    this.raf(() => {
      this.update();
      this.draw();
      this.animate();
    });
  }

  get svgWidth() {
    return this.width + this.margin * 2;
  }

  get svgHeight() {
    return this.height + this.margin * 2;
  }

  draw() {
    for (let layerIndex = 0; layerIndex < this.layers.length; layerIndex++) {
      const layer = this.layers[layerIndex];
      if (layerIndex === 1) {
        if (this.touches.length > 0) {
          while (this.svgDefs.firstChild) {
            this.svgDefs.removeChild(this.svgDefs.firstChild);
          }
          for (let touchIndex = 0; touchIndex < this.touches.length; touchIndex++) {
            const touch = this.touches[touchIndex];
            const gradient = document.createElementNS(this.xmlns, 'radialGradient');
            gradient.id = 'liquid-gradient-' + this.id + '-' + touchIndex;
            const start = document.createElementNS(this.xmlns, 'stop');
            start.setAttribute('stop-color', this.color3);
            start.setAttribute('offset', '0%');
            const stop = document.createElementNS(this.xmlns, 'stop');
            stop.setAttribute('stop-color', this.color2);
            stop.setAttribute('offset', '100%');
            gradient.appendChild(start);
            gradient.appendChild(stop);
            this.svgDefs.appendChild(gradient);
            gradient.setAttribute('cx', touch.x / this.svgWidth);
            gradient.setAttribute('cy', touch.y / this.svgHeight);
            gradient.setAttribute('r', touch.force);
            layer.path.style.fill = 'url(#' + gradient.id + ')';
          }
        } else {
          layer.path.style.fill = this.color2;
        }
      } else {
        layer.path.style.fill = this.color1;
      }
      const points = layer.points;
      const commands = [];
      commands.push('M', points[0].x, points[0].y);
      for (let pointIndex = 1; pointIndex < points.length; pointIndex += 1) {
        commands.push('C',
          points[(pointIndex + 0) % points.length].cNext.x,
          points[(pointIndex + 0) % points.length].cNext.y,
          points[(pointIndex + 1) % points.length].cPrev.x,
          points[(pointIndex + 1) % points.length].cPrev.y,
          points[(pointIndex + 1) % points.length].x,
          points[(pointIndex + 1) % points.length].y
        );
      }
      commands.push('Z');
      layer.path.setAttribute('d', commands.join(' '));
    }
    this.svgText.textContent = this.text;
    this.svgText.style.fill = this.textColor;
  }

  createPoint(x, y) {
    return {
      x: x,
      y: y,
      ox: x,
      oy: y,
      vx: 0,
      vy: 0,
    };
  }

  initOrigins() {
    this.svg.setAttribute('width', this.svgWidth);
    this.svg.setAttribute('height', this.svgHeight);
    for (let layerIndex = 0; layerIndex < this.layers.length; layerIndex++) {
      const layer = this.layers[layerIndex];
      const points = [];
      for (let x = ~~(this.height / 2); x < this.width - ~~(this.height / 2); x += this.gap) {
        points.push(this.createPoint(
          x + this.margin,
          this.margin
        ));
      }
      for (let alpha = ~~(this.height * 1.25); alpha >= 0; alpha -= this.gap) {
        const angle = (Math.PI / ~~(this.height * 1.25)) * alpha;
        points.push(this.createPoint(
          Math.sin(angle) * this.height / 2 + this.margin + this.width - this.height / 2,
          Math.cos(angle) * this.height / 2 + this.margin + this.height / 2
        ));
      }
      for (let x = this.width - ~~(this.height / 2) - 1; x >= ~~(this.height / 2); x -= this.gap) {
        points.push(this.createPoint(
          x + this.margin,
          this.margin + this.height
        ));
      }
      for (let alpha = 0; alpha <= ~~(this.height * 1.25); alpha += this.gap) {
        const angle = (Math.PI / ~~(this.height * 1.25)) * alpha;
        points.push(this.createPoint(
          (this.height - Math.sin(angle) * this.height / 2) + this.margin - this.height / 2,
          Math.cos(angle) * this.height / 2 + this.margin + this.height / 2
        ));
      }
      layer.points = points;
    }
  }
}


const redraw = () => {
  button.initOrigins();
};

const buttons = document.getElementsByClassName('liquid-button');
for (let buttonIndex = 0; buttonIndex < buttons.length; buttonIndex++) {
  const button = buttons[buttonIndex];
  button.liquidButton = new LiquidButton(button);
}
</script>
   
    
<script type="text/javascript">
  $(document).ready(function() {


      $('#submit').click(function(e){
        e.preventDefault();


        var name = $("#name").val();
         var amt = $("#amt").val();

        $.ajax({
            type: "POST",
            url: "/chilee/coupon.php",
            dataType: "json",
            data: {name:name, amt:amt},
            success : function(data){
                if (data.code == "200"){
                   $(".display-success").html("<p>"+data.msg+"</p>");
                    $(".display-success").css("display","inline-block");
					$(".code-success").css("display","inline-block");
                } else {
                    $(".display-error").html("<ul>"+data.msg+"</ul>");
                    $(".display-error").css("display","block");
                }
            }
        });


      });
  });
</script>
  
  
  
<script type="text/javascript">
  $(document).ready(function() {


      $('#submits').click(function(e){
        e.preventDefault();


       
        var email = $("#subemail").val();
        

        $.ajax({
            type: "POST",
            url: "/chilee/subscribe.php",
            dataType: "json",
            data: {email:email},
            success : function(data){
                if (data.code == "200"){
                    $(".success-email").html("<p>"+data.msg+"</p>");
                    $(".success-email").css("display","block");
                } else {
                    $(".display-errors").html("<p>"+data.msg+"</p>");
                    $(".display-errors").css("display","block");
                }
            }
        });


      });
  });
</script>
    
     
  <script>
 
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
	  
	   
      </script>
      
      
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
    </body>
</html>
   
      