<?php   
include('includes/database_connection.php');
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title>Webslesson Tutorial | Multi Tab Shopping Cart By Using PHP Ajax Jquery Bootstrap Mysql</title>  
           <script src="js/jquery-3.2.1.min.js"></script>  
           <link rel="stylesheet" href="css/bootstrap.min.css" />  
           <script src="js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:800px;">  
                <h3 align="center">Multi Tab Shopping Cart By Using PHP Ajax Jquery Bootstrap Mysql</h3><br />  
                <ul class="nav nav-tabs">  
                     
                     <li><a data-toggle="tab" href="#cart">Cart <span class="badge"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?></span></a></li> 
					<li class="active"><a data-toggle="tab" href="#products">+</a></li> 
					<li class="active"><a data-toggle="tab" href="#products">-</a></li>  
                </ul>  
<div class="tab-content">  
<div id="products" class="tab-pane fade in active">  
	<div class="" style="margin-top:12px;">  
		
<div class="form-inline">
	<div class="form-group mx-sm-3 mb-2">
		<input type="text" id="barcode" name="barcode" class="form-control" placeholder="باركـــود" aria-label="" aria-describedby="basic-addon1" value="">
	</div>
	<button type="button" id="add_to_cart" class="btn btn-primary mb-2">Confirm identity</button>
</div>

		<br />
		<div class="table-responsive" id="order_table">  
		<table class="table table-bordered">  
                                    <tr>  
                                         <th width="40%">Product Name</th>  
                                         <th width="10%">Quantity</th>  
                                         <th width="20%">Price</th>  
										 <th width="20%">VAT</th>  
                                         <th width="15%">Total</th>  
                                         <th width="5%">Action</th>  
                                    </tr>  
                                    <?php  
                                    if(!empty($_SESSION["shopping_cart"]))  
                                    {  
                                         $total = 0;
										 $VAT   = 0;
                                         foreach($_SESSION["shopping_cart"] as $keys => $values)  
                                         {                                               
                                    ?>  
                                    <tr>  
                                         <td><?php echo $values["product_name"]; ?></td>  
                                         <td><input type="text" name="quantity[]" id="quantity<?php echo $values["product_id"]; ?>" value="<?php echo $values["product_quantity"]; ?>" data-product_id="<?php echo $values["product_id"]; ?>" class="form-control quantity" /></td>  
                                         <td align="right">$ <?php echo $values["product_price"]; ?></td>  
										<td align="right">$ <?php echo $values["VAT"]; ?></td>  
                                         <td align="right">$ <?php echo number_format($values["product_quantity"] * $values["product_price"], 2); ?></td>  
                                         <td><button name="delete" class="btn btn-danger btn-xs delete" id="<?php echo $values["product_id"]; ?>">Remove</button></td>  
                                    </tr>  
                                    <?php  
                                             $VAT = $VAT + ($values["product_quantity"] * $values["product_price"] * $values["VAT"]);  
											 $total = $total + ($values["product_quantity"] * $values["product_price"]) + $VAT; 
											  
                                         }  
                                    ?>  
                                    <tr>  
                                         <td colspan="3" align="right">Total</td>  
                                         <td align="right">$ <?php echo number_format($total, 2); ?></td>  
                                         <td></td>  
                                    </tr> 
									<tr>  
                                         <td colspan="3" align="right">VAT</td>  
                                         <td align="right">$ <?php echo number_format($VAT, 2); ?></td>  
                                         <td></td>  
                                    </tr> 
                                    <tr>  
                                         <td colspan="5" align="center">  
                                              <form method="post" action="cart.php">  
                                                   <input type="submit" name="place_order" class="btn btn-warning" value="Place Order" />  
                                              </form>  
                                         </td>  
                                    </tr>  
                                    <?php  
                                    }  
                                    ?>  
                               </table>
		</div> 
		
		
	</div>  
</div>
	
	
<!--	<div id="cart" class="tab-pane fade">  



	</div> --> 
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(data){  
	 
	$('#barcode').focus(); // تنشيط الحق
//	$('#barcode').click(function (){
//	$('#barcode').val('');
//	});
	 
	 
      //$('#add_to_cart').click(function(){  
	$('#barcode').change(function(){   
          
		var barcode = $('#barcode').val();
		var product_id = "activ"; //لفتح الشرط فقط
		var action = "add";  
		var product_quantity = 1; 
		   
           if(product_quantity > 0) {
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{  
                          product_id:product_id, 
						  barcode:barcode, 
                          action:action  
                     }, 
					beforeSend: function (xhr) {
					//$("#insert_data").show();
					},
					statusCode: { // كود خاص بتحليل أخطاء الصفحه
					404: function (){
					alert("Not found page");
					}, 
					403: function (){
					alert("Bad request");
					}
					},  
                     success: function (data, textStatus, jqXHR) {
						 //alert(data);
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
						 
                          //alert("Product has been Added into Cart");  
                     },
        error: function (jqXHR, textStatus, errorThrown) {
            alert("error");
        },
        complete: function (jqXHR, textStatus) {
            $('#barcode').val('');
        }  
                });  
           }  
           else  
           {  
                alert("Please Enter Number of Quantity")  
           }  
      });  
	 
      $(document).on('click', '.delete', function(){  
           var product_id = $(this).attr("id");  
           var action = "remove";  
           if(confirm("Are you sure you want to remove this product?"))  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                          $('.badge').text(data.cart_item);  
                     }  
                });  
           }  
           else  
           {  
                return false;  
           }  
      }); 
	 
      $(document).on('keyup', '.quantity', function(){  
           var product_id = $(this).data("product_id");  
           var quantity = $(this).val();  
           var action = "quantity_change";  
           if(quantity != '')  
           {  
                $.ajax({  
                     url :"action.php",  
                     method:"POST",  
                     dataType:"json",  
                     data:{product_id:product_id, quantity:quantity, action:action},  
                     success:function(data){  
                          $('#order_table').html(data.order_table);  
                     }  
                });  
           }  
      });  
	 
 });  
 </script>

