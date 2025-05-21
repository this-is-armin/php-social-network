<?php  

session_start();
require '../core/config.php';


if (isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if (isset($_POST['sign-in'])) {
	$username = strtolower($_POST['username']);
	$password = $_POST['password'];

	$query_user_exists = $connection->query("SELECT username, password FROM user WHERE username = '$username' AND password = '$password'");
	if ($query_user_exists->num_rows <= 0) {
		$_SESSION['message'] = 'Username or Password incorrect';
		$_SESSION['message-type'] = 'danger';
		header('location: sign-in.php');
		exit();
	}

	$_SESSION['username'] = $username; 
	$_SESSION['message'] = 'Sign-In was successful';
	$_SESSION['message-type'] = 'info';

	header('location: ../index.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign In</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<form action="" method="post">
			<input type="text" name="username" placeholder="Enter username..." maxlength="100" class="form-control" required style="text-transform: lowercase;">
			<input type="password" name="password" placeholder="Enter password..." minlength="8" maxlength="100" class="form-control" required>
			<input type="submit" name="sign-in" value="Sign In" class="btn btn-warning w-100">
		</form>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>