<?php session_start();
if(isset($_SESSION['usr_id']))
{
?>
<?php 
require_once("header.php");
require_once("connect.php");

 ?>
 
<style>.navigation_item{
		padding: 0px 5px;
		background: #fff;
		text-decoration: none;
		
		color: #e3e3e3 !important;
		font-size: 12px;
		border: 2px solid #e3e3e3;
		border-radius: 1px;
		-webkit-transition: all 0.2s linear;
		-moz-transition: all 0.2s linear;
		-ms-transition: all 0.2s linear;
		-o-transition: all 0.2s linear;
	}
	.navigation_item:hover,.selected_navigation_item{
		border: 2px solid #2A6496;
		border-radius: 2px;
		color: #2A6496 !important;
		background: #fff;
	}
	</style>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Photo Gallery</h1>
                </div>
                
               
            </div>
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                         Photo Gallery Control panel
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive table-bordered">
                           <?php
    
    if (isset($_GET["page"])) { 
        $page = $_GET["page"]; 
    } 
    else { 
        $page=1; 
    };
    $start_from = ($page-1) * 10;
    $query = "SELECT * FROM gallery ORDER BY ID ASC LIMIT $start_from, 10";
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("connection error");
    $result = mysqli_query($dbc,$query);
    ?>
    <table class="table">
            <thead>
                <tr>
                <th>ID</th>
                 <th>Image Name</th>
                <th>Image</th>
				<th colspan=2>Action (Delete)</th>
				</tr>
            </thead>

<?php
while ($row = mysqli_fetch_assoc($result)) {
?>

<tbody>
    <tr>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['pic_name']; ?></td>
    <td><a href='#'><img src="images/<?php echo $row['pic_name']; ?>"  width="100px"/></a></td>
    <td><a href='delete.php?key1=<?php echo $row['ID']; ?>'>Delete</a> 
										   
    </tr>
										
	</tbody>

<?php
};
?>
</table>
<b> Pages </b>

<?php
    $query = "SELECT COUNT(pic_name) FROM gallery";
    $rs_result = mysqli_query($dbc,$query);
    $row = mysqli_fetch_row($rs_result);
    $total_records = $row[0];
    $total_pages = ceil($total_records / 10);
    for ($i=1; $i<=$total_pages; $i++) {
    echo "<a href='view.php?page=".$i."' class='navigation_item selected_navigation_item'>".$i."</a> ";
};
?>


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

    
    <script src="js/bootstrap.min.js"></script>

    
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

    
    <script src="js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap.js"></script>

    
    <script src="js/sb-admin-2.js"></script>

    
    <script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
    </script>
<?php
}
else
{
header("location:login.php");
}
?>
</body>

</html>
