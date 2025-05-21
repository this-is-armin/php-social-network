<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if ($_SESSION['username'] !== $_GET['username']) {
	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
}


$user_query = $connection->query("SELECT email, first_name, last_name FROM user WHERE username = '{$_SESSION['username']}'");
$user_info = mysqli_fetch_array($user_query);


if (isset($_POST['edit-account'])) {
	$email = $_POST['email'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];

	$connection->query("UPDATE user SET email = '$email', first_name = '$first_name', last_name = '$last_name' WHERE username = '{$_SESSION['username']}'");

	$_SESSION['message'] = 'Account was edited';
	$_SESSION['message-type'] = 'info';

	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Account</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<form action="" method="post">
			<input type="email" name="email" placeholder="Enter email address..." value="<?php echo $user_info['email']; ?>" maxlength="200" class="form-control" required>
			<input type="text" name="first_name" placeholder="Enter first-name..." value="<?php echo $user_info['first_name']; ?>" maxlength="100" class="form-control" required>
			<input type="text" name="last_name" placeholder="Enter last-name..." value="<?php echo $user_info['last_name']; ?>" maxlength="100" class="form-control" required>
			<input type="submit" name="edit-account" value="Edit Account" class="btn btn-warning w-100">
		</form>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>