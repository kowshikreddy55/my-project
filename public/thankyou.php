<!-- localhost/ecom/public/checkout.php?amt=400&cc=USA&tx=12345&st=Completed -->


<?php require_once("../resources/config.php")         ?> 
 
<?php include(TEMPLATE_FRONT.DS."header.php") ;       ?> 
<?php 





process_transaction();



















//session_destroy();

	# code...



   ?> 




    <!-- Page Content -->
    <div class="container bg-success">

<h1 class="text-center ">Thank You For shopping</h1>



 </div>
 <!--Main Content-->




 <?php include(TEMPLATE_FRONT.DS."footer.php") ;       ?>

