
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="bootstrap/bootbox.min.js"></script>


<table class="table table-striped table-bordered " id="test">
<thead>
<tr>
<th>Employee Name</th>
<th>Actions</th>
</tr>
</thead>
<tbody>

<?php
    
$server = "localhost";
$username = "root";
$password = "root";
$db       = "project";

//create a connection
$conn = mysqli_connect ( $server, $username, $password, $db );

    //check connection
    
    if(!$conn ){
        die( "connection failed: " . mysqli_connect_error() );
    }else{
      //echo "Connected successfully";
    }

$sql = "SELECT * FROM subscribe";
$resultset = mysqli_query($conn, $sql); 
while( $rows = mysqli_fetch_assoc($resultset) ) {
?>

<tr>
<td><?php echo $rows["email"]; ?></td>

    </tr>
<?php
}
?>

      
</tbody>
</table>

<button class="btn btn-danger delete_all">Cancel</button>

<?php include 'includes/footer.php';?>

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
bootbox.alert(response);

     $('#test').fadeOut('slow');
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