<!Doctype html>

<html lang="en">

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<meta name="description" content="" />

<meta name="keywords" content="" />

<head>
	
<title>MFORS</title>

<link rel="stylesheet" href="css/main.css" />

<link rel="stylesheet" href="css/lightbox.min.css" />

<script src="js/jquery.min.js" ></script>

<script src="js/myscript.js"></script>
	
</head>

<body>
	
<?php require "includes/header.php"; ?>

<div class="parallax" onclick="remove_class()">
	
	<div class="parallax_head">
		
		<h2>Our</h2>
		<h3>Gallery</h3>
		
	</div>
	
</div>

<div class="content" onclick="remove_class()">
	
	<div class="inner_content on_parallax">
		
		<h2><span class="fresh">Food Varieties</span></h2>
		
		<div class="parallax_content">
			
			<div class="multicol">
				
				<div class="image_display">
				
					<a href="image/dish_3.jpg" data-lightbox="image-1"><img src="image/dish_3.jpg" alt="image/dish_3.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
					<a href="image/dish.jpg" data-lightbox="image-2"><img src="image/dish.jpg" alt="image/dish.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
					<a href="image/dish_4.jpg" data-lightbox="image-3"><img src="image/dish_4.jpg" alt="image/dish_4.jpg" width="100%" />
					
				</div>
				
				<div class="image_display">
					
					<a href="image/dish_2.jpg" data-lightbox="image-4"><img src="image/dish_2.jpg" alt="image/dish_2.jpg" width="100%" /></a>
					
				</div>
				
				<div class="image_display">
					
					<a href="image/dish_5.jpg" data-lightbox="image-5"><img src="image/dish_5.jpg" alt="image/dish_5.jpg" width="100%" /></a>
					
				</div>
                    
                <div class="image_display">
					
					<a href="image/dish_6.jpg" data-lightbox="image-6"><img src="image/dish_6.jpg" alt="image/dish_6.jpg" width="100%" /></a>
					
				</div>
                    
                <div class="image_display">
					
					<a href="image/dish_7.jpg" data-lightbox="image-7"><img src="image/dish_7.jpg" alt="image/dish_7.jpg" width="100%" /></a>
					
				</div>
				
			</div>
			
			<p class="clear"></p>
			
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

<script src="js/lightbox.min.js" ></script>