<?php


if(isset($_GET['submit'])){

	require 'Text.php';
	
	$text = new Text;

	$output = $text->process($_GET['textInput'], $_GET['transformInput']);

	$output = implode('', $output);
}

	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Text-Transform</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container mt-3 text-center">
		<form action="#" method="get">
			<div class="form-group">
				<div class="row">
					<label for="textInput">Your Text</label>
					<textarea name="textInput" class="form-control">
						<?php
						if (isset($_GET['textInput'])) {
							echo $_GET['textInput'];
						}
						?>
					</textarea>	
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="transformInput text-left">Your Command</label>
					<input type="text" class="form-control" name="transformInput" placeholder="H = horizontal flip, V = vertical flip, 5 = linear shift to right by 5 spaces, -5 = linear shift to left by 5 spaces. Example: H, V, 5" value="<?php
						if (isset($_GET['transformInput'])) {
							echo $_GET['transformInput'];
						}
						?>">
				</div>
			</div>
			<div>
				<button type="submit" class="btn btn-primary" name="submit" value="Transform">Transform</button>
			</div>
		</form>

		<p>
			<?php
			if(isset($output)){ ?>
				<h1> The Output is <?php echo $output;  ?> </h1> <?php 
			}?>
		</p>
	</div>
	
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>