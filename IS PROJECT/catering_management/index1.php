<?php
require_once 'dbconnection.inc.php';
session_start();

if (!isset($_SESSION['catname'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['catname'];
  $query=mysqli_query($conn,"SELECT * FROM `tbl_users` WHERE `user_id`='$filter'")or die(mysqli_error());
  $row=mysqli_fetch_array($query);
}
?>

<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Catering Management System - Caterer Homepage</title>
  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700|Poppins:400,700|Raleway:400,700&display=swap"
    rel="stylesheet" />

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>
          <style type="text/css">
        
          table{
    align-items: center;
  }

   th, tr, td{
    padding: 10px 10px;
  }
    </style>

<script type="text/javascript">
  
function hide() {
  document.getElementById("rep").style.display = "none";
}

</script>

            <script type="text/javascript">
function printData()
{
   var divToPrint=document.getElementById("printTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

            <script type="text/javascript">
function printData1()
{
   var divToPrint=document.getElementById("printTable1");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

            <script type="text/javascript">
function printData2()
{
   var divToPrint=document.getElementById("printTable2");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}

$('button').on('click',function(){
printData();
})  
</script>

            <script type="text/javascript">
function genRep()
{
    document.getElementById("rep").style.display = "block";
   var divToPrint=document.getElementById("rep");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
     document.getElementById("rep").style.display = "none";
}

$('button').on('click',function(){
genRep();
})  
</script>
<body onload="hide();">
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container">
          <div class="navbar-collapse" id="">
            <div class="custom_menu-btn">
              <button onclick="openNav()">
                <span class="s-1"> </span>
                <span class="s-2"> </span>
                <span class="s-3"> </span>
              </button>
            </div>
            <div id="myNav" class="overlay">
              <div class="overlay-content">
                <a href="#">HOME</a>
                <a href="#about">ABOUT</a>
                <a href="#my">MY MODULE</a>                
                <a href="logout.php">LOGOUT</a>
                <a href="#contact">CONTACT US</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
            <div class="side_heading">
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-md-4 offset-md-1">
            <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active">
                  01
                </li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1">
                  02
                </li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2">
                  03
                </li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3">
                  04
                </li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <div class="img-box b-1">
                    <img src="images/slider-img.png" alt="" />
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box b-2">
                    <img src="images/hot-1.png" alt="" />
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box b-3">
                    <img src="images/hot-2.png" alt="" />
                  </div>
                </div>
                <div class="carousel-item">
                  <div class="img-box b-4">
                    <img src="images/hot-3.png" alt="" />
                  </div>
                </div>
              </div>
              <div class="carousel_btn-box">
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class=" col-md-5 offset-md-1">
            <div class="detail-box">
              <h1>
                Catering<br>
                Management
              </h1>
              <p>
                Welcome <?php echo $row['role']; ?>, <?php echo $row['fullname']; ?>!
              </p>

              <div class="btn-box">
                <a href="#my" class="btn-1">
                  My Module
                </a>
                <a href="logout.php" class="btn-2">
                  Logout
                </a>
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- about section -->
  <section class="about_section" id="about">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5 offset-md-1">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Catering <br>
               Management
              </h2>
              <hr>
            </div>
            <p>
             We believe that great food is at the heart of every celebration, and our commitment to quality and creativity shines through in every dish we prepare. Let us be your culinary partner, ensuring that your event is not only remembered for its ambiance but also cherished for its delectable flavors.
            </p>
          </div>
        </div>
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src="images/about-img.jpg" alt="">
                        <br>
            <br>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

<!-- report section -->
<div id="rep">
    <div class="container">
      <h2>
        List of Orders
      </h2>
      <div class="row">
        <div class="col-md-12">
<table id="printTable1">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Order ID</th>
<th style="text-align: left;
  padding: 8px;">Customer Name</th>  
  <th style="text-align: left;
  padding: 8px;">Total Price</th>
 <th style="text-align: left;
  padding: 8px;">Payment Method</th>
  <th style="text-align: left;
  padding: 8px;">Status</th>
  <th style="text-align: left;
  padding: 8px;">Order Type</th>  
 <th style="text-align: left;
  padding: 8px;">Location</th>
 <th style="text-align: left;
  padding: 8px;">No. of People</th>  
  <th style="text-align: left;
  padding: 8px;">Custom Instructions</th>       
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "catering");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `tbl_order`.`order_id`, `tbl_order`.`order_total`, `tbl_order`.`payment_method`, `tbl_order`.`type`, `tbl_order`.`no_of_people`, `tbl_order`.`order_status`, `tbl_order`.`Location`, `tbl_order`.`Custom`, `tbl_users`.`fullname` FROM `tbl_order` JOIN `tbl_users` ON `tbl_order`.`customer_id` = `tbl_users`.`user_id`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["order_id"]); ?></td>
<td><?php echo($row["fullname"]); ?></td>
<td><?php echo($row["order_total"]); ?> in kshs.</td>
<td><?php echo($row["payment_method"]); ?></td>
<td><?php echo($row["order_status"]); ?></td>
<td><?php echo($row["type"]); ?></td>
<td><?php echo($row["Location"]); ?></td>
<td><?php echo($row["no_of_people"]); ?></td>
<td><?php echo($row["Custom"]); ?></td>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
<br>
<br>
        </div>
      </div>
    </div>
            <div class="container">
      <h2>
        List of Order Details
      </h2>
      <div class="row">
        <div class="col-md-12">
<table id="printTable2">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Food Name</th>
<th style="text-align: left;
  padding: 8px;">Image</th> 
<th style="text-align: left;
  padding: 8px;">Ingredients</th>    
  <th style="text-align: left;
  padding: 8px;">Price</th>
  <th style="text-align: left;
  padding: 8px;">Cuisine</th>  
 <th style="text-align: left;
  padding: 8px;">Order ID</th>
  <th style="text-align: left;
  padding: 8px;">Quantity</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "catering");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `tbl_orderdetails`.`food_name`, `tbl_orderdetails`.`price`, `tbl_orderdetails`.`quantity`, `tbl_orderdetails`.`order_id`, `tbl_food`.`food_id`, `tbl_food`.`food_image`, `tbl_food`.`ingredients`, `tbl_food`.`cuisine` FROM `tbl_orderdetails` JOIN `tbl_food` ON `tbl_food`.`food_id` = `tbl_orderdetails`.`food_id`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["food_name"]); ?></td>
<td><img src="images/<?php echo($row["food_image"]); ?>" title="<?php echo($row["food_name"]); ?>" style="width: 200px;"></td>
<td><?php echo($row["ingredients"]); ?></td>
<td><?php echo($row["price"]); ?> in kshs.</td>
<td><?php echo($row["cuisine"]); ?></td>
<td><?php echo($row["order_id"]); ?></td>
<td><?php echo($row["quantity"]); ?> Ordered</td>
</tr>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
        </div>
      </div>
    </div>
  </div>

<!-- end report section -->

  <!-- contact section -->
<div id="my">
    <div class="container">
      <h2>
        List of Orders
      </h2>
      <div class="row">
        <div class="col-md-12">
<table id="printTable1">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Order ID</th>
  <th style="text-align: left;
  padding: 8px;">Total Price</th>
 <th style="text-align: left;
  padding: 8px;">Payment Method</th>
  <th style="text-align: left;
  padding: 8px;">Status</th>
  <th style="text-align: left;
  padding: 8px;">Order Type</th>  
 <th style="text-align: left;
  padding: 8px;">Location</th>
 <th style="text-align: left;
  padding: 8px;">No. of People</th>  
  <th style="text-align: left;
  padding: 8px;">Custom Instructions</th>  
   <th style="text-align: left; padding: 8px;"></th>
   <th style="text-align: left; padding: 8px;"></th>
   <th style="text-align: left; padding: 8px;"></th>      
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "catering");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `order_id`, `order_total`, `payment_method`, `type`, `no_of_people`, `order_status`, `Location`, `Custom` FROM `tbl_order`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["order_id"]); ?></td>
<td><?php echo($row["order_total"]); ?> in kshs.</td>
<td><?php echo($row["payment_method"]); ?></td>
<td><?php echo($row["order_status"]); ?></td>
<td><?php echo($row["type"]); ?></td>
<td><?php echo($row["Location"]); ?></td>
<td><?php echo($row["no_of_people"]); ?></td>
<td><?php echo($row["Custom"]); ?></td>
<?php 
if ($row["order_status"] == "Pending") {
  ?>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to accept this order?')?window.location.href='insertion.inc.php?action=updateO&id=<?php echo($row["order_id"]); ?>&id1=<?php echo($row["order_status"]); ?>':true;" title='Accept Order'>Accept</button></td>
<?php
}else if ($row["order_status"] == "Accepted") {
  ?>
<?php
}else if ($row["order_status"] == "On Route") {
  ?>
<?php
}else if ($row["order_status"] == "Delivered") {
  ?>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to complete this order?')?window.location.href='insertion.inc.php?action=updateO&id=<?php echo($row["order_id"]); ?>&id1=<?php echo($row["order_status"]); ?>':true;" title='Complete Order'>Complete</button></td>
<?php
}else{}
?>
<?php 
if ($row["order_status"] == "Pending") {
  ?>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to cancel this order?')?window.location.href='insertion.inc.php?action=cancelO&id=<?php echo($row["order_id"]); ?>':true;" title='Cancel Order'>Cancel</button></td>
<?php
}else{}
?>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
<br>
<a onclick="printData1();">Print</a>
      <br>
      <br>
        </div>
      </div>
    </div>
        <div class="container">
      <h2>
        List of Order Details
      </h2>
      <div class="row">
        <div class="col-md-12">
<table id="printTable2">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Food Name</th>
<th style="text-align: left;
  padding: 8px;">Image</th> 
<th style="text-align: left;
  padding: 8px;">Ingredients</th>    
  <th style="text-align: left;
  padding: 8px;">Price</th>
  <th style="text-align: left;
  padding: 8px;">Cuisine</th>  
 <th style="text-align: left;
  padding: 8px;">Order ID</th>
  <th style="text-align: left;
  padding: 8px;">Quantity</th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "catering");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `tbl_orderdetails`.`food_name`, `tbl_orderdetails`.`price`, `tbl_orderdetails`.`quantity`, `tbl_orderdetails`.`order_id`, `tbl_food`.`food_id`, `tbl_food`.`food_image`, `tbl_food`.`ingredients`, `tbl_food`.`cuisine` FROM `tbl_orderdetails` JOIN `tbl_food` ON `tbl_food`.`food_id` = `tbl_orderdetails`.`food_id`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["food_name"]); ?></td>
<td><img src="images/<?php echo($row["food_image"]); ?>" title="<?php echo($row["food_name"]); ?>" style="width: 200px;"></td>
<td><?php echo($row["ingredients"]); ?></td>
<td><?php echo($row["price"]); ?> in kshs.</td>
<td><?php echo($row["cuisine"]); ?></td>
<td><?php echo($row["order_id"]); ?></td>
<td><?php echo($row["quantity"]); ?> Ordered</td>
</tr>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
<br>
<a onclick="printData2();">Print</a>
      <br>
      <br>
        </div>
      </div>
    </div>
    <section class="contact_section layout_padding-bottom ">
    <div class="container">
      <h2>
        Caterer Functions
      </h2>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="authentication.php" method="POST">
                            <input type="text" placeholder="Fullname" name="fname" required>
              <input type="hidden" value="2" name="mod" required>
              <input type="hidden" value="<?php echo $filter; ?>" required name="uid">
              <input type="text" placeholder="Phone Number" name="phone" required>
              <input type="email" placeholder="Email Address" name="email" required>
              <input type="password" placeholder="Password" name="password" required>
              <input type="password" placeholder="Confirm Password" name="cpassword" required>
              <button name="upu" type="submit">
                Update My Details
              </button>
            </form>
          </div>
        </div>
                <div class="col-md-6">
          <div class="form_container">
              <button name="" onclick="genRep();" type="submit">
                Generate Report of Orders and Customers
              </button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<section class="contact_section layout_padding-bottom ">
        <div class="container" id="contact">
      <h2>
        Contact Us
      </h2>
      <div class="row">
        <div class="col-md-12">
          <div class="contact_box">
            <a href="">
              <div class="img-box">
                <img src="images/location.png" alt="">
              </div>
              <h6>
                Nairobi, KENYA.
              </h6>
            </a>
            <a href="">
              <div class="img-box">
                <img src="images/call.png" alt="">
              </div>
              <h6>
                (+254) 712 345678
              </h6>
            </a>
            <a href="">
              <div class="img-box">
                <img src="images/envelope.png" alt="">
              </div>
              <h6>
                catering_management@gmail.com
              </h6>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->


  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2023 All Rights Reserved. 
    </p>
  </section>
  <!-- footer section -->

  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>

  <script>
    function openNav() {
      document.getElementById("myNav").classList.toggle("menu_width");
      document
        .querySelector(".custom_menu-btn")
        .classList.toggle("menu_btn-style");
    }
  </script>

  <!-- owl carousel script -->
  <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop: true,
      margin: 35,
      navText: [],
      autoplay: true,
      autoplayHoverPause: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 2
        },
        1000: {
          items: 3
        }
      }
    });
  </script>
  <!-- end owl carousel script -->

</body>

</html>