<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$followers_query = $connection->query("SELECT * FROM relation WHERE to_user = '{$_GET['username']}' ORDER BY ID DESC");
$followers = mysqli_fetch_all($followers_query, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Followers</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<?php if (!empty($followers)): ?>
	<?php foreach ($followers as $follower): ?>
	<div class="content">
		<h4><?php echo $follower['from_user']; ?></h4>
		<a href="<?php echo($urls['account'] . $follower['from_user']); ?>" class="btn btn-primary w-100">Show Profile</a>
		<?php if ($_SESSION['username'] === $_GET['username']): ?>
		<?php endif; ?>
	</div>
	<br>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="content">
		<h5><i>There are not any followers yet</i></h5>
	</div>
	<?php endif; ?>

	<script src="../js/script.js"></script>

</body>
</html>