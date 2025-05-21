<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$post_query = $connection->query("SELECT * FROM post WHERE ID = '{$_GET['id']}'");
$post_info = mysqli_fetch_array($post_query);

$comments_query = $connection->query("SELECT * FROM comment ORDER BY ID DESC");
$comments = mysqli_fetch_all($comments_query, MYSQLI_ASSOC);

if (isset($_POST['add-comment'])) {
	$comment = $_POST['comment'];
	$post_id = $_GET['id'];

	$connection->query("INSERT INTO comment (user, post_id, body) VALUES ('{$_SESSION['username']}', '{$_GET['id']}', '$comment')");

	$_SESSION['message'] = 'Comment was added';
	$_SESSION['message-type'] = 'info';

	header("location: detail.php?id=$post_id");
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $post_info['title']; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<h5><i>Has been made by: <a href="<?php echo($urls['account'] . $post_info['user']); ?>" class="text-danger"><?php echo $post_info['user']; ?></a></i></h5>
		<hr>
		<p><i><?php echo $post_info['body']; ?></i></p>
	</div>
	<br>
	<div class="content">
		<form action="" method="post">
			<input type="text" name="comment" placeholder="Write your comment..." class="form-control" required>
			<input type="submit" name="add-comment" value="Add Comment" class="btn btn-warning w-100">
		</form>
	</div>
	<br>
	<?php if (!empty($comments)): ?>
	<?php foreach($comments as $comment): ?>
	<div class="content">
		<p><?php echo $comment['body']; ?></p>
		<hr>
		<h5>Has been written by: <a href="<?php echo($urls['account'] . $comment['user']); ?>" class="text-danger"><?php echo $comment['user']; ?></a></h5>
		<?php if ($_SESSION['username'] === $comment['user']): ?>
		<a href="<?php echo($urls['post-comment-delete'] . $comment['ID']); ?>" class="btn btn-danger w-100">Delete</a>
		<?php endif; ?>
	</div><br>
	<?php endforeach; ?>
	<?php endif; ?>

	<script src="../js/script.js"></script>

</body>
</html>