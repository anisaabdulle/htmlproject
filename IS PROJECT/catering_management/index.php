<?php
require_once 'dbconnection.inc.php';
session_start();

if (!isset($_SESSION['adminname'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['adminname'];
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

  <title>Catering Management System - Administrator Homepage</title>
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
<body>
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

  <!-- contact section -->
<div id="my">
    <div class="container">
      <h2>
        List of Users
      </h2>
      <div class="row">
        <div class="col-md-12">
                                                          <table id="printTable">
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Fullname</th>
  <th style="text-align: left;
  padding: 8px;">Email Address</th>
 <th style="text-align: left;
  padding: 8px;">Phone Number</th>
  <th style="text-align: left;
  padding: 8px;">User Type</th>
   <th style="text-align: left; padding: 8px;"></th>
</tr>

<?php
$conn = mysqli_connect("localhost", "root", "", "catering");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT `user_id`, `fullname`, `email`, `phone_number`, `role` FROM `tbl_users`";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
?>
<tr>
<td><?php echo($row["fullname"]); ?></td>
<td><?php echo($row["email"]); ?></td>
<td><?php echo($row["phone_number"]); ?></td>
<td><?php echo($row["role"]); ?></td>
<td><button class="btn btn-primary py-3 px-5" onclick="return confirm('Are you sure that you want to delete this user?')?window.location.href='insertion.inc.php?action=deleteU&id=<?php echo($row["user_id"]); ?>':true;" title='Delete User'>Delete</button></td>
</tr>
<?php
}
} else { echo "No results"; }
$conn->close();
?>

</table>
<br>
<a onclick="printData();">Print</a>
      <br>
        </div>
      </div>
    </div>
    <section class="contact_section layout_padding-bottom ">
    <div class="container">
      <h2>
        Administrator Functions
      </h2>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="insertion.inc.php" method="POST">
              <input type="text" placeholder="Fullname" name="fname" required>
              <input type="hidden" value="2" name="mod" required>
              <input type="text" placeholder="Phone Number" name="phone" required>
              <input type="email" placeholder="Email Address" name="email" required>
              <br>
              <select name="type" required>
                                       <option value="" disabled selected>Select A User Type</option>
                           <option value="Administrator">Administrator</option>
                           <option value="Caterer">Caterer</option>
                           <option value="Delivery Personnel">Delivery Personnel</option>
                           <option value="User">User</option>                          
                        </select>
                        <br>
              <input type="password" placeholder="Password" name="password" required>
              <input type="password" placeholder="Confirm Password" name="cpassword" required>
              <button type="submit" name="regu">
                Register A User
              </button>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form_container">
            <form action="authentication.php" method="POST">
                            <input type="text" placeholder="Fullname" name="fname" required>
              <input type="hidden" value="1" name="mod" required>
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