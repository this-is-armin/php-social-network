<?php  

session_start();
require '../core/config.php';


if (!isset($_SESSION['username'])) {
	header('location: ../index.php');
	exit();
}


if ($_SESSION['username'] === $_GET['username']) {
	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
}


$is_follow_query = $connection->query("SELECT * FROM relation WHERE from_user = '{$_SESSION['username']}' AND to_user = '{$_GET['username']}'");
$is_follow = mysqli_num_rows($is_follow_query);

if ($is_follow > 0) {
	$connection->query("DELETE FROM relation WHERE from_user = '{$_SESSION['username']}' AND  to_user = '{$_GET['username']}'");

	$_SESSION['message'] = 'Account was unfollowed';
	$_SESSION['message-type'] = 'info';

	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
} else {
	$url = $urls['account'] . $_GET['username'];
	header("location: $url");
}

?>