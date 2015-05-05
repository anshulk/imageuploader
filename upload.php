<?php  

function resizeImage($imagePath, $width, $height) {
    $filterType = 1;
    $blur = 0;
    $bestFit = 0;
    $cropZoom = 0;
    
    $imagick = new \Imagick(realpath($imagePath));
    $width = empty($width) ? $imagick->getImageWidth() : $width;
    $height = empty($height) ? $imagick->getImageHeight() : $height;

    $imagick->resizeImage($width, $height, $filterType, $blur, $bestFit);

    $cropWidth = $imagick->getImageWidth();
    $cropHeight = $imagick->getImageHeight();

    if ($cropZoom) {
        $newWidth = $cropWidth / 2;
        $newHeight = $cropHeight / 2;

        $imagick->cropimage(
            $newWidth,
            $newHeight,
            ($cropWidth - $newWidth) / 2,
            ($cropHeight - $newHeight) / 2
        );

        $imagick->scaleimage(
            $imagick->getImageWidth() * 4,
            $imagick->getImageHeight() * 4
        );
    }

    header("Content-Type: image/jpg");
    echo $imagick->getImageBlob();
}



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
                        
//                        echo resizeTmage($targetPath, 500, 500);
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