<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Image uploader | Gallery</title>
 
    <!-- Bootstrap core CSS -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="bootstrap/js/jquery.scrollupformenu.js"></script>
        <script>
		  $(function() {			
              $('#jquery-script-menu').scrollUpMenu({'transitionTime':50});
		  });
	   </script>
  </head>
 
  <body>
 
    <!-- Static navbar -->
    <div class="navbar-inverse navbar-static-top" id="top">
      <div class="container" style="padding-top:0px;margin-top:0px;">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"><h3>Manage your Gallery</h3></a>
        </div>
      </div>
    </div>
 
 
    <div class="container">
               <div class="row-md-7">
                <?php
                    //scan "uploads" folder and display them accordingly
                $folder = "uploads";
                $results = scandir('uploads');
                foreach ($results as $result) {
                if ($result === '.' or $result === '..') continue;
            
                    if (is_file($folder . '/' . $result)) {
                    echo '
                    <div class="col-md-3">
                        <div class="thumbnail">
                            <img src="'.$folder . '/' . $result.'" alt="..." >
                            <p id="buttons" ><a href="delete.php?name='.$result.'" class="btn btn-danger btn-xs" role="button">Delete</a>    <a href="share.php?name='.$result.'" class="btn btn-primary btn-xs" role="button">Share</a></p>
                                <div class="caption">
                            </div>
                        </div>
                    </div>';
                }
            }
           ?>
        </div>
            <div class="col-md-3">
               <form class="well" action="upload.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="file">Select a file to upload</label>
                    <input type="file" name="file" multiple>
                    <p class="help-block">Only jpg,jpeg,png and gif file with maximum size of 1 MB is allowed.</p>
                    <input type="submit" class="btn btn-sm btn-primary" value="Upload">
                   </div>
                </form>
            </div>
          </div>
    <script>
            $(function() {     
            $('#top').scrollUpMenu({
                waitTime: 50,
                transitionTime: 200,
                menuCss: { 'position': 'fixed', 'top': '-2'}
            });
            });

</script>
    <!-- /container -->
  </body>
</html>