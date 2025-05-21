<header>
	<a href="<?php echo $urls['home']; ?>">Home</a>
	<?php if (!isset($_SESSION['username'])): ?>
	<a href="<?php echo $urls['sign-up']; ?>">Sign-Up</a>
	<a href="<?php echo $urls['sign-in']; ?>">Sign-In</a>
	<?php else: ?>
	<a href="<?php echo $urls['posts']; ?>">Posts</a>
	<a href="<?php echo($urls['account'] . $_SESSION['username']); ?>">Profile</a>
	<?php endif; ?>
</header>