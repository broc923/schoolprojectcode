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
$servername = "localhost";
$username = "mgs_user";
$password = "pa55word";
$dbname = "WhiteCustomerDatabase";
///THIS ASSUMES THE MGS_USER IS A USER, AND HAS FULL PERMS FOR EVERY DB. OTHERWISE EXECUTE INCLUDED SQL FILE "fix.sql"
try {
    $dbh = new PDO("mysql:host=$servername", $username, $password);
	
	$sql = "CREATE DATABASE IF NOT EXISTS WhiteCustomerDatabase";
	$dbh->exec($sql);
	
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$sql = "CREATE TABLE IF NOT EXISTS accounts (
				ID int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				FirstName varchar(50) NOT NULL,
				LastName varchar(50) NOT NULL,
				Address varchar(100) NOT NULL,
				PhoneNumber varchar(12) NOT NULL,
				Email varchar(80) NOT NULL,
				Category varchar(10) NOT NULL
			) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1";
	$conn->exec($sql);
	
	$sql2 = "CREATE TABLE IF NOT EXISTS admins (
				`ID` int(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				`UserName` text NOT NULL,
				`Password` text NOT NULL
			) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1";
	$conn->exec($sql2);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>