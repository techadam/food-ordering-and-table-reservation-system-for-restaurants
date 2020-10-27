<?php 
	
	
	function excape($string) {
		
		echo isset($_POST[$string]) ? htmlentities($_POST[$string],  ENT_QUOTES, 'UTF-8') : "";
		
	}
	
	function escape($string) {
		
		return htmlentities(trim($string), ENT_QUOTES, 'UTF-8');
		
	}
	
	function generate_option($lower_limit, $upper_limit) {
		
		$option = "";
		
		for($i = (int)$lower_limit; $i <= (int)$upper_limit; $i++) {
			
			$option .= "<option value='".$i."'>$i</option>";
			
		}
		
		return $option;
		
	}
	
	function render_options($qty, $id) {
		
		$option = "";
		
		for($x = 1; $x <= 50; $x++) {
			
			if($x == $qty) {
				
				$option .= "<option value='".$x."_".$id."' selected>$x</option>";
				
			}else{
				
				$option .= "<option value='".$x."_".$id."'>$x</option>";
				
			}
			
		}
		
		return $option;
		
	}
	
?>