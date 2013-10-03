<html>
	<head>
		<script src="js/jquery.js"></script>
		
		<link href="css/style.css" rel="stylesheet" />
		
		<script>
			var color_input = "<div class='color_input'><label for='var_name'>Variable Name</label><input type='text' class='var_name' name='var_name[]' /><label for='color_hex'>Color Hex</label><input class='color_hex' type='text' name='color_hex[]' /><div class='add_color'></div><div class='remove_color'></div></div>";
			
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
				

				$("#mixin-form").on("submit",function(e){
					//each() var_name and color_hex to make sure all are filled, if not return; and error
					
					//check if any var_name or color_hex fields are blank
					$(".var_name,.color_hex").each(function(){
						if( !$(this).val() ) {
							$(this).addClass("error");
						} 
					});
					
					//if there are no errors, run ajax
					if( $(".error").length == 0 ){
						$.ajax({
							type:'POST',
							url:'mixin-file.php',
							data: $(this).serialize(),
							success: function(data){
								$("#msg").html("success=<br>"+data);
							},
							error: function(){
								$("#msg").text("fuck");
							}
						});
					}
					e.preventDefault();
				}); 
			});
		</script>
	</head>
	<body>
		<form id="mixin-form" enctype="multipart/form-data"> 
			<!-- Colors -->
			<div id="colors">
				<span id="color_init" class="add_color">Add Color</span>
			</div>
			<input type="file" name="myFile">
			<br>
			<input type="submit" value="Generate">	
		</form>
		<div id="msg"></div>
	</body>
</html>