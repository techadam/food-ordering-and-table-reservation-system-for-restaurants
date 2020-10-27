<?php 
	
	session_start();
	require "admin/includes/functions.php";
	require "admin/includes/db.php";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		if(isset($_POST['order_info'])) {
			
			$values = "VALUES";
			
			$name 		= preg_replace("#[^a-zA-Z ]#", "", $_POST['name']);
			$addr 		= preg_replace("#[^a-zA-Z0-9 ]#", "", $_POST['addr']);
			$email 		= htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$phone 		= preg_replace("#[^0-9]#", "", $_POST['phone']);
			$food 		= htmlentities($_POST['food'], ENT_QUOTES, 'UTF-8');
			$price 		= htmlentities($_POST['price'], ENT_QUOTES, 'UTF-8');
			
			if($name != "" && $addr != "" && $email != "" && $phone != "" && $food != "" && $price != "") {
				
				$insert = $db->query("INSERT INTO basket(customer_name, contact_number, address, email, total, status, date_made) VALUES('".$name."', '".$phone."', '".$addr."', '".$email."', '".$price."', 'pending', NOW())");
				
				if($insert) {
					
					$ins_id = $db->insert_id;
					
					$food_array = explode(",", $food);
				
					foreach($food_array as $key => $value) {
						
						if(trim($value) != "") {
							
							$exp = explode("-", $value);
							
							$values .= "('".$ins_id."', '".$exp[0]."', '".$exp[1]."'),";
							
						}
						
					}
					
					$values = rtrim($values, ",");
					
					$save_item = $db->query("INSERT INTO items(order_id, food, qty) ".$values." ");
					
					if($save_item) {
						
						$_SESSION['order_id'] = "ORD_".$ins_id;
						$_SESSION['name'] = $name;
						
						echo "success";
						
					}
						
				}
				
			}else{
				
				echo "Incomplete Form Data";
				
			}
			
			
		}elseif(isset($_POST['item_id_qty']) && $_POST['item_id_qty'] != "") {
			
			$explode_var = explode("_", htmlentities($_POST['item_id_qty']));
			
			$item_to_adjust = $explode_var[1];
			$quantity = $explode_var[0];
			
			if ($quantity >= 100) { $quantity = 99; }
			if ($quantity < 1) { $quantity = 1; }
			if ($quantity == "") { $quantity = 1; }
			$i = 0;
			foreach ($_SESSION["cart_array"] as $each_item) { 
					  $i++;
					  
					  
					  foreach($each_item as $key => $value) {
						  if ($key == "item_id" && $value == $item_to_adjust) {
							  // That item is in cart already so let's adjust its quantity using array_splice()
							  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $item_to_adjust, "quantity" => $quantity)));
						  } // close if condition
					  }
			}
			
			$sql = $db->query("SELECT * FROM food WHERE id='$item_to_adjust' LIMIT 1");
			while ($row = $sql->fetch_assoc()) {
				
				$price = $row['food_price'];
				
			}
			$pricetotal = $price * $quantity;
			
			echo $pricetotal;
			
		}
		
	}
	
?>