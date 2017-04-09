<html>
	<head>
		<meta charset="UTF-8">
		<title>Admin Panel (Project 1)</title>
		<link rel="stylesheet" href="css/style.css">
		<script>
		function login_first() {
			return alert("You must login first!");
		}
		</script>
	</head>
	<body>
		<header>
			<nav>
				<ul>
					<li><a id="admin">Please Login</a></li>
					<li><a onclick="login_first()">Add User</a></li>
					<li><a onclick="login_first()">Edit User</a></li>
					<li><a onclick="login_first()">Delete User</a></li>
					<li><a onclick="login_first()">View User</a></li>
				</ul>
			</nav>
		</header>
		<h1>Login</h1>
		<?php
		if (isset($_GET["login"]) && $_GET["login"] == "failed") {
			echo "<h5><font color='red'>Login failed.</font></h5>";
		}
		?>
		<form class="addUser" action="handler.php" method="post">
			<label for="userName"><span>Username:</span></label>
			<input type="text" name="userName" id="userName" placeholder="Admin" required><br>
			<label for="password"><span>Password:</span></label>
			<input type="text" name="password" id="password" placeholder="password" required><br>
			<input type="submit" value="Submit" name="login" class="button">
		</form> 
		<h5>Broc White<br /></h5>
	</body>
</html>