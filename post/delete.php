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

$connection->query("DELETE FROM post WHERE ID = '{$_GET['id']}'");

$_SESSION['message'] = 'Post was deleted';
$_SESSION['message-type'] = 'info';

$url = $urls['account-posts'] . $_GET['username'];
header("location: $url");

?>