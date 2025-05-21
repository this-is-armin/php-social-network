<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$post_query = $connection->query("SELECT * FROM post WHERE ID = '{$_GET['id']}'");
$post_info = mysqli_fetch_array($post_query);

if ($_SESSION['username'] !== $post_info['user']) {
	header('location: posts.php');
	exit();
}

if (isset($_POST['edit-post'])) {
	$title = $_POST['title'];
	$description = $_POST['description'];
	$body = $_POST['body'];

	$connection->query("UPDATE post SET title = '$title', description = '$description', body = '$body' WHERE ID = '{$_GET['id']}'");

	$_SESSION['message'] = 'Post was edited';
	$_SESSION['message-type'] = 'info';

	$url = $urls['account-posts'] . $_SESSION['username'];
	header("location: $url");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Post Edit</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<form action="" method="post">
			<input type="text" name="title" placeholder="Enter title..." value="<?php echo $post_info['title']; ?>" maxlength="100" class="form-control" required>
			<textarea name="description" placeholder="Enter description..." rows="3" maxlength="500" class="form-control" required><?php echo $post_info['description']; ?></textarea>
			<textarea name="body" placeholder="Enter body..." rows="8" class="form-control" required><?php echo $post_info['body']; ?></textarea>
			<input type="submit" name="edit-post" value="Edit Post" class="btn btn-warning w-100">
		</form>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>