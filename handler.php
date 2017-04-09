<?php 
error_reporting(E_WARNING);
session_start();
$user = $_SESSION['loginUser'];
$pass = $_SESSION['loginPassword'];
if (!isset($user) &&  !isset($pass)) {
	header("Location: login.php?login=failed");
}
?>
<?php
/*********************************IMPORTANT*********************************************
* NOTE: The reason data is not passed through $_SERVER[] is a known XSS issue with PHP5.
* EX: index.php/%22%3E%3Cscript%3Ealert('hacked')%3C/script%3E
* This alerts the message hacked. The only way to stop it is htmlspecialchars(), which
* I'm not comfortable relying on JUST that.
* ~ Broc White
****************************************************************************************/


//Connect to the DB, and execute anything missing so no errors happen.
require('connectDB.php');
//Run this if no functions are to be called.
//This gets the list of users on every page
$stmt = $conn->prepare("SELECT ID,FirstName,LastName,Address,PhoneNumber,Email,Category FROM accounts");
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

//Double check which form was submitted before calling function
//Could technically call the function on form submission, but this is just an extra line of security tossed in the handler
if(isset($_POST["addUser"])) {
	addUser();
}
if(isset($_POST["editUser"])) {
	editUser();
}
if(isset($_POST["deleteUser"])) {
	deleteUser();
}
if(isset($_POST["viewUser"])) {
	viewUser();
}
if(isset($_POST["viewCategory"])) {
	viewCategory();
}
if(isset($_POST["login"])) {
	login();
}

//add user page
function addUser() {
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("INSERT INTO accounts (ID, FirstName, LastName, Address, PhoneNumber, Email, Category)
								VALUES ('', :firstName, :lastName, :address, :phoneNumber, :email, :category)");
		$stmt->bindParam(':firstName', $firstName);
		$stmt->bindParam(':lastName', $lastName);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':phoneNumber', $phoneNumber);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':category', $category);
	
		$firstName = stripslashes(htmlspecialchars($_POST["firstName"]));
		$lastName = stripslashes(htmlspecialchars($_POST["lastName"]));
		$address = stripslashes(htmlspecialchars($_POST["address"]));
		$phoneNumber = stripslashes(htmlspecialchars($_POST["phoneNumber"]));
		$email = stripslashes(htmlspecialchars($_POST["email"]));
		$category = stripslashes(htmlspecialchars($_POST["category"]));
		
		$stmt->execute();
		$_POST["addUser"] = NULL;
		header("Location: add.php?add=success");
	} catch(PDOException $e) {
		header("Location: add.php?add=failed");
	}
}
//edit user page
function editUser() {
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("UPDATE accounts 
								SET FirstName=:firstName, LastName=:lastName, Address=:address, PhoneNumber=:phoneNumber, Email=:email, Category=:category
								WHERE ID=:id");
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':firstName', $firstName);
		$stmt->bindParam(':lastName', $lastName);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':phoneNumber', $phoneNumber);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':category', $category);
	
		$id = stripslashes(htmlspecialchars($_POST["user"]));
		$firstName = stripslashes(htmlspecialchars($_POST["firstName"]));
		$lastName = stripslashes(htmlspecialchars($_POST["lastName"]));
		$address = stripslashes(htmlspecialchars($_POST["address"]));
		$phoneNumber = stripslashes(htmlspecialchars($_POST["phoneNumber"]));
		$email = stripslashes(htmlspecialchars($_POST["email"]));
		$category = stripslashes(htmlspecialchars($_POST["category"]));
		
		$stmt->execute();
		$_POST["editUser"] = NULL;
		header("Location: edit.php?edit=success");
	} catch(PDOException $e) {
		header("Location: edit.php?edit=failed");
	}
}
//delete user page
function deleteUser() { 
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("DELETE FROM accounts
								WHERE ID=:id");
		$stmt->bindParam(':id', $id);
	
		$id = stripslashes(htmlspecialchars($_POST["user"]));
		
		$stmt->execute();
		$_POST["deleteUser"] = NULL;
		header("Location: delete.php?delete=success");
	} catch(PDOException $e) {
		header("Location: delete.php?delete=failed");
	}
}
//view user page
function viewUser() { 
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM accounts
								WHERE ID=:id");
		$stmt->bindParam(':id', $id);
	
		$id = stripslashes(htmlspecialchars($_POST["user"]));
		
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetch();
		
		session_start();
		$_SESSION['userdata'] = $result;
		
		$_POST["viewUser"] = NULL;
		header("Location: view.php?view=true");
	} catch(PDOException $e) {
		header("Location: view.php?view=failed");
	}
}
function viewCategory() {
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM accounts
								WHERE Category=:category");
		$stmt->bindParam(':category', $category);
	
		$category = stripslashes(htmlspecialchars($_POST["category"]));
		
		$stmt->execute();
		
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetchAll();
		
		session_start();
		$_SESSION['userdata'] = $result;
		
		$_POST["viewUser"] = NULL;
		header("Location: view.php?category=true");
	} catch(PDOException $e) {
		header("Location: view.php?view=failed");
	}
}
//login page
function login() {
	try {
		global $conn;
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM admins
								WHERE UserName=:username AND Password=:password");
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $encryptedPassword);
	
		$username = stripslashes(htmlspecialchars($_POST["userName"]));
		$password = stripslashes(htmlspecialchars($_POST["password"]));
		$salt = '3213812321y3281372183712da';
		$encryptedPassword = md5($password) * $salt;
		
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt->fetch();
		
		$_POST["login"] = NULL;
		
		if ($encryptedPassword == $result['Password']) {
			session_start();
			$_SESSION['loginUser'] = $result['UserName'];
			$_SESSION['loginPassword'] = $result['Password'];
			header("Location: index.php?login=success");
		} else {
			header("Location: login.php?login=failed");
		}
	} catch(PDOException $e) {
		header("Location: login.php?login=failed");
	}
}
?>