<?php  

$folder_name = "social-network";
$base_url = "http://localhost/{$folder_name}/";

$urls = [
    'home' => "{$base_url}index.php",

    'sign-up' => "{$base_url}auth/sign-up.php",
    'sign-in' => "{$base_url}auth/sign-in.php",
    'sign-out' => "{$base_url}auth/sign-out.php",

    'account' => "{$base_url}account/profile.php?username=",
    'account-edit' => "{$base_url}account/edit.php?username=",
    'account-delete' => "{$base_url}account/delete.php?username=",
    'account-posts' => "{$base_url}account/posts.php?username=",
    'account-followers' => "{$base_url}account/followers.php?username=",
    'account-following' => "{$base_url}account/following.php?username=",
    'account-follow' => "{$base_url}account/follow.php?username=",
    'account-unfollow' => "{$base_url}account/unfollow.php?username=",

    'posts' => "{$base_url}post/posts.php",
    'post-add' => "{$base_url}post/add.php",
    'post-detail' => "{$base_url}post/detail.php?id=",
    'post-edit' => "{$base_url}post/edit.php?id=",
    'post-delete' => "{$base_url}post/delete.php?id=",
    'post-comment-delete' => "{$base_url}post/delete-comment.php?id=",
];

$connection = mysqli_connect('localhost', 'root', '', 'db_1');

?>