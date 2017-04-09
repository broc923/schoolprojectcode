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
		function confirm_viewUser() {
			var user = document.getElementById('user').options[document.getElementById('user').selectedIndex].text;
			return confirm("Search for the user: " + user + "?");
		}
		function confirm_viewCategory() {
			var category = document.getElementById('category').options[document.getElementById('category').selectedIndex].text;
			return confirm("Search for the category: " + category + "?");
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
		<h1>View a User</h1>
		<form class="addUser" action="handler.php" method="post" onsubmit="return confirm_viewUser();">
			<label for="user"><span>Select a Specific User:</span></label>
			<select name="user" id="user">
				<?php
				include_once('handler.php');
				foreach( $result as $row ) {
					echo "<option value='".$row['ID']."'>".$row['ID']." - ".$row['FirstName']." ".$row['LastName']." || ".$row['Email']." || ".$row['Address']."</option>";
				}
				?>
			</select>
			<input type="submit" value="Search" name="viewUser" class="button">
		</form>
		<br />
		<form class="addUser" action="handler.php" method="post" onsubmit="return confirm_viewCategory();">
			<label for="category"><span>Select a Specific Category:</span></label>
			<select name="category" id="category">
				<option>Regular</option>
				<option>VIP</option>
				<option>Exclusive</option>
			</select>
			<input type="submit" value="Search" name="viewCategory" class="button">
		</form>
		<?php
		session_start();
		if (isset($_GET["view"]) && $_GET["view"] == "failed") {
			echo "<h5><font color='red'>Viewing user failed.</font></h5>";
		} else if (isset($_GET["view"]) && $_GET["view"] == "true") {
		$user = $_SESSION['userdata'];
			echo '<table>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Category</th>
					</tr>
					<tr>';
						echo '<td>'.$user["ID"].'</td>';
						echo '<td>'.$user["FirstName"].'</td>';
						echo '<td>'.$user["LastName"].'</td>';
						echo '<td>'.$user["Address"].'</td>';
						echo '<td>'.$user["PhoneNumber"].'</td>';
						echo '<td>'.$user["Email"].'</td>';
						echo '<td>'.$user["Category"].'</td>';
					echo '</tr>
				  </table> ';
			
		}else if (isset($_GET["category"]) && $_GET["category"] == "true") {
			$categoryUsers = $_SESSION['userdata'];
			echo '<table>
					<tr>
						<th>ID</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Address</th>
						<th>Phone Number</th>
						<th>Email</th>
						<th>Category</th>
					</tr>';
						foreach ($categoryUsers as $row) {
						echo '<tr>';
							echo '<td>'.$row["ID"].'</td>';
							echo '<td>'.$row["FirstName"].'</td>';
							echo '<td>'.$row["LastName"].'</td>';
							echo '<td>'.$row["Address"].'</td>';
							echo '<td>'.$row["PhoneNumber"].'</td>';
							echo '<td>'.$row["Email"].'</td>';
							echo '<td>'.$row["Category"].'</td>';
						echo '</tr>';
						}
				  echo '</table>';
			
		}
		?>
		<h5>Broc White<br /></h5>
	</body>
</html>
