<?php
	$_head = array(
		"title" => "Login",
		"links" => array('css/app.css'),
		"scripts" => array('js/main.js'),
		"refresh" => null
	);
	$_header = array();
	$_navbar = array();
	$_footer = array();
?>
<!DOCTYPE html>
<html>
<?php include_once "layout/head.php";?>
<body class="body">
<?php include_once "layout/header.php";?>
<?php include_once "layout/navbar.php";?>
<div class="login">
	<div class="login-bg-img"></div>
	<div class="login-circle">
		<p>Login or <a href="#">Sign Up</a></p>
		<div class="login-form">
			<label for="username">Username:</label>
			<input type="text" name="username" id="username" autocomplete="off">
		</div>
		<div class="login-form">
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" autocomplete="off">
		</div>
	</div>
</div>
<script src="js/login.js"></script>
<?php include_once "layout/footer.php";?>
</body>
</html>
