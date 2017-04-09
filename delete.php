<?php 
error_reporting(E_WARNING);
session_start();
$user = $_SESSION['loginUser'];
$pass = $_SESSION['loginPassword'];
if (!isset($user) &&  !isset($pass)) {
	header("Location: login.php?login=failed");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin Panel (Project 1)</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
		function confirm_delete() {
			var user = document.getElementById('user').options[document.getElementById('user').selectedIndex].text;
			return confirm("Delete the user: " + user + "?");
		}
		</script>
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
		<h1>Delete User</h1>
		<?php
		if (isset($_GET["delete"]) && $_GET["delete"] == "failed") {
			echo "<h5><font color='red'>Deleting user failed.</font></h5>";
		} else if (isset($_GET["delete"]) && $_GET["delete"] == "success") {
			echo "<h5><font color='green'>Deleted user successfully.</font><h5/>";
		}
		?>
		<form class="addUser" action="handler.php" method="post" onsubmit="return confirm_delete();">
			<label for="user"><span>Select a User:</span></label>
			<select name="user" id="user">
				<?php
				include_once('handler.php');
				foreach( $result as $row ) {
					echo "<option value='".$row['ID']."'>".$row['ID']." - ".$row['FirstName']." ".$row['LastName']." || ".$row['Email']." || ".$row['Address']."</option>";
				}
				?>
			</select>
			<input type="submit" value="Submit" name="deleteUser" class="button">
		</form> 
		<h5>Broc White<br /></h5>
	</body>
</html>
