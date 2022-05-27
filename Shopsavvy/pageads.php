<?php
include_once("includes/functions.php");



?>
<!DOCTYPE html>
<head>
<title>links</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/pageads.css"/>

<style>
.a{
    text=align:center;
}


</style>
<script>

    function getareas(cid){
        $(document).ready(function(){
            $.get("getAreas.php?cid="+cid, function(data, status){
                $("#areaDiv").html(data);
            });
        });
    }

</script>
</head>
<body>

<?php
drawHeader();

?>

<section class="ads">
        <?php
        // get id ads to get information ads
        $AdsID = $_GET['ADS-ID'];
        $clink;
        $resultADS=mysqli_query($clink,"SELECT AdsID,Date,Details,Price,Image,Status,Title,CategoryID,UserID FROM advertisments WHERE AdsID=$AdsID");
        $rowADS=mysqli_fetch_assoc($resultADS);
        $UserID = $rowADS['UserID'];
        // admin only can to visit this page
        if ($rowADS['Status'] == 0 && isLogged() !== 2 ){
            header('location:index.php');
        }
        ######################### get information user by UserID owner ADS
        $resultuser=mysqli_query($clink,"SELECT UserName,Email,Phone,areaID FROM users WHERE UserID=$UserID");
        $rowuser=mysqli_fetch_assoc($resultuser);
        ######################### get name area  by areasID
        $areaID = $rowuser['areaID']; 
        $resultareas=mysqli_query($clink,"SELECT areaName,cityID FROM areas WHERE areaID=$areaID");
        $rowareas=mysqli_fetch_assoc($resultareas);
        ######################### get name city by cityID
        $cityID = $rowareas['cityID']; 
        $resultcity=mysqli_query($clink,"SELECT cityName FROM cities WHERE cityID=$cityID");
        $rowcity=mysqli_fetch_assoc($resultcity);
        ####################################################################################
        ########################## get name categories ID
        $CategoryID = $rowADS['CategoryID'];
        $resultCategory=mysqli_query($clink,"SELECT CategoryName FROM categories WHERE CategoryID=$CategoryID");
        $rowCategory=mysqli_fetch_assoc($resultCategory);
        #############################################################################  get name report user ID
        $AdsID ; 
        $resultreport=mysqli_query($clink,"SELECT UserID FROM report WHERE AdsID=$AdsID");
        $rowreport=mysqli_fetch_assoc($resultreport);
        ?>
        <div class="container">
            <hr>
                
            <div class="card">
                    <div class="row">
                        <aside class="col-sm-5 border-right">
                            <div class="text-center "> <a href="#"><img src='assets/img/<?php echo $rowADS['Image'];?>'></a></div>
                            <hr>
                            <div class=" pl-5">
                                <dl class="param param-feature">
                                    <dt>user name</dt>
                                    <dd><?php echo $rowuser['UserName'];?></dd>
                                </dl>  <!-- item-property-hor .// -->
                                <dl class="param param-feature">
                                    <dt>Email </dt>
                                    <dd><?php echo $rowuser['Email'];?></dd>
                                </dl>  <!-- item-property-hor .// -->
                                <dl class="param param-feature">
                                    <dt>phone</dt>
                                    <dd><?php echo $rowuser['Phone'];?></dd>
                            </dl>  <!-- item-property-hor .// -->
                            </dl>  <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>Collegename,Branch</dt>
                                <dd><?php echo $rowcity['cityName'] ." , ".$rowareas['areaName'];?></dd>
                            </dl>  <!-- item-property-hor .// -->
                            </div> <!-- card-body.// -->
                        </aside>
                        <aside class="col-sm-7">
                            <article class="card-body p-5">
                                <h3 class="title mb-3"><?php echo $rowADS['Title'];?></h3>
                            <dl class="item-property">
                                <dt>Description</dt>
                                    <dd><p><?php echo $rowADS['Details'];?></p></dd>
                            </dl>
                            <dl class="param param-feature">
                                <dt>price</dt>
                                <dd><?php echo $rowADS['Price'];?></dd>
                            <dl class="param param-feature">
                                <dt>date</dt>
                                <dd><?php echo $rowADS['Date'];?></dd>
                            </dl>  <!-- item-property-hor .// -->
                            <dl class="param param-feature">
                                <dt>category</dt>
                                <dd><?php echo $rowCategory['CategoryName'];?></dd>
                            </dl>  <!-- item-property-hor .// -->
                            <hr>
                            <br>
                            <br>
                            <div class="container">
                                <div class="row">
                            <div><button type="button" class="btn btn-light"><a href="uichat.html">Messenger</a></button></div>
                            <div class="col-3"></div>
                            <?php
                            $_SESSION['varname'] = $UserID;
                           
                            
                            ?>
                            <?php
                              $_SESSION['varname5'] = $AdsID;

                            ?>
                            <form action="mail.php" method="POST"> 
                            
           <button class="btn btn-success">
        <input  type="hidden" name="x"> Confirm
      </button>
   </form>`
    </div>
                           </div>

                        
                           
                          








                        
                                 <?php 

                                if (isLogged() == 1 ){
                                    if(isset($_SESSION['loggedInUserId']) AND $_SESSION['loggedInUserId'] !== $rowADS['UserID']) {
                                        echo '<a href="" class="btn btn-lg btn-danger text-uppercase float-right" data-toggle="modal" data-target="#myModal2">Report</a>';
                                    }
                                    echo "
                                    <div class='modal' id='myModal2'>
                                            <div class='modal-dialog'>
                                                <div class='modal-content LogIn'>
                                                    <div class='modal-header'>
                                                        <h4 class='modal-title'>Comments</h4>
                                                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                                                    </div>
                                                    <div class='modal-body'>
                                                        <div class='col-12 float-left'>
                                                            <form action='Report.php' method='POST'>
                                                                <div class='form-group'>
                                                                    <textarea placeholder='Detalis' name='Detalis' id='my-input' class='form-control ' rows='5'></textarea>
                                                                    <input type='hidden' name='AdsID' value='$AdsID'>
                                                                </div>
                                                                <button type='submit' class='btn btn-lg btn-danger text-uppercase float-right'>send</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>";
                                }
                            else{
                                echo "";
                            }?>
                                <?php 
                                if ($rowADS['Status'] == 1 &&(isLogged() == 2) ){
                                    echo "<br><a href='adsshoworhide.php?ADS-ID={$AdsID}' class='btn btn-danger mt-2 float-right' >Hide<a>";
                                }else if  ($rowADS['Status'] == 0 &&(isLogged() == 2) ) {
                                    echo "<br><a href='adsshoworhide.php?ADS-ID={$AdsID}' class='btn btn-primary mt-2 ' >Show<a>";

                                }
                                ?>
                            </article> <!-- card-body.// -->
                    </aside> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- card.// -->
        </div>
            <!--container.//-->
            <div class="container">
            <div  style=”background-color:#00F3FF” class="jumbotron">
                <h2 class="text-center">Recommendations</h2>
                <div class="row ">
        <?php 
                    //Get DB products and display them
            
                    $a=$rowareas['areaName'];
                        $result1 = mysqli_query($clink, "SELECT * FROM `advertisments` ORDER BY `advertisments`.`Price` ASC  ");

                        $result = mysqli_query($clink, "SELECT * FROM `advertisments` where UserID in (select UserId from users where areaID
                        in (select areaID from areas where areaName='$a'))");


                                  
                       

                    if(mysqli_num_rows($result)>0){
						//Show them

						while($row = mysqli_fetch_assoc($result)){
							if($row['Status'] == 1 || isLogged() == 2 ) {
                            echo "<div class='col-md-4 col-sm-6 '>
                            <div class='card ' > 
                            <img class='' src='assets/img/{$row['Image']}' class='card-img-top' alt='...'>
                            <span class='float-left'> Rs : {$row['Price']}</span>
                                <div class='card-body'>
                                <h5 class='card-title'>{$row['Title']}</h5>
                                <p class='card-text'>{$row['Details']}</p>
                                <a href='pageads.php?ADS-ID={$row['AdsID']}' class='btn btn-primary '>More Details</a>"; 
                                if ($row['Status'] == 1 &&(isLogged() == 2) ){
                                    echo "<a href='adsshoworhide.php?ADS-ID={$row['AdsID']}' class='btn btn-danger ml-2 ' >Hide</a>";
                                }else if  ($row['Status'] == 0 &&(isLogged() == 2) ) {
                                    echo "<a href='adsshoworhide.php?ADS-ID={$row['AdsID']}' class='btn btn-primary ml-2  ' >Show</a>";

                                }
                                echo" </div> </div></div>";
                            }
                        }
						}else{
						outputMessage("No products found in our catalog",'warning');
					}
				?>
            </div>    
            </div>



</section>


<script type="text/javascript" src="assets/js/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>