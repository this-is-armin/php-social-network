<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$posts_query = $connection->query("SELECT * FROM post ORDER BY ID DESC");
$posts = mysqli_fetch_all($posts_query, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Posts</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<?php if (!empty($posts)): ?>
	<?php foreach ($posts as $post): ?>
	<div class="content">
		<p><i><?php echo $post['description']; ?></i></p>
		<hr>
		<a href="<?php echo($urls['post-detail'] . $post['ID']); ?>" class="btn btn-success w-100">Detail</a>
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