<?php  

function getUser($UserName, $conn){
   $sql = "SELECT * FROM users 
           WHERE UserName=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$UserName]);

   if ($stmt->rowCount() === 1) {
   	 $user = $stmt->fetch();
   	 return $user;
   }else {
   	$user = [];
   	return $user;
   }
}