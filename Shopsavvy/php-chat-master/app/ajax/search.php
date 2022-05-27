<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['UserName'])) {
    # check if the key is submitted
    if(isset($_POST['key'])){
       # database connection file
	   include '../db.conn.php';

	   # creating simple search algorithm :) 
	   $key = "%{$_POST['key']}%";
     
	   $sql = "SELECT * FROM users
	           WHERE UserName
	           LIKE ? OR UserName LIKE ?";
       $stmt = $conn->prepare($sql);
       $stmt->execute([$key, $key]);

       if($stmt->rowCount() > 0){ 
         $users = $stmt->fetchAll();

         foreach ($users as $user) {

         	if ($user['UserID'] == $_SESSION['UserID']) continue;
       ?>

       <li class="list-group-item">
		<a href="chat.php?user=<?=$user['UserName']?>"
		   class="d-flex
		          justify-content-between
		          align-items-center p-2">
			<div class="d-flex
			            align-items-center">

			    
			    <h3 class="fs-xs m-2">
			    	<?=$user['UserName']?>
			    </h3>            	
			</div>
		 </a>
	   </li>
       <?php 
	} }else { ?>
         <div class="alert alert-info 
    				 text-center">
		   <i class="fa fa-user-times d-block fs-big"></i>
           The user "<?=htmlspecialchars($_POST['key'])?>"
           is  not found.
		</div>
    <?php }
    }

}else {
	header("Location: ../../index.php");
	exit;
}