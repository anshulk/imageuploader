<?php
  if(empty($_REQUEST['file']['name']))
        //header('Location:index.php');

         
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            $name     = $_FILES['file']['name'];
            $tmpName  = $_FILES['file']['tmp_name'];
            $error    = $_FILES['file']['error'];
            $size     = $_FILES['file']['size'];
            $ext      = strtolower(pathinfo($name, PATHINFO_EXTENSION));
           
                    //validate file extensions
            $valid =  true;
                    if ( !in_array($ext, array('jpg','jpeg','png','gif')) ) {
                        $valid = false;
                        $response = 'Invalid file extension.';
                    }
                    //validate file size
                    if ( $size/1024/1024 > 10 ) {
                        $valid = false;
                        $response = 'File size is exceeding maximum allowed size.';
                    }
                    //upload file
                    if ($valid) {
                        $targetPath =  dirname( __FILE__ ) . DIRECTORY_SEPARATOR. 'uploads' . DIRECTORY_SEPARATOR. $name;
                        move_uploaded_file($tmpName,$targetPath);
                        chmod("uploads/".$name, 0777);
                        $imagick = new \Imagick(realpath($targetPath));
                        $imagick->cropThumbnailImage(300,300);
                        if ($imagick->writeImage("thumbnails/".$name))
                        {
                            error_log("Image written", 0);        
                            chmod("thumbnails/".$name, 0777);
                        }
                        
                        header( 'Location: index.php' ) ;

                        exit;
                    }
        }
    
?>
