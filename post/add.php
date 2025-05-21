<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if (isset($_POST['add-post'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$body = $_POST['body'];

	$connection->query("INSERT INTO post (user, title, description, body) VALUES ('{$_SESSION['username']}', '$title', '$description', '$body')");

	$_SESSION['message'] = 'Post was added';
	$_SESSION['message-type'] = 'info';

	$url = $urls['account'] . $_SESSION['username'];
	header("location: $url");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Post</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<form action="" method="post">
			<input type="text" name="title" placeholder="Enter title..." maxlength="100" class="form-control" required>
			<textarea name="description" placeholder="Enter description..." rows="3" maxlength="500" class="form-control" required></textarea>
			<textarea name="body" placeholder="Enter body..." rows="8" class="form-control" required></textarea>
			<input type="submit" name="add-post" value="Add Post" class="btn btn-warning w-100">
		</form>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>