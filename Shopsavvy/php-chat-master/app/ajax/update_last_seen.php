<?php  

session_start();

# check if the user is logged in
if (isset($_SESSION['UserName'])) {
	
	# database connection file
	include '../db.conn.php';

	# get the logged in user's username from SESSION
	$id = $_SESSION['UserID'];

	$sql = "UPDATE users
	        SET last_seen = NOW() 
	        WHERE UserID = ?";
	$stmt = $conn->prepare($sql);
	$stmt->execute([$id]);

}else {
	header("Location: ../../index.php");
	exit;
}