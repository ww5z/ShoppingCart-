<?php  
 //cart.php  
 //session_start();  
// $connect = mysqli_connect("localhost", "root", "1bn5n52", "salesapp");
include('includes/database_connection.php');
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Multi Tab Shopping Cart By Using PHP Ajax Jquery Bootstrap Mysql</title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <?php  
			   
                if(isset($_POST["place_order"]))  
                {  
					 $user_id = $_SESSION["user_id"]; 
					$total = $_POST["total"]; 
                     $insert_order = "  
                     INSERT INTO inventory_order(user_id, customer_id, inventory_order_created_date, inventory_order_total, inventory_order_status)  
                     VALUES('$user_id', '1', '".date('Y-m-d')."', '$total', 'active')  
                     ";  
                     $order_id = "";  
					
				$connect->exec($insert_order);
				$order_id = $connect->lastInsertId();
					
					
                     $_SESSION["order_id"] = $order_id;  
                     $order_details = "";  
                     foreach($_SESSION["shopping_cart"] as $keys => $values)  
                     {  
                          $order_details .= "  
                          INSERT INTO inventory_order_product(inventory_order_id, product_id, price, quantity, tax)  
                          VALUES('".$order_id."', '".$values["product_id"]."', '".$values["product_price"]."', '".$values["product_quantity"]."', '".$values["VAT"]."');  
                          ";  
                     }  
					$result = $connect->exec($order_details);
                     if($result)  
                     {  
                          unset($_SESSION["shopping_cart"]);  
                          //echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                          echo '<script>window.location.href="cart.php"</script>';  
                     }  
                }  
                if(isset($_SESSION["order_id"]))  
                {  
                     $customer_details = '';  
                     $order_details = '';  
                     $total = 0;  
                     $query = '  
                     SELECT * FROM inventory_order  
                     INNER JOIN inventory_order_product  
                     ON inventory_order_product.inventory_order_id = inventory_order.inventory_order_id  
                     INNER JOIN tbl_customer  
                     ON tbl_customer.CustomerID = inventory_order.customer_id  
                     WHERE inventory_order.inventory_order_id = "'.$_SESSION["order_id"].'"  
                     ';  
                     $statement = $connect->prepare($query);
					$statement->execute();
					$result = $statement->fetchAll(); 
                     foreach($result as $row)  
                     {  
                          $customer_details = '  
                          <label>'.$row["CustomerName"].'</label>  
                          <p>'.$row["Address"].'</p>  
                          <p>'.$row["City"].', '.$row["PostalCode"].'</p>  
                          <p>'.$row["Country"].'</p>  
                          ';  
                          $order_details .= "  
                               <tr>  
                                    <td>".$row["product_id"]."</td>  
                                    <td>".$row["quantity"]."</td>  
                                    <td>".$row["price"]."</td>  
                                    <td>".number_format($row["quantity"] * $row["price"], 2)."</td>  
                               </tr>  
                          ";  
                          $total = $total + ($row["quantity"] * $row["price"]);  
                     }  
                     echo '  
                     <h3 align="center">Order Summary for Order No.'.$_SESSION["order_id"].'</h3>  
                     <div class="table-responsive">  
                          <table class="table">  
                               <tr>  
                                    <td><label>Customer Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>'.$customer_details.'</td>  
                               </tr>  
                               <tr>  
                                    <td><label>Order Details</label></td>  
                               </tr>  
                               <tr>  
                                    <td>  
                                         <table class="table table-bordered">  
                                              <tr>  
                                                   <th width="50%">Product Name</th>  
                                                   <th width="15%">Quantity</th>  
                                                   <th width="15%">Price</th>  
                                                   <th width="20%">Total</th>  
                                              </tr>  
                                              '.$order_details.'  
                                              <tr>  
                                                   <td colspan="3" align="right"><label>Total</label></td>  
                                                   <td>'.number_format($total, 2).'</td>  
                                              </tr>  
                                         </table>  
                                    </td>  
                               </tr>  
                          </table>  
                     </div>  
                     ';  
                }  
                ?>  
           </div>  
      </body>  
 </html> 
