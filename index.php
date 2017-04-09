<?php 
error_reporting(E_WARNING);
session_start();
$user = $_SESSION['loginUser'];
$pass = $_SESSION['loginPassword'];
if (!isset($_GET["login"]) && $_GET["login"] != "success") {
	if (!isset($user) &&  !isset($pass)) {
		header("Location: login.php?login=failed");
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin Panel (Project 1)</title>
		<link rel="stylesheet" href="css/style.css"> 
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li><a id="admin" href="index.php"><?php echo $user; ?></a></li>
					<li><a href="add.php">Add User</a></li>
					<li><a href="edit.php">Edit User</a></li>
					<li><a href="delete.php">Delete User</a></li>
					<li><a href="view.php">View User</a></li>
					<li><a id="admin" href="logout.php">Logout</a></li>
				</ul>
			</nav>
		</header>
		<h1>Welcome <?php echo $user; ?></h1>
		<h4>This is a final project for the Web Development class taught by Professor Nunan.<br /> 
			For once I actually did the homework sooner than the day it was due.<br /><br /> ~ Broc White</h4>
		<h5>The page is meant to be an admin panel user friendly enough for an employee to alter customer information.<br /></h5>
	</body>
</html>
