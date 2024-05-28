<?php 
require_once 'dbconnection.inc.php';
session_start();

// Include the configuration file 
require_once 'config.php'; 

// Initialize shopping cart class 
include_once 'cart.class.php'; 
$cart = new Cart; 

if (!isset($_SESSION['username'])) {
    header("Location: index.html");
}else{
  $filter = $_SESSION['username'];
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

  <title>Catering Management System - User Homepage - View Cart</title>
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

  <script>
function updateCartItem(obj,id){
    $.get("cartAction.php", {action:"updateCartItem", id:id, qty:obj.value}, function(data){
        if(data == 'ok'){
            location.reload();
        }else{
            alert('Cart update failed, please try again.');
        }
    });
}
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
                <a href="index3.php">HOME</a>
                <a href="#about">ABOUT</a>
                <a href="index3.php">MY MODULE</a>                
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
                <a href="index3.php" class="btn-1">
                  My Module
                </a>
                <a href="viewcart.php" class="btn-2">
                View Orders (<?php echo ($cart->total_items() > 0)?$cart->total_items().'':0; ?>)
                </a>
              </div>
            <br>
            <br>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>

  <!-- contact section -->
<div id="my">
  <section class="contact_section layout_padding-bottom ">
    <div class="container">
      <h2>
        View My Orders
      </h2>
      <div class="row">
        <div class="col-md-12">
                       <table id="printTable">
            <thead>
<tr style="text-align: left;
  padding: 8px;">
<th style="text-align: left;
  padding: 8px;">Picture</th>
<th style="text-align: left;
  padding: 8px;">Name</th>
    <th style="text-align: left;
  padding: 8px;">Individual Price</th>
  <th style="text-align: left;
  padding: 8px;">Quantity</th>
  <th style="text-align: left;
  padding: 8px;">Total Price</th>  
  <th style="text-align: left;
  padding: 8px;"></th>
</tr>
</thead>
 <tbody>
                        <?php 
                        if($cart->total_items() > 0){ 
                            // Get order items from session 
                            $cartItems = $cart->contents(); 
                            foreach($cartItems as $item){ 
               $proImg = !empty($item["image"])?'images/'.$item["image"]:'images/demo-img.png'; 
               ?>
                            <tr>
                                <td><img style="width: 150px;" src="<?php echo $proImg; ?>" alt="..."></td>
                                <td><?php echo $item["name"]; ?></td>
                                <td><?php echo CURRENCY_SYMBOL.$item["price"].' '.CURRENCY; ?></td>
                                <td><input class="form-control" type="number" value="<?php echo $item["qty"]; ?>" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')"/></td>
                                <td><?php echo CURRENCY_SYMBOL.$item["subtotal"].' '.CURRENCY; ?></td>
                                <td><button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to remove this order?')?window.location.href='cartaction.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>':false;" title="Remove Item"><i class="itrash"></i>Remove Order </button> </td>
                            </tr>
                        <?php } }else{ ?>
                            <tr><td colspan="6"><p>No orders.....</p></td>
                        <?php } ?>
                        <?php if($cart->total_items() > 0){ ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Order Total:</strong></td>
                                <td><strong><?php echo CURRENCY_SYMBOL.$cart->total().' '.CURRENCY; ?></strong></td>
                                <td></td>
                            </tr>
                        <?php } ?>
                        </tbody>

</table>
                                   <br>
                                   <br>
                                               <div class="col mb-2">
                <div class="row">
                    <div class="col-sm-12  col-md-6">
                        <a href="index3.php" class="btn btn-block btn-secondary"><i class="ialeft"></i>Continue Ordering</a>
                    </div>
                    <div class="col-sm-12 col-md-6 text-right">
                        <?php if($cart->total_items() > 0){ ?>
                        <a href="checkout.php" class="btn btn-block btn-primary">Go to Checkout<i class="iaright"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
      <br>
      <br>
        </div>
      </div>
    </div>
  </tr>
</tbody>
</table>
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