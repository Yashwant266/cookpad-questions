<?php session_start();
if(isset($_SESSION['usr_id']))
{
?>
<?php 
require_once("header.php");
require_once("connect.php");
 ?>


<div id="page-wrapper">
            <div class="row">

                <div class="col-lg-12">
                    <h1 class="page-header">Add Images</h1>
                </div>
                   
            </div>
            
<script type="application/javascript">
    function img_up(){
    var fup = document.getElementById('upload');
    var fileName = fup.value;
    var ext = fileName.substring(fileName.lastIndexOf('.') + 1);
    if(ext == "JPEG" || ext == "jpeg" || ext == "jpg" || ext == "JPG" || ext== "PNG" ||  ext=="png"){
        return true;
    }
    else{
        alert("Image format not supported!");
        fup.focus();
        return false;
    }
}
</script>
<?php


if(isset($_FILES['pics'])){
    
	
		$file_name = $_FILES['pics']['name'];
		$file_size =$_FILES['pics']['size'];
		$file_tmp =$_FILES['pics']['tmp_name'];
		$file_type=$_FILES['pics']['type'];
        $file_path = GW_UPLOADPATH .$file_name;	
     
        if ((($file_type == 'image/gif') || ($file_type == 'image/jpeg') || ($file_type == 'image/pjpeg') || ($file_type == 'image/png'))
        && ($file_size  > 0) && ($file_size  <= GW_MAXFILESIZE)){    

        move_uploaded_file($file_tmp, $file_path);
           
        $query="INSERT INTO gallery (pic_name,pic_type,pic_size) VALUES('$file_name','$file_type','$file_size'); ";
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection error");
		mysqli_query($dbc,$query);
        echo " <div class='alert alert-success'>Your Photos Is Successfully Uploded. <a href='view.php'>View Photos</a></div>";	
        }		
        
        else {
      echo '<p class="error">The screen shot must be a GIF, JPEG, or PNG image file no greater than ' . (GW_MAXFILESIZE / 1024) . ' KB in size.</p>';
      }
    }
	else {
      echo '<p class="error">Please Upload the picture.</p>';
    }

?>
 
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Fill This Form To Add Photos
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="#" method="post" enctype="multipart/form-data" name="upload">
                                       
                                        
                                        <div class="form-group">
                                            <label>Gallery Photos</label>
                                            <input type="file" name="pics" multiple  id="upload" />
                
                                            <p class="help-block">Example "Recomended Image Size in pixel 400 X 300"</p>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary" name="submit">Submit Button</button>
                                        
                                    </form>
                                </div>
                                
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
           
        </div>

    </div>
   

    
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
<?php
}
else
{
header("location:login.php");
}
?>
</body>

</html>
