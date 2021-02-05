
 <?php
require_once '../core/init.php';
require_once '../core/confi.php';

session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOREVER HOTEL</title>
	<!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- Morris Chart Styles-->
   
        <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
     <!-- Google Fonts-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
     <!-- TABLE STYLES-->
    <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" />
     <link rel="stylesheet" href="admincss.css" />
</head>
<body>

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
     
           <?php
            require_once 'includes/init.php';       
       
                       
                    
            require 'PHPMailerAutoload.php';
 require 'credential.php';
$mail = new PHPMailer;

$mail->SMTPDebug = 6;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = EMAIL;                 // SMTP username
$mail->Password = PASS;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom(EMAIL, 'Chilee project');
$mail->addAddress('miriamnigeria44@gmail.com', 'testing');     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
$mail->addReplyTo(EMAIL);
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Finished Products';

 $iQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
        $lowItems = array();
                while($product = mysqli_fetch_assoc($iQuery)){
                    $no = $no + 1;
                    $item = array();
                    $sizes = sizesToArray($product['sizes']);
                    foreach($sizes as $size){
                      if($size['quantity'] <= 2){      
                    $cat = get_category($product['categories']);
                        $item = array(
                        'title' => $product['title'],
                         'price' => $product['price'],    
                        'size' => $size['size'],
                        'quantity' => $size['quantity'],
                        'category' =>  $cat['parent'] . '~' .$cat['child']    
                        );
                        $lowItems[] = $item;
                        }
}
                    
                }
   
     
$mail->Body    .= ' <table class="table table-striped table-bordered table-hover" id="dataTables-example">';
$mail->Body    .= ' <thead>'; 
$mail->Body    .=  '<tr>';
$mail->Body    .=  '<th><b>S/N</b></th>';    
$mail->Body    .=  '<th><b>product</b></th>';
$mail->Body    .=  '<th><b>Price</b></th>';
$mail->Body    .=  '<th><b>size</b></th>';
$mail->Body    .=  '<th><b>quantity</b></th>';
$mail->Body    .=  '<th><b>category</b></th>';
                          
$mail->Body    .=  '</tr>';
$mail->Body    .=  '</thead>';                           
                          
$mail->Body    .=  '<tbody>'; 
foreach($lowItems as $item){ 
 $mail->Body    .=  '<tr style="color:blue;">';
    
$mail->Body    .= '<td >'.$item['title'].'</td>';
$mail->Body    .= '<td>'.$item['price'].'</td>'; 
$mail->Body    .= '<td>'.$item['size'].'</td>'; 
$mail->Body    .= '<td>'.$item['quantity'].'</td>';
$mail->Body    .= '<td>'.$item['category'].'</td>';     
 $mail->Body    .=  '</tr>';
$mail->Body    .=  '</tbody>'; 
    $mail->Body    .=  '</table>';
}
$mail->AltBody ='please suplie immediately';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
                      
                       
                  
    
    

    ?>
    
   <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
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