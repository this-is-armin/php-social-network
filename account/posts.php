<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$posts_query = $connection->query("SELECT * FROM post WHERE user = '{$_GET['username']}' ORDER BY ID DESC");
$posts = mysqli_fetch_all($posts_query, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Posts</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
	<div class="content">
		<h4><?php echo $post['title']; ?></h4>
		<p><i><?php echo $post['description']; ?></i></p>
		<hr>
		<a href="<?php echo($urls['post-detail'] . $post['ID']); ?>" class="btn btn-success w-25">Detail</a>
		<?php if ($_SESSION['username'] === $_GET['username']): ?>
		<a href="<?php echo($urls['post-edit'] . $post['ID']); ?>" class="btn btn-primary w-25">Edit</a>
		<a href="<?php echo($urls['post-delete'] . $post['ID']); ?>" class="btn btn-danger w-25">Delete</a>
		<?php endif; ?>
	</div>
	<br>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="content">
		<h5><i>There are not any posts yet</i></h5>
	</div>
	<?php endif; ?>

	<script src="../js/script.js"></script>

</body>
</html>