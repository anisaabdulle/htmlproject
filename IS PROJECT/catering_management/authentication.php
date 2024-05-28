<?php
require_once "dbconnection.inc.php";

session_start();

if(isset($_POST['login'])){

    $id = $_POST['email'];
    $password = $_POST['password'];   

         $sql = "SELECT * FROM `tbl_users` WHERE `email`='$id'";

        $query = mysqli_query($conn,$sql);

        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);

            $pass = $row['password'];
            $type = $row['role'];

if(md5($password) == $pass){

                if ($type == "Administrator") {
                $_SESSION['adminname'] = $row['user_id'];
                header("Location: index.php");
                }else if ($type == "Caterer") {
                $_SESSION['catname'] = $row['user_id'];
                header("Location: index1.php");
                }else if ($type == "Delivery Personnel") {
                $_SESSION['deliname'] = $row['user_id'];
                header("Location: index2.php");
                }else if ($type == "User") {
                $_SESSION['username'] = $row['user_id'];
                header("Location: index3.php");
                }
            }else{
                echo "Incorrect Password.";
            }
        }else{
            echo "User does not exist.";
        }
}
           
?>
