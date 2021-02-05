<?php
 include 'includes/init.php';
        
    if(isset($_GET['add'])){
        
$sdbpath = '';
        $serrors = array();
       // $required = array('title', 'brand', 'price', 'parent','child', 'sizes');
         $sallowed = array('png','jpg','jpeg','gif');
        
        $suploadPath = array();
        $stmpLoc = array();
        
        
        $sphotoCount = count($_FILES['files']['name']);
        if($sphotoCount > 0){ 
            for($i = 0;$i<$sphotoCount;$i++){ 
        
            $sname = $_FILES['files']['name'][$i];    
            $snameArray = explode('.',$sname);
            $sfileName = $snameArray[0];
            $sfileExt = $snameArray[1];
            $smime = explode('/',$_FILES['files']['type'][$i]);
            $smimeType = $smime[0];
            $smimeExt = $smime[1];
            $stmpLoc[] = $_FILES['files']['tmp_name'][$i];
            
            $sfileSize = $_FILES['files']['size'][$i];
           $suploadName = md5(microtime().$i).'.'.$sfileExt;
           
           //$uploadName = $name;
            $suploadPath[] = 'uploads/'.$suploadName;
                if($i != 0){
                    $sdbpath .= ',';
                }
                //$dbpath .= '/chilee/image/'.$uploadName;
            $sdbpath .= $suploadName;
            if($smimeType != 'image'){
                $serrors[] = 'The file must be an image';
            }
            if(!in_array($sfileExt, $sallowed)){
                $serrors[] = 'The photo extension must be a png,jpg,jpeg or gif';
            }
          if($sfileSize > 1000000){
              $serrors[] = 'The file size must be under 15mb';
          } 
            if($sfileExt != $smimeExt && ($smimeExt == 'jpeg' && $sfileExt != 'jpg')){
                $serrors[] = 'file extensions does not match the file';
           
        }
        }
        
                
        }
      
        if(!empty($serrors)){
        echo display_errors($serrors);
        }else{
            
            if($sphotoCount > 0){
                for($i = 0;$i<$sphotoCount;$i++){ 
          move_uploaded_file($stmpLoc[$i], $suploadPath[$i]);
               
                }
            }
             
           
            $insertsql = "INSERT INTO `chile`.`post_votes` ( `file_name`) VALUES ('$sdbpath')";
            
           
                $db->query($insertsql);
            header('Location: example.php');
        }
    }
    

echo $dbpath;
?>



<form action="example.php?<?php echo ((isset($_GET['edit']))?'edit='.$edit_id:'add=1'); ?>" method="post" enctype="multipart/form-data">
    Select Image Files to Upload:
    
    <input type="file" name="files[]" id="photo" class="form-control" multiple>
    <input type="submit" value="<?php echo ((isset($_GET['edit']))?'Edit':'Add'); ?> Product" class="btn btn-success" >
</form>