<?php 

session_start();

//Register User
if (isset($_POST['regu'])) {
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];
 $phone = $_POST['phone'];
 $mod = $_POST['mod'];
 $type = $_POST['type'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
  if ($mod == 1) {
  $sql = "INSERT INTO `tbl_users`(`fullname`, `email`, `phone_number`, `password`, `role`) VALUES ('$fname','$email','$phone',md5('$password') , 'User')";
     mysqli_query($conn, $sql);
  header("Location: login.html?userregistration=success");
  }else{
   $sql = "INSERT INTO `tbl_users`(`fullname`, `email`, `phone_number`, `password`, `role`) VALUES ('$fname','$email','$phone', md5('$password'), '$type')";
     mysqli_query($conn, $sql);
  header("Location: index.php?userregistration=success");
 }
}else{
  echo "Passwords do not match.";
 }
}

//Update User
if (isset($_POST['upu'])) {
 $fname = $_POST['fname'];
 $email = $_POST['email'];
 $uid = $_POST['uid'];
 $phone = $_POST['phone'];
 $password = $_POST['password'];
 $passwordconfirm = $_POST['cpassword'];

 require_once 'dbconnection.inc.php';

 if ($password == $passwordconfirm) {
  if ($mod == 1) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index.php?updateadministrator=success");
  }else if ($mod == 2) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index1.php?updatecaterer=success");
  }else if ($mod == 3) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index2.php?updatedeliverypersonell=success");
  }else if ($mod == 4) {
  $sql = "UPDATE `users` SET `Fullname`='$fname',`Email_Address`='$email',`Phone_Number`='$phone',`Password`=md5('$password') WHERE `User_ID`='$uid'";
     mysqli_query($conn, $sql);
  header("Location: index3.php?updateuser=success");
  }
 }else{
  echo "Passwords do not match.";
 }
}

//Delete Functions

        if($_REQUEST['action'] == 'deleteU' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `tbl_users` WHERE `User_ID` = '$deleteItem'";
        mysqli_query($conn, $sql);         
        header("Location: index.php?deleteuser=success");
        }

        if($_REQUEST['action'] == 'deleteF' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $sql = "DELETE FROM `tbl_food` WHERE `food_id` = '$deleteItem'";
        mysqli_query($conn, $sql);       
        header("Location: index1.php?deletefood=success");
        }

        if($_REQUEST['action'] == 'deleteO' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $deleteItem = $_REQUEST['id'];
        $uid = $_SESSION['username'];         
        $sql2 = "SELECT `tbl_orderdetails`.`food_id`, `tbl_order`.`order_id` FROM `tbl_orderdetails` JOIN `tbl_order` ON `tbl_orderdetails`.`order_id` = `tbl_order`.`order_id` WHERE `tbl_orderdetails`.`order_id`='$deleteItem' AND `tbl_order`.`customer_id` = '$uid'";
        $query = mysqli_query($conn, $sql2);
        if(mysqli_num_rows($query) > 0){
        while($row = $query->fetch_assoc()){
        $sql3 = "DELETE FROM `tbl_food` WHERE `food_id` = " . $row['food_id'] . " AND `user_id` = '$uid'";
        mysqli_query($conn, $sql3);           
        }
        $sql = "DELETE FROM `tbl_order` WHERE `order_id` = '$deleteItem'";
        mysqli_query($conn, $sql);  
        $sql1 = "DELETE FROM `tbl_orderdetails` WHERE `order_id` = '$deleteItem'";
        mysqli_query($conn, $sql1);  
        header("Location: index3.php?deleteorder=success");
        }
        } 

        //Update Functions

        if($_REQUEST['action'] == 'updateO' && !empty($_REQUEST['id']) && !empty($_REQUEST['id1'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $status = $_REQUEST['id1']; 
        $sid = $_SESSION['deliname'];
        if ($status == "Pending") {
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Accepted' WHERE `order_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index1.php?acceptOrder=success");        
        }else if ($status == "Accepted") {
        $sql = "UPDATE `tbl_order` SET `order_status` = 'On Route', `delivery_id` = '$sid' WHERE `order_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index2.php?transportOrder=success"); 
        //var_dump($sql);       
        }else if ($status == "On Route") {
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Delivered' WHERE `order_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index2.php?deliverOrder=success");        
        }else if ($status == "Delivered") {
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Completed' WHERE `order_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index1.php?orderCompleted=success");        
        }else{
          echo "<script>alert('Order needs to be accepted first!');</script>";
        }        
        }  

        if($_REQUEST['action'] == 'cancelO' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $sql = "UPDATE `tbl_order` SET `order_status` = 'Cancelled' WHERE `order_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index1.php?cancelOrder=success");
        } 

        if(isset($_POST['updateF'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_POST['id'];
        $quan = $_POST['quan'];
        $sql = "UPDATE `tbl_food` SET `quantity` = `quantity` + '$quan' WHERE `food_id` = '$updateItem'";
        mysqli_query($conn, $sql);         
        header("Location: index1.php?updateFoodQuantity=success");
        }

        if($_REQUEST['action'] == 'goC' && !empty($_REQUEST['id'])){ 
        require_once 'dbconnection.inc.php';
        $updateItem = $_REQUEST['id'];
        $_SESSION['filter'] = $updateItem;      
        header("Location: index3_menu.php?findCuisine=success");
        }              

 ?>