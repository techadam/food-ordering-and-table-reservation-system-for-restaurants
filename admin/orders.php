<?php 
	
	session_start();
	require "includes/functions.php";
	require "includes/db.php";
	
	if(!isset($_SESSION['user'])) {
		
		header("location: logout.php");
		
	}
	
	$result = "";
	$info = "";
	$items = "";
	$pagenum = "";
	$per_page = 10;
		
		$count = $db->query("SELECT * FROM basket");
		
		$pages = ceil((mysqli_num_rows($count)) / $per_page);
		
		if(isset($_GET['page'])) {
			
			$page = $_GET['page'];
			
		}else{
			
			$page = 1;
			
		}
						
		$start = ($page - 1) * $per_page;
		
		$orders = $db->query("SELECT * FROM basket LIMIT $start, $per_page");
		
		if($orders->num_rows) {
			
			$x = 1;
			
			$info .= "<table class='table table-hover'>
						<thead>
							<th>Order_id</th>
							<th>name</th>
							<th>address</th>
							<th>Email</th>
							<th>Phone</th>
						</thead>
						<tbody>";
						
			$items .= "<table class='table table-hover'>
						<tbody>
						<tr>
							<th>Name</th>
							<th>Qty</th>
							<td></td>
						</tr>";
			
			while($row = $orders->fetch_assoc()) {
				
				$oid    = $row['id'];
				$id    = $row['id']."_ord";
				
				if($x == 1) {
					
					$result .=  "<input type='hidden' value='".$id."' 	id='".$id."'><a href='#' style='display: block; background: #efefef; color: #333; border-bottom: 1px solid #ccc; padding: 10px 0px;' onClick=\"func_call('".$id."'); return false\" >ORD_$oid</a>";
					
					$info .= "<tr>
								<td>ORD_$oid</td>
								<td>".$row['customer_name']."</td>
								<td>".$row['address']."</td>
								<td>".$row['email']."</td>
								<td>".$row['contact_number']."</td>
							</tr>";
					
					$get_data = $db->query("SELECT * FROM items WHERE order_id='".$oid."'");
					
					while($data = $get_data->fetch_assoc()) {
						
						$items .= "<tr>
										<td>".$data['food']."</td>
										<td>".$data['qty']."</td>
										<td></td>
									</tr>";
						
					}
					
					$items .= "<tr>
									<th>Total Price</th>
									<th>".$row['total']."</th>
									<th></th>
								</tr>
								";
					
					if($row['status'] == "pending") {
						
						$items .= "<tr>
									<th>Status</th>
									<td>
										<select onChange=\"change_stat('".$oid."')\" name='status' id='".$oid."' class='form-control'>
											<option value='pending_$oid' selected>pending</option>
											<option value='confirmed_$oid'>confirmed</option>
										</select>
									</td>
									<th></th>
								</tr>";
						
					}else{
						
						$items .= "<tr>
									<th>Status</th>
									<td>
										<select onChange=\"change_stat('".$oid."')\" id='".$oid."' name='status' class='form-control'>
											<option value='pending_$oid' >pending</option>
											<option value='confirmed_$oid' selected>confirmed</option>
										</select>
									</td>
									<th></th>
								</tr>";
						
					}
					
					
				}else{
					
					$result .=  "<input type='hidden' value='".$id."' 	id='".$id."'><a href='#' style='display: block; background: #efefef; color: #333; border-bottom: 1px solid #ccc; padding: 10px 0px;' onClick=\"func_call('".$id."'); return false\" >ORD_$oid</a>";
					
				}
																
									
				$x++;
			}
			
			$info .= "</tbody>
						</table>";
						
			$items .= "</tbody>
						</table>";
			
		}else{
			
			$result = "No Orders available yet";
			
			$info = "";
						
			$items = "";
			
		}
	
	
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		
		if(isset($_GET['delete']) && escape($_GET['delete']) != "") {
			
			$bird_id = escape($_GET['delete']);
			
			if($bird_id != "") {
				
				$query = $db->prepare("DELETE FROM birds WHERE bird_id=? LIMIT 1");
				$query->bind_param('i', $bird_id);
				
				if($query->execute()) {
					
					echo "<script>alert('Record deleted successfully')</script>";
					
				}else{
					
					echo "<script>alert('Record was not deleted successfully')</script>";
					
				}
				
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
		
		function func_call(id) {
			
			var value = document.getElementById(id).value;
			
			if(value != "") {
				
				$.ajax({
					
					url: 'get_item.php',
					type: 'post',
					data: {order_id : value},
					success: function(data) {
						//alert(data);
						$("#details_display").html(data);
					}
				});
				
			}
			
		}
		
		function change_stat(id) {
			
			var option = document.getElementById(id).value;
			
			$.ajax({
					
				url: 'get_item.php',
				type: 'post',
				data: {status : option},
				success: function(data) {
					alert(data);
				}
			});
			
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
                    <a class="navbar-brand" href="#" style="color: #fff;">FOOD ORDERS</a>
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
                                <h4 class="title" style="text-align: center">Order List</h4>
                            </div>
                            
							<div class="row">
								
								<div class="col-md-12" >
									
									<br/>	
									
									<div class="col-md-3" style="text-align: center; background: #2abccc; color: #fff; border-right: 1px solid #fff;">
									
										<h5>ORDER ID</h5>
										
									</div>
									
									<div class="col-md-9" style="background: #2abccc; color: #fff;">
									
										<h5>ORDER DETAILS</h5>
										
									</div>
									
								</div>
								
								<div class="col-md-3" style="text-align: center;">
									
									<?php echo $result; ?>
									
								</div>
								
								<div id="details_display" class="col-md-8 table-responsive" style="padding: 10px;">
									
									<?php echo $info; ?>
									
									<?php echo $items; ?>
									
								</div>
								
							</div>
							
							<div class="content table-responsive table-full-width">
                                
								<p style="padding: 0px 20px;"><?php if($pages >= 1 && $page <= $pages) {
									for($i = 1; $i <= $pages; $i++) {
										echo ($i == $page) ? "<a href='orders.php?page=".$i."' style='margin-left:5px; font-weight: bold; text-decoration: none; color: #FF5722;' >$i</a>  "  : " <a href='orders.php?page=".$i."' class='btn'>$i</a> ";
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
