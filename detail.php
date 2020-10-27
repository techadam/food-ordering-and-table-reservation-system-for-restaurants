<?php 
	
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";

	$name = "";
	$desc = "";
	$category = "";
	$price = "";
	$id = "";
	
	if($_SERVER['REQUEST_METHOD'] == 'GET') {
		
		if(isset($_GET['fid']) && preg_replace("#[^0-9]#", "", $_GET['fid']) != "") {
			
			$fid = preg_replace("#[^0-9]#", "", $_GET['fid']);
			
			if($fid != "") {
				
				$get_detail = $db->query("SELECT * FROM food WHERE id='".$fid."' LIMIT 1");
				
				if($get_detail->num_rows) {
					
					while($row = $get_detail->fetch_assoc()) {
						
						$id = $row['id'];
						$name = $row['food_name'];
						$desc = $row['food_description'];
						$cat  = $row['food_category'];
						$price  = $row['food_price'];
						
					}
					
				}else{
					
					header("location: index.php");
					
				}
				
			}
			
		}else{
			
			header("location: index.php");
			
		}
		
	}elseif($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['submit'])) {
			
			$id = preg_replace("#[^0-9]#", "", $_POST['fid']);
			$qty = preg_replace("#[^0-9]#", "", $_POST['amount']);
			
			header("location: basket.php?fid=".$id."&qty=".$qty."");
			
		}
		
	}
	
?>

<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>MFORS</title>

<link rel="stylesheet" href="css/main.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<!--<div class="parallax" onclick="remove_class()">
	
	<div class="parallax_head">
		
		<h2>Meal</h2>
		<h3>Description</h3>
		
	</div>
	
</div>--><br/><br/><br/>

<div class="content remove_pad" onclick="remove_class()">
	
	<div class="inner_content on_parallax">
		
		<h2><span class="fresh">Food Description</span></h2>
		
		<div class="parallax_content">
			
			<div class="detail_holder">
				
				<div class="detail_img">
				
					<img src="image/FoodPics/<?php echo $id;?>.jpg" width="100%" alt="no image found" />
					
				</div>
				
				<div class="detail_desc">
					
					<form class="" method="post" action="detail.php">
						
						<h3 class="desc_header"><?php echo $name; ?></h3>
						<p class="desc_detail"><?php echo $desc; ?> </p>
						<p><span class="bold_desc">Category:</span> <?php echo $cat; ?></p>
						<p><span class="bold_desc price">Price:</span> #<span id="price"><?php echo $price; ?></span></p>
						<div class="form_group">
							
							<p><span class="bold_desc">Quantity:</span></p>
							<p class="label_center"><label class="subtract" onclick="subtract_price();">-</label><input readonly type="text" id="amount" name="amount" value="1"><label class="add" onclick="sum_price();">+</label><p>
							
						</div>
						
						<p><span class="bold_desc">Total Price:</span> #<span id="total_price"><?php echo $price; ?></span></p>
						
						<div class="form_group">
							<input type="hidden" name="fid" value="<?php echo $id; ?>">
							<input type="submit" name="submit" class="submit add_order" value="Add to Order" />
							
						</div>
						
					</form>
					
				</div>
				
				<p class="clear"></p>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<div class="content" onclick="remove_class()">
	
	<div class="inner_content">
		
		<div class="contact">
			
			<div class="left">
				
				<h3>LOCATION</h3>
				<p>Buk New Site, New Campus</p>
				<p>Kano State</p>
				
			</div>
			
			<div class="left">
				
				<h3>CONTACT</h3>
				<p>08054645432, 07086898709</p>
				<p>Website@gmail.com</p>
				
			</div>
			
			<p class="left"></p>
			
			<div class="icon_holder">
				
				<a href="#"><img src="image/icons/Facebook.png" alt="image/icons/Facebook.png" /></a>
				<a href="#"><img src="image/icons/Google+.png" alt="image/icons/Google+.png"  /></a>
				<a href="#"><img src="image/icons/Twitter.png" alt="image/icons/Twitter.png"  /></a>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<div class="footer_parallax" onclick="remove_class()">
	
	<div class="on_footer_parallax">
		
		<p>&copy; <?php echo strftime("%Y", time()); ?> <span>MyRestaurant</span>. All Rights Reserved</p>
		
	</div>
	
</div>
	
</body>

</html>

<script>
	
	function sum_price() {
		
		amount = $("#amount").val();
		toInt = parseInt(amount);
		toInt = toInt + 1;
		$("#amount").val(toInt);
		price = $("#price").html();
		total_price = price * toInt;
		$("#total_price").html(total_price);
		
	}
	
	function subtract_price() {
		
		amount = $("#amount").val();
		toInt = parseInt(amount);
		if(toInt == 1) {
			
			toInt = 1;
			
		}else{
			
			toInt = toInt - 1;
			
		}
		
		$("#amount").val(toInt);
		price = $("#price").html();
		total_price = price * toInt;
		$("#total_price").html(total_price);
		
	}
	
</script>