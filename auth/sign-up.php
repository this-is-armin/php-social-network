<?php  

session_start();
require '../core/config.php';


if (isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if (isset($_POST['sign-up'])) {
	$username = strtolower($_POST['username']);
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$password = $_POST['password'];
	$confirm_password = $_POST['confirm_password'];

	$invalid_chars = ['<', '>', '(', ')', '[', ']', '{', '}', ',', '/', '\\', '|', '=', '-', '`', '@', '#', '$', '%', '^', '*', '&', 'username'];
    foreach ($invalid_chars as $char) {
        if (strpos($username, $char)) {
            $_SESSION['message'] = 'This username invalid';
			$_SESSION['message-type'] = 'danger';
			header('location: sign-up.php');
			exit();
		}
	}

	$query_user_exists = $connection->query("SELECT username FROM user WHERE username = '$username'");
	if ($query_user_exists->num_rows > 0) {
		$_SESSION['message'] = 'This username already exists';
		$_SESSION['message-type'] = 'danger';
		header('location: sign-up.php');
		exit();
	}

	if ($password !== $confirm_password) {
		$_SESSION['message'] = 'Passwords must match';
		$_SESSION['message-type'] = 'danger';
		header('location: sign-up.php');
		exit();
	}

	$connection->query("INSERT INTO user (username, email, first_name, last_name, password) VALUES ('$username', '$email', '$first_name', '$last_name', '$password')");

	$_SESSION['message'] = 'Sign-Up was successful';
	$_SESSION['message-type'] = 'info';

	header('location: sign-in.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign Up</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<form action="" method="post">
			<input type="text" name="username" placeholder="Enter username..." maxlength="100" class="form-control" required style="text-transform: lowercase;">
			<input type="email" name="email" placeholder="Enter email address..." maxlength="200" class="form-control" required>
			<input type="text" name="first_name" placeholder="Enter first-name..." maxlength="100" class="form-control" required>
			<input type="text" name="last_name" placeholder="Enter last-name..." maxlength="100" class="form-control" required>
			<input type="password" name="password" placeholder="Enter password..." minlength="8" maxlength="100" class="form-control" required>
			<input type="password" name="confirm_password" placeholder="Confirm password..." minlength="8" maxlength="100" class="form-control" required>
			<input type="submit" name="sign-up" value="Sign Up" class="btn btn-warning w-100">
		</form>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>