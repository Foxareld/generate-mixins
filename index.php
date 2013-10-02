<html>
	<head>
		<script src="js/jquery.js"></script>
		
		<link href="css/style.css" rel="stylesheet" />
		
		<script>
			var color_input = "<div class='color_input'><label for='var_name'>Variable Name</label><input type='text' name='var_name[]' /><label for='color_hex'>Color Hex</label><input type='text' name='color_hex[]' /><div class='add_color'></div><div class='remove_color'></div></div>";
			
			function addColor() {
				
				//add colors
				//add click event for all .add_colors. Must use .on() for dynamically created elements
				$(document).on("click","#colors .add_color", function(e){
					$("#colors").append(color_input);
					
					//hide clicked button
					$(e.target).hide();
				});
				
				//remove colors
				$(document).on("click","#colors .remove_color", function(e){
				
					//remove click targets .color_input parent
					$(e.target).parent(".color_input").remove();
					
					//if the last add_color is hidden, show it. (If you remove the last color_input element)
					if(!($(".add_color").last().is(":visible"))) {
						$(".add_color").last().show();
					}
				});
			}
			
			$(document).ready(function(){
				addColor();
			});
		</script>
	</head>
	<body>
		<form action="mixin-file.php" method="post" enctype="multipart/form-data"> 
			<!-- Colors -->
			<div id="colors">
				<span id="color_init" class="add_color">Add Color</span>
			</div>
			<input type="file" name="myFile">
			<br>
			<input type="submit" value="Generate">	
		</form>
	</body>
</html>