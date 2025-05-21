<?php  

session_start();
require './core/config.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>

	<?php include 'includes/header.php'; ?>
	<?php include 'includes/messages.php'; ?>

	<div class="content">
		<h3>Hello World</h3>
		<p><i>Has been made by a programmer with PHP</i></p>
	</div>
	<br>

	<script src="./js/script.js"></script>

</body>
</html>