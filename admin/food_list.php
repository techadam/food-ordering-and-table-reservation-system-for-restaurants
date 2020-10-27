<?php 
	
	session_start();
	require "includes/functions.php";
	require "includes/db.php";
    if(!isset($_SESSION['user'])) {
        header("location: logout.php");
    }
	
	$result = "";
	$pagenum = "";
	$per_page = 20;
		
		$count = $db->query("SELECT * FROM food");
		
		$pages = ceil((mysqli_num_rows($count)) / $per_page);
		
		if(isset($_GET['page'])) {
			
			$page = $_GET['page'];
			
		}else{
			
			$page = 1;
			
		}
						
		$start = ($page - 1) * $per_page;
		
		$cat = $db->query("SELECT * FROM food LIMIT $start, $per_page");
		
		if($cat->num_rows) {
			
			$result = "<table class='table table-hover table-striped'>
						<thead>
							<th>S/N</th>
							<th>name</th>
							<th>price</th>
							<th>Category</th>
							<th>Action</th>
						</thead>
						<tbody>";
			
			$x = 1;
			
			while($row = $cat->fetch_assoc()) {
				
				$id = $row['id'];
				$foodName = $row['food_name'];
				$foodCat = $row['food_category'];
				$foodPrice = $row['food_price'];
				$foodDesc = $row['food_description'];
				
				
				$result .=  "<tr>
								<td>$x</td>
								<td>$foodName</td>
								<td>$foodPrice</td>
								<td>$foodCat</td>
								<td><a href='food_list.php?delete=".$id."' onclick='return check();'><i class='pe-7s-close-circle'></i></a></td>
							</tr>";
																
									
				$x++;
			}
			
			$result .= "</tbody>
						</table>";
			
		}else{
			
			$result = "<p style='color:red; padding: 10px; background: #ffeeee;'>No records available in the database yet</p>";
			
		}
						
						
		
	
	if(isset($_GET['delete'])) {
		
		$delete = preg_replace("#[^0-9]#", "", $_GET['delete']);
		
		if($delete != "") {
			
			$sql = $db->query("DELETE FROM food WHERE id='".$delete."'");
		
			if($sql) {
				
				echo "<script>alert('Successfully deleted')</script>";
				
			}else{
				
				echo "<script>alert('Operation Unsuccessful. Please try again')</script>";
				
			}
			
		}
		
		
	}
	
	
	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="icon" type="image/png" href="assets/img/favicon.ico">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Unique Restaurant</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Light Bootstrap Table core CSS    -->
    <link href="assets/css/light-bootstrap-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="assets/css/demo.css" rel="stylesheet" />


    <!--     Fonts and icons     -->
    <link href="assets/css/pe-icon-7-stroke.css" rel="stylesheet" />
	
	
    <link href="assets/css/style.css" rel="stylesheet" />
	
	<script>
	
		function check() {
			
			return confirm("Are you sure you want to delete this record");
			
		}
	
	</script>
	
</head>
<body>

<div class="wrapper">
    <div class="sidebar" data-color="#000" data-image="assets/img/sidebar-5.jpg">

    <!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


    	<?php require "includes/side_wrapper.php"; ?>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-fixed" style="background: #FF5722;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                        <span class="icon-bar" style="background: #fff;"></span>
                    </button>
                    <a class="navbar-brand" href="#" style="color: #fff;">FOOD COLLECTION</a>
                </div>
                <div class="collapse navbar-collapse">

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="logout.php" style="color: #fff;">
                                Log out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Food List</h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                                
								<?php echo $result; ?>
								
								<p style="padding: 0px 20px;"><?php if($pages >= 1 && $page <= $pages) {
									for($i = 1; $i <= $pages; $i++) {
										echo ($i == $page) ? "<a href='food_list.php?page=".$i."' style='margin-left:5px; font-weight: bold; text-decoration: none; color: #FF5722;' >$i</a>  "  : " <a href='food_list.php?page=".$i."' class='btn'>$i</a> ";
									}
								} ?></p>

                            </div>
                        </div>
                    </div>                    

                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                
                <p class="copyright pull-right">
                    &copy; 2016 <a href="index.php" style="color: #FF5722;">Unique Restaurant</a>
                </p>
            </div>
        </footer>

    </div>
</div>


</body>

    <!--   Core JS Files   -->
    <script src="assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Checkbox, Radio & Switch Plugins -->
	<script src="assets/js/bootstrap-checkbox-radio-switch.js"></script>

	<!--  Charts Plugin -->
	<script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    
    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
	<script src="assets/js/light-bootstrap-dashboard.js"></script>

	<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
	<script src="assets/js/demo.js"></script>
	
	<script type="text/javascript">
    	$(document).ready(function(){
			
			/*notice = $("#notify").val();
			
			//alert(notice);
			
        	demo.initChartist();

        	$.notify({
            	icon: 'pe-7s-gift',
            	message: notice

            },{
                type: 'danger',
                timer: 7000
            });

    	});*/
	</script>

</html>
