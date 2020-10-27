<?php 
	
	session_start();
	require "includes/db.php";
	require "includes/functions.php";

    if(!isset($_SESSION['user'])) {
        header("location: logout.php");
    }
	
	$msg = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit']) && isset($_FILES['file'])) {
			
			$cat = htmlentities($_POST['category'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
			$price = htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
			$desc = htmlentities($_POST['desc'], ENT_QUOTES, 'UTF-8');
			$file = $_FILES['file'];
			$allowed_ext = array("jpg", "jpeg", "JPG", "JPEG", "png", "PNG");
			
			if($cat != "" && $name != "" && $price != "" && $desc != "" && empty($file) == false) {
				
				$ext = explode(".", $_FILES['file']['name']);
				
				if(in_array($ext[1], $allowed_ext)) {
					
					$check = $db->query("SELECT * FROM food WHERE food_name='".$name."' LIMIT 1");
					
					if($check->num_rows) {
						
						$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>No duplicate  food name allowed. Try again!!!</p>";
						
					}else{
						
						$insert = $db->query("INSERT INTO food(food_name, food_category, food_price, food_description) VALUES('".$name."', '".$cat."', '".$price."', '".$desc."')");
						
						if($insert) {
							
							$ins_id = $db->insert_id;
							
							$image_url = "../image/FoodPics/$ins_id.jpg";
							
							if(move_uploaded_file($_FILES['file']['tmp_name'], $image_url)) {
								
								$msg = "<p style='color:green; padding: 10px; background: #eeffee;'>Food record successfully saved</p>";
								
							}else{
								
								$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Could not insert record, try again</p>";
								
							}
							
						}
						
					}
					
				}else{
					
					$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Invalid image file format</p>";
					
				}
				
			}else{
				
				$msg = "<p style='color:red; padding: 10px; background: #ffeeee;'>Incomplete form data</p>";
				
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
                    <a class="navbar-brand" href="#" style="color: #fff;">ADD NEW FOOD</a>
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
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Food Add Form</h4>
                            </div>
                            <div class="content">
                                <form method="post" action="food_add.php" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-12">
											
											<?php echo $msg; ?>
										
                                            <div class="form-group">
                                                <label style="color: #333">category</label>
                                                <select name="category" class="form-control" required />
													<option value="">Select food category</option>
													<option value="breakfast">Breakfast</option>
													<option value="lunch">Lunch</option>
													<option value="dinner">Dinner</option>
													<option value="special">Special</option>
												</select>
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="color: #333">Food Name</label>
                                                <input type="text" autofocus name="name" class="form-control" placeholder="Enter food Name" required />
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="color: #333" for="price">Price</label>
                                                <input type="text" name="price" id="price" class="form-control" placeholder="Enter Food Price" required />
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label style="color: #333" for="txtarea">Description</label>
                                                <textarea id="txtarea" class="form-control" placeholder="Enter Food description" name="desc" required></textarea>
                                            </div>
                                        </div>
                                    </div>
									
									<div class="row">
										
										<div class="col-md-12">
                                            <div class="form-group">
                                                <label style="display: block; border-radius: 5px; letter-spacing: 2px; background: #fff; color: #333; padding: 10px; border: 1px solid #ccc; cursor: pointer; text-align: center; font-size: 15px; font-weight: bold;" for="file" class="file_lbl"><i style="font-weight: bold; font-size: 19px;" class="pe-7s-upload"></i>Select Image<input type="file"  style="display: none;" id="file" name="file" required /></label>
                                            </div>
                                        </div>
										
									</div>
									
                                    <input type="submit" name="submit" style="background: #FF5722; border: 1px solid #FF5722" value="Save Food" class="btn btn-info btn-fill pull-right" />
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <footer class="footer">
            <div class="container-fluid">
                
                <p class="copyright pull-right">
                    &copy; <?php echo strftime("%Y", time())?> <a href="index.php">Unique Restaurant</a>
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

</html>
