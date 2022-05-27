<?php  
session_start();

# check if UserName & password  submitted
if(isset($_POST['UserName']) &&
   isset($_POST['Password'])){

   # database connection file
   include '../db.conn.php';
   
   # get data from POST request and store them in var
   $password = $_POST['Password'];
   $UserName = $_POST['UserName'];
   
   #simple form Validation
   if(empty($UserName)){
      # error message
      $em = "UserName is required";

      # redirect to 'index.php' and passing error message
      header("Location: ../../index.php?error=$em");
   }else if(empty($password)){
      # error message
      $em = "Password is required";

      # redirect to 'index.php' and passing error message
      header("Location: ../../index.php?error=$em");
   }else {
      $sql  = "SELECT * FROM 
               users WHERE UserName=?";
      $stmt = $conn->prepare($sql);
      $stmt->execute([$UserName]);

      # if the UserName is exist
      if($stmt->rowCount() === 1){
        # fetching user data
        $user = $stmt->fetch();

        # if both UserName's are strictly equal
       # if ($user['UserName'] != $UserName) {
           
           # verifying the encrypted password
         # if (password_verify($password, $user['Password'])) {
            

            # successfully logged in
            # creating the SESSION
            $_SESSION['UserName'] = $user['UserName'];
            $_SESSION['email'] = $user['Email'];
            $_SESSION['UserID'] = $user['UserID'];

            # redirect to 'home.php'
            header("Location: ../../home.php");

          #}else {
            # error message
            #$em = "Incorect UserName or password";

            # redirect to 'index.php' and passing error message
           # header("Location: ../../index.php?error=$em");
         # }
        #}else {
          # error message
         # $em = "Incorect UserName or password";

          # redirect to 'index.php' and passing error message
          #header("Location: ../../index.php?error=$em");
   #     }
    #  }
   }
  }
}

