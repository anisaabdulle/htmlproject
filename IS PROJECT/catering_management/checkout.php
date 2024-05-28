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
// If the cart is empty, redirect to the products page 
if($cart->total_items() <= 0){ 
    header("Location: index3.php"); 
} 
 
// Get posted form data from session 
$postData = !empty($_SESSION['postData'])?$_SESSION['postData']:array(); 
unset($_SESSION['postData']); 
 
// Get status message from session 
$sessData = !empty($_SESSION['sessData'])?$_SESSION['sessData']:''; 
if(!empty($sessData['status']['msg'])){ 
    $statusMsg = $sessData['status']['msg']; 
    $statusMsgType = $sessData['status']['type']; 
    unset($_SESSION['sessData']['status']); 
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

  <title>Catering Management System - User Homepage - Checkout Page</title>
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
    <div class="container">
      <h2>
        Order Success
      </h2>
      <div class="row">
        <div class="col-md-12">

                <?php if(!empty($statusMsg) && ($statusMsgType == 'success')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-success"><?php echo $statusMsg; ?></div>
                </div>
                <?php }elseif(!empty($statusMsg) && ($statusMsgType == 'error')){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"><?php echo $statusMsg; ?></div>
                </div>
                <?php } ?>
                
                <div class="col-md-12 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Your Orders</span>
                        <span class="badge badge-secondary badge-pill"><?php echo $cart->total_items(); ?></span>
                    </h4>
                    <ul class="list-group mb-3">
                    <?php 
                    if($cart->total_items() > 0){ 
                        // Get cart items from session 
                        $cartItems = $cart->contents(); 
                        foreach($cartItems as $item){ 
                    ?>
                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <h6 class="my-0"><?php echo $item["name"]; ?></h6>
                                <small class="text-muted"><?php echo CURRENCY_SYMBOL.$item["price"]; ?>(<?php echo $item["qty"]; ?>)</small>
                            </div>
                            <span class="text-muted"><?php echo CURRENCY_SYMBOL.$item["subtotal"]; ?></span>
                        </li>
                    <?php } } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total (<?php echo CURRENCY; ?>)</span>
                            <strong><?php echo CURRENCY_SYMBOL.$cart->total(); ?></strong>
                        </li>
                    </ul>
                    <a href="index3.php" class="btn btn-sm btn-info">+ add items</a>
                </div>
                      <section class="contact_section layout_padding-bottom " id="start">
    <div class="container">
      <h2>
        Add A Custom Order & Checkout Details
      </h2>
      <div class="row">
        <div class="col-md-12">
          <div class="form_container">
                    <form method="post" action="cartaction.php" enctype="multipart/form-data">
                        <div class="mb-6">
                            <fieldset>
                              <br>
                              <label>*Custom Orders will be an additional charge of 5000 kshs. per Serving*</label>
                              <br>
                               <input type="text" name="fname" placeholder="Custom Item/Food Name (if Any)">
                            </fieldset>
                        </div>                            
                         <div class="mb-6">
                              <fieldset>
<br>
                                <textarea class="message_input" name="in" placeholder="Any Custom Ingredients regarding Your Order... (if Any)" rows="5" cols="120" id="comment"></textarea>
<br>
                              </fieldset>
                            </div>
                            <div class="mb-6">
                              <fieldset>
<br>
                                <textarea class="message_input" name="cust" placeholder="Any Custom Instructions regarding Your Order... (if Any)" rows="5" cols="120" id="comment"></textarea>
                                <br>
                              </fieldset>
                            </div>
                                                <div class="mb-6">
                            <fieldset>
                              <input type="number" required name="quan" placeholder="Quantity of Custom Order (if Any)">
                            </fieldset>
                        </div>    
                                                <div class="mb-6">
                            <fieldset>
                                                                    <select name="meal" required>
                                       <option value="" disabled selected>Select A Custom Item/Food Meal Type (if Any)</option>
                           <option value="Breakfast">Breakfast</option>
                           <option value="Brunch">Brunch</option>                           
                           <option value="Lunch">Lunch</option>
                           <option value="Dinner">Dinner</option>                                                
                        </select>
                            </fieldset>
                        </div>
                        <div class="mb-6">
                            <fieldset>
                              <br>
                              <label>Custom Item/Food Image (if Any):</label>
                        <input type="file" accept=".jpg, .png, .jpeg" class="mail_text" name="image">
                        <br>
                            </fieldset>
                        </div>                                                                          
                        <div class="mb-6">
                            <fieldset>
                              <input type="text" required name="loc" placeholder="Your Location">
                            </fieldset>
                        </div>
                        <div class="mb-6">
                            <fieldset>
                              <input type="number" required name="no" placeholder="Number of People">
                            </fieldset>
                        </div> 
                                                <div class="mb-6">
                            <fieldset>
                                                 <select required name="pay">
                           <option value="" disabled selected>Select Payment Method</option>
                           <option value="Cash">Cash</option>
                           <option value="Credit Card">Credit Card</option>
                           <option value="Debit Card">Debit Card</option>
                           <option value="M-PESA">M-PESA</option>                          
                        </select>
                            </fieldset>
                        </div>
                                                                        <div class="mb-6">
                            <fieldset>
                                                                    <select name="type" required>
                                       <option value="" disabled selected>Select An Type</option>
                           <option value="Prepared Meal">Prepared Meal</option>
                           <option value="Prepared at Venue">Prepared at Venue</option>                                                
                        </select>
                            </fieldset>
                        </div>
                        <input type="hidden" name="action" value="placeOrder"/>
                        <input class="btn btn-success btn-block" type="submit" name="checkoutSubmit" value="Place Order">
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
</div>
</div>
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