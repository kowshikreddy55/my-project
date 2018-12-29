
<?php require_once("../resources/config.php")         ?> 
 

<?php include(TEMPLATE_FRONT.DS."header.php") ;       ?> 
<?php 



   ?> 

    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">

      <h1>Checkout</h1>
   <h1> </h1>
    <h4 class=" text-center bg-danger"> <?php display_message();  ?>
   </h4>

<!--   //paypall form -->
<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="business" value="kowshikreddy55-facilitator@gmail.com">
  <input type="hidden" name="currency_code" value="INR">

  <!-- end paypal -->
    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
         <?php cart(); ?>
        </tbody>
    </table>
  <?php echo show_paypalbutton() ?>
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo  isset($_SESSION['total_quantity']) ? $_SESSION['total_quantity'] : $_SESSION['total_quantity']="0" ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount"> &#8377;<?php echo  isset($_SESSION['total_price']) ? $_SESSION['total_price'] : $_SESSION['total_price']="0" ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->
</div>



 <?php include(TEMPLATE_FRONT.DS."footer.php") ;       ?>
