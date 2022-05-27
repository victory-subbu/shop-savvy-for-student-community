<?php
include_once("includes/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirmation page</title>
    <link rel="stylesheet" href="style1.css">
    <!-- bootstrap cdn link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    
<?php
myaccount();
$ab=$_SESSION['varname1'];
$clink;
$resultuser1=mysqli_query($clink,"SELECT UserID,Email,Phone FROM users WHERE UserName='$ab'");
$rowuser1=mysqli_fetch_assoc($resultuser1);
$bb=$rowuser1['Email'];
$cc=$rowuser1['Phone'];
?>


<?php
$AdsID = $_SESSION['varname5'];
$clink;
$resultuser2=mysqli_query($clink,"SELECT * FROM advertisments WHERE AdsID=$AdsID");
$rowuser2=mysqli_fetch_assoc($resultuser2);
$bd=$rowuser2['Title'];
$bf=$rowuser2['Price'];




?>



    <?php
$UserID = $_SESSION['varname'];
$clink;
$resultuser=mysqli_query($clink,"SELECT UserName,Email,Phone,areaID FROM users WHERE UserID=$UserID");
$rowuser=mysqli_fetch_assoc($resultuser);
$b=$rowuser['Email'];
$k=$rowuser['UserName'];





?>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 mail-form">
                <h2 class="text-center">Confirmation Page</h2>
                <!-- starting php code -->
                <?php
                    //first we leave this input field blank
                    $recipient = "";
                    //if user click the send button
                    if(isset($_POST['send'])){
                        //access user entered data
                       $recipient = $_POST['email'];
                       $subject = $_POST['subject'];
                       $message = $_POST['message'];
                       $sender = "From: savvyshop79@gmail.com";
                       //if user leave empty field among one of them
                       if(empty($recipient) || empty($subject) || empty($message)){
                           ?>
                           <!-- display an alert message if one of them field is empty -->
                            <div class="alert alert-danger text-center">
                                <?php echo "All inputs are required!" ?>
                            </div>
                           <?php
                        }else{
                            // PHP function to send mail
                           if(mail($recipient, $subject, $message, $sender)){
                            ?>
                            <!-- display a success message if once mail sent sucessfully -->
                            <div class="alert alert-success text-center">
                      
                                <a href="proceed.html">Your details successfully sent</a>
                            </div>
                           <?php
                           $recipient = "";
                           }else{
                            ?>
                            <!-- display an alert message if somehow mail can't be sent -->
                            <div class="alert alert-danger text-center">
                                <?php echo "Failed while sending your mail!" ?>
                            </div>
                           <?php
                           }
                       }
                    }
                ?> <!-- end of php code -->
                <form action="mail.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" name="email" type="email" placeholder="Enter Seller mail address" value="<?php echo $b ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="subject" type="text" placeholder="Thanks for the order confirmation" value="Thanks for the order confirmation">
                    </div>
                    <div class="form-group">
                        <textarea cols="30" rows="5" class="form-control textarea" name="message"  >Hello <?php echo $k ?> ,from shop savvy.
                        <br>
                        Product Details:
                         Product Name:<?php echo $bd ?>
                         Product Id:<?php echo $AdsID ?>
                        <br>


                        
                        Here are the details of buyer:
                        Buyer Name:<?php echo $ab ?>
                        Buyer email id:<?php echo $bb ?>
                        Buyer Phone:<?php echo $cc ?>
                    
                    
                    </textarea>
                    </div>
                    <div class="form-group">
                        <input class="form-control button btn-primary" type="submit" name="send" value="Send" placeholder="Subject">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>