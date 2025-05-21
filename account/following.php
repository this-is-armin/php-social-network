<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


$all_following_query = $connection->query("SELECT * FROM relation WHERE from_user = '{$_GET['username']}' ORDER BY ID DESC");
$all_following = mysqli_fetch_all($all_following_query, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Following</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

	<?php include '../includes/header.php'; ?>
	<?php include '../includes/messages.php'; ?>

	<?php if (!empty($all_following)): ?>
	<?php foreach ($all_following as $following): ?>
	<div class="content">
		<h4><?php echo $following['to_user']; ?></h4>
		<a href="<?php echo($urls['account'] . $following['to_user']); ?>" class="btn btn-primary w-100">Show Profile</a>
		<?php if ($_SESSION['username'] === $_GET['username']): ?>
		<?php endif; ?>
	</div>
	<br>
	<?php endforeach; ?>
	<?php else: ?>
	<div class="content">
		<h5><i>There are not any following yet</i></h5>
	</div>
	<?php endif; ?>

	<script src="../js/script.js"></script>

</body>
</html>