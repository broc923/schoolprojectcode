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
		function confirm_add() {
			var firstName = document.getElementById('firstName').value;
			var lastName = document.getElementById('lastName').value;
			var address = document.getElementById('address').value;
			var phoneNumber = document.getElementById('phoneNumber').value;
			var email = document.getElementById('email').value;
			var category = document.getElementById('category').value;
			return confirm("The name is " + firstName + " " + lastName + ", with the address of " + address + " and the phone number of " + phoneNumber + " and the email of " + email + " in the category " + category + "?");
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
		<h1>Add User</h1>
		<?php
		if (isset($_GET["add"]) && $_GET["add"] == "failed") {
			echo "<h5><font color='red'>Add user failed.</font></h5>";
		} else if (isset($_GET["add"]) && $_GET["add"] == "success") {
			echo "<h5><font color='green'>Added user successfully.</font><h5/>";
		}
		?>
		<form class="addUser" action="handler.php" method="post" onsubmit="return confirm_add();">
			<label for="firstName"><span>First Name:</span></label>
			<input type="text" name="firstName" id="firstName" placeholder="First Name" required><br>
			<label for="lastName"><span>Last Name:</span></label>
			<input type="text" name="lastName" id="lastName" placeholder="Last Name" required><br>
			<label for="address"><span>Home Address:</span></label>
			<input type="text" name="address" id="address" placeholder="Home Address" required><br>
			<label for="phoneNumber"><span>Phone Number:</span></label>
			<input type="text" name="phoneNumber" id="phoneNumber" placeholder="Phone Number" required><br>
			<label for="email"><span>Email:</span></label>
			<input type="email" name="email" id="email" placeholder="Email" required><br>
			<label for="category"><span>Category:</span></label>
			<select name="category" id="category">
				<option>Regular</option>
				<option>VIP</option>
				<option>Exclusive</option>
			</select>
			<input type="submit" value="Submit" name="addUser" class="button">
		</form> 
		<h5>Broc White<br /></h5>
	</body>
</html>
