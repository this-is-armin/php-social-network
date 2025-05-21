<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$user_query = $connection->query("SELECT * FROM user WHERE username = '{$_GET['username']}'");
$user_info = mysqli_fetch_array($user_query);

$followers_query = $connection->query("SELECT * FROM relation WHERE to_user = '{$user_info['username']}'");
$following_query = $connection->query("SELECT * FROM relation WHERE from_user = '{$user_info['username']}'");

$followers_count = mysqli_num_rows($followers_query);
$following_count = mysqli_num_rows($following_query);

$is_follow_query = $connection->query("SELECT * FROM relation WHERE from_user = '{$_SESSION['username']}' AND to_user = '{$user_info['username']}'");
$is_follow = mysqli_num_rows($is_follow_query);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<div class="content">
		<h3><?php echo $user_info['username']; ?></h3>
		<h3><?php echo($user_info['first_name'] . " ~ " . $user_info['last_name']); ?></h3>
		<h3><?php echo $user_info['email']; ?></h3>
		<hr>
		<div id="profile-buttons">
			<?php if ($_SESSION['username'] === $user_info['username']): ?>
			<a href="<?php echo $urls['sign-out']; ?>" class="btn btn-warning w-100">Leave Account</a>
			<a href="<?php echo($urls['account-edit'] . $user_info['username']); ?>" class="btn btn-primary w-100">Edit Account</a>
			<a href="<?php echo($urls['account-delete'] . $user_info['username']); ?>" class="btn btn-danger w-100">Delete Account</a>
			<hr>
			<?php endif; ?>
			<a href="<?php echo($urls['account-followers'] . $_GET['username']); ?>" class="btn btn-dark w-100">Followers <?php echo $followers_count; ?></a>
			<a href="<?php echo($urls['account-following'] . $_GET['username']); ?>" class="btn btn-dark w-100">Following <?php echo $following_count; ?></a>
			<hr>
			<?php if ($_SESSION['username'] === $user_info['username']): ?>
			<a href="<?php echo $urls['post-add']; ?>" class="btn btn-success w-100">Add Post</a>
			<?php endif; ?>
			<?php if ($_SESSION['username'] !== $user_info['username']): ?>
			<?php if ($is_follow <= 0): ?>
			<a href="<?php echo($urls['account-follow'] . $_GET['username']); ?>" class="btn btn-primary w-100">Follow</a>
			<hr>
			<?php else: ?>
			<a href="<?php echo($urls['account-unfollow'] . $_GET['username']); ?>" class="btn btn-danger w-100">Unfollow</a>
			<hr>
			<?php endif; ?>
			<?php endif; ?>
			<a href="<?php echo($urls['account-posts'] . $user_info['username']); ?>" class="btn btn-success w-100">Posts</a>
		</div>
	</div>
	<br>

	<script src="../js/script.js"></script>

</body>
</html>