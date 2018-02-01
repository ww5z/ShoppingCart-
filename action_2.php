<?php  
 //action.php  
include('includes/database_connection.php');









 if(isset($_POST["product_id"])) {
	 
//////////////////////////
/////////////////////////	
	 $barcode = $_POST["barcode"];
$query = "
SELECT * FROM tbl_product WHERE barcode = '$barcode'
";
$statement = $connect->prepare($query);
$statement->execute();
$result = $statement->fetchAll();

$id = '';
$barcode = '';
$name = '';
$image = '';
$price = '';


foreach($result as $row)
{
	$id = $row['id'];
	$barcode = $row['barcode'];
	$name = $row['name'];
	$image = $row['image'];
	$price = $row['price'];
	$VAT = $row['VAT'];
}

if ($id == 0){ // التحقق من وجود المنتج
	die("die");
}
	 
$product_quantity = 1;
	
//////////////////////////
/////////////////////////	
	 
	 
	 
      $order_table = '';  
      $message = '';  
      if($_POST["action"] == "add")  
      {  
           if(isset($_SESSION["shopping_cart"]))  
           {  
                $is_available = 0;  
                foreach($_SESSION["shopping_cart"] as $keys => $values)  
                {  
                     if($_SESSION["shopping_cart"][$keys]['product_id'] == $id)  
                     {  
                          $is_available++;  
                          $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_SESSION["shopping_cart"][$keys]['product_quantity'] + $product_quantity ;  
                     }  
                }  
                if($is_available < 1)  
                {  
                     $item_array = array(  
                          'product_id'               =>     $id,  
                          'product_name'               =>     $name,  
                          'product_price'               =>     $price, 
						 	'VAT'               =>     $VAT, 
                          'product_quantity'          =>     $product_quantity  
                     );  
                     $_SESSION["shopping_cart"][] = $item_array;  
                }  
           }  
           else  
           {  
                $item_array = array(  
                     'product_id'               =>     $id,  
                     'product_name'               =>     $name,  
                     'product_price'               =>     $price, 
					'VAT'               =>     $VAT, 
                     'product_quantity'          =>     $product_quantity  
                );  
                $_SESSION["shopping_cart"][] = $item_array;  
           }  
      }
	 
      if($_POST["action"] == "remove")  
      {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($values["product_id"] == $_POST["product_id"])  
                {  
                     unset($_SESSION["shopping_cart"][$keys]);  
                     $message = '<label class="text-success">Product Removed</label>';  
                }  
           }  
      }  
      if($_POST["action"] == "quantity_change") {  
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                if($_SESSION["shopping_cart"][$keys]['product_id'] == $_POST["product_id"])  
                {  
                     $_SESSION["shopping_cart"][$keys]['product_quantity'] = $_POST["quantity"];  
                }  
           }  
      }  
      $order_table .= '  
           '.$message.'  
           <table class="table table-bordered">  
                <tr>  
                     <th width="40%">Product Name</th>  
                     <th width="10%">Quantity</th>  
                     <th width="20%">Price</th> 
					 <th width="20%">VAT</th> 
                     <th width="15%">Total</th>  
                     <th width="5%">Action</th>  
                </tr>  
           ';  
      if(!empty($_SESSION["shopping_cart"]))  
      {  
           $total = 0;
		  $VAT   = 0;
           foreach($_SESSION["shopping_cart"] as $keys => $values)  
           {  
                $order_table .= '  
                     <tr>  
                          <td>'.$values["product_name"].'</td>  
                          <td><input type="text" name="quantity[]" id="quantity'.$values["product_id"].'" value="'.$values["product_quantity"].'" class="form-control quantity" data-product_id="'.$values["product_id"].'" /></td>  
                          <td align="right">$ '.$values["product_price"].'</td> 
						  <td align="right">$ '.$values["VAT"].'</td> 
                          <td align="right">$ '.number_format($values["product_quantity"] * $values["product_price"], 2).'</td>  
                          <td><button name="delete" class="btn btn-danger btn-xs delete" id="'.$values["product_id"].'">Remove</button></td>  
                     </tr>  
                ';  
                $total = $total + ($values["product_quantity"] * $values["product_price"]); 
			   $VAT = $VAT + ($values["product_quantity"] * $values["product_price"]* $values["VAT"]); 
           }  
           $order_table .= '  
                <tr>  
                     <td colspan="3" align="right">Total</td>  
                     <td align="right">$ '.number_format($total, 2).'</td>  
                     <td></td>  
                </tr>
				<tr>  
                     <td colspan="3" align="right">VAT</td>  
                     <td align="right">$ '.number_format($VAT, 2).'</td>  
                     <td></td>  
                </tr> 
                <tr>  
                     <td colspan="5" align="center">  
                          <form method="post" action="cart.php">  
                               <input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                          </form>  
                     </td>  
                </tr>  
           ';  
      }  
      $order_table .= '</table>';  
      $output = array(  
           'order_table'     =>     $order_table,  
           'cart_item'          =>     count($_SESSION["shopping_cart"])  
      );  
      echo json_encode($output);  
 }  
 ?>
