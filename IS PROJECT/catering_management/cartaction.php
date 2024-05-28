<?php 

session_start();

// Include the database connection file 
require_once 'dbconnection.inc.php'; 
 
// Initialize shopping cart class 
require_once 'cart.class.php'; 
$cart = new Cart; 
 
// Default redirect page 
$redirectURL = 'index3.php'; 
 
// Process request based on the specified action 
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){ 
    if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){ 
        $food_id = $_REQUEST['id']; 
 
        // Fetch product details from the database 
        $sqlQ = "SELECT * FROM tbl_food WHERE food_id=?"; 
        $stmt = $conn->prepare($sqlQ); 
        $stmt->bind_param("i", $db_id); 
        $db_id = $food_id; 
        $stmt->execute(); 
        $result = $stmt->get_result(); 
        $productRow = $result->fetch_assoc(); 
 
        $itemData = array( 
            'id' => $productRow['food_id'], 
            'image' => $productRow['food_image'], 
            'name' => $productRow['food_name'], 
            'admin' => $productRow['admin_id'], 
            'price' => $productRow['food_sellingprice'], 
            'qty' => 1 
        ); 
         
        // Insert item to cart 
        $insertItem = $cart->insert($itemData); 
         
        // Redirect to cart page 
        $redirectURL = $insertItem?'viewcart.php':'index3.php'; 
    }elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){ 
        // Update item data in cart 
        $itemData = array( 
            'rowid' => $_REQUEST['id'], 
            'qty' => $_REQUEST['qty'] 
        ); 
        $updateItem = $cart->update($itemData); 
         
        // Return status 
        echo $updateItem?'ok':'err';die; 
    }elseif($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){ 
        // Remove item from cart 
        $deleteItem = $cart->remove($_REQUEST['id']); 
         
        // Redirect to cart page 
        $redirectURL = 'viewcart.php'; 
    }elseif($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0){ 
        $redirectURL = 'index3.php'; 
         
        // Store post data 
        $_SESSION['postData'] = $_POST; 
     
        $cid = $_SESSION['username'];  
        $cui = $_SESSION['filter'];
        $cust = strip_tags($_POST['cust']);
        $pay = strip_tags($_POST['pay']);        
        $loc = strip_tags($_POST['loc']); 
        $no = strip_tags($_POST['no']);
        $in = strip_tags($_POST['in']);
        $meal = strip_tags($_POST['meal']);
        $type = strip_tags($_POST['type']); 
        $fname = strip_tags($_POST['fname']); 
        $quan = strip_tags($_POST['quan']);                                

        $errorMsg = ''; 
        if(empty($errorMsg)){ 
if ($cust != "" && $in != "" && $meal != "" && $fname != "" && $quan != ""){

$filename = $_FILES['image']['name'];
$valid_extensions = array("jpg","jpeg","png");
$extension = pathinfo($filename, PATHINFO_EXTENSION);
if(in_array(strtolower($extension),$valid_extensions) ) {
move_uploaded_file($_FILES['image']['tmp_name'], "images/".$filename);

                        $sqlQ = "INSERT INTO tbl_food(food_name, food_image, cuisine, meal, food_sellingprice, user_id, ingredients, quantity) VALUES (?,?,?,?,?,?,?,?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("ssssiisi", $db_fname, $filename, $db_cui, $db_meal, $db_price, $db_cid, $db_in, $db_quan); 
            $db_fname = $fname;
            $db_cui = $cui;
            $db_meal = $meal;  
            $db_price = 5000;                                                           
            $db_cid = $cid;
            $db_in = $in;
            $db_quan = $quan;
            $insertF = $stmt->execute(); 

            $FID = $stmt->insert_id; 
            
            $sqlQ1 = "INSERT INTO tbl_order(customer_id, type, order_total, Location, Custom, payment_method, no_of_people) VALUES (?,?,?,?,?,?,?)"; 
            $stmt = $conn->prepare($sqlQ1); 
            $stmt->bind_param("isdsssi", $db_cid, $db_type, $db_total, $db_loca, $db_cust, $db_pay, $db_no); 
            $db_cid = $cid;
            $db_cust = $cust;
            $db_loca = $loc;
            $db_type = $type;  
            $db_pay = $pay;
            $db_no = $no;                                                           
            $db_total = $cart->total() + (5000 * $quan); 
            $insertOrd = $stmt->execute(); 
             
            if($insertOrd){ 
                $ordID = $stmt->insert_id; 
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents();

                                $sqlQ2 = "INSERT INTO tbl_orderdetails(food_name, food_id, quantity, price, order_id) VALUES (?,?,?,?,?)"; 
            $stmt = $conn->prepare($sqlQ2); 
            $stmt->bind_param("sisdi", $db_fname, $db_fid, $db_quantity, $db_fprice, $db_order_id); 
                            $db_order_id = $ordID; 
                            $db_quantity = $quan; 
                            $db_fid = $FID; 
                            $db_fname = $fname;                            
                            $db_fprice = 5000; 
                            $insertitemsss1 = $stmt->execute();  
                     
                    // Insert order details in the database 
                    if(!empty($cartItems)){ 
                        $sqlQ3 = "INSERT INTO tbl_orderdetails(food_name, food_id, quantity, price, order_id) VALUES (?,?,?,?,?)"; 
                        $stmt = $conn->prepare($sqlQ3); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("sisdi", $db_fname, $db_fid, $db_quantity, $db_fprice, $db_order_id); 
                            $db_order_id = $ordID; 
                            $db_quantity = $item['qty']; 
                            $db_fid = $item['id']; 
                            $db_fname = $item['name'];                            
                            $db_fprice = $item['price']; 
                            $insertitemsss = $stmt->execute(); 
                        }
                        }
                        } 
          }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. File not recorded.';
            }               
        }else{ 
            if(empty($errorMsg)){ 
            $sqlQ = "INSERT INTO tbl_order(customer_id, type, order_total, Location, Custom, payment_method, no_of_people) VALUES (?,?,?,?,?,?,?)"; 
            $stmt = $conn->prepare($sqlQ); 
            $stmt->bind_param("isdsssi", $db_cid, $db_type, $db_total, $db_loca, $db_cust, $db_pay, $db_no); 
            $db_cid = $cid;
            $db_cust = $cust;
            $db_loca = $loc;
            $db_type = $type;  
            $db_pay = $pay;
            $db_no = $no;                                                           
            $db_total = $cart->total() + (5000 * $quan); 
            $insertOrd = $stmt->execute(); 
             
            if($insertOrd){ 
                $ordID = $stmt->insert_id; 
                     
                    // Retrieve cart items 
                    $cartItems = $cart->contents(); 
                     
                    // Insert order details in the database 
                    if(!empty($cartItems)){ 
                        $sqlQ = "INSERT INTO tbl_orderdetails(food_name, food_id, quantity, price, order_id, created_on) VALUES (?,?,?,?,?,NOW())"; 
                        $stmt = $conn->prepare($sqlQ); 
                        foreach($cartItems as $item){ 
                            $stmt->bind_param("sisdi", $db_fname, $db_fid, $db_quantity, $db_fprice, $db_order_id); 
                            $db_order_id = $ordID; 
                            $db_quantity = $item['qty']; 
                            $db_fid = $item['id']; 
                            $db_fname = $item['name'];                            
                            $db_fprice = $item['price']; 
                            $insertitemsss = $stmt->execute(); 
                        } 
 
            }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. Order Details not inserted.';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. Order not recorded.';
            } 
        }else{ 
                $sessData['status']['type'] = 'error'; 
                $sessData['status']['msg'] = 'Something went wrong, please try again. Food Not Recorded.';
            }
                    }
         
        // Store status in session 
        $_SESSION['sessData'] = $sessData; 
    } 
} 
}
// Redirect to the specific page 
  // echo "<script>alert('Thank you for placing your order with us!');
  //       window.location.href='index3.php?checkout=success';</script>";
header("Location: $redirectURL"); 
exit();
?>
