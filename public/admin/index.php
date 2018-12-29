<?php require_once("../../resources/config.php")         ?> 
<?php include(TEMPLATE_BACK.DS."header.php") ;     

if (!isset($_SESSION['username'])) {
  redirect("../../public/");
}



  ?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
               
                <!-- /.row -->



                <?php 
// CHANGING CONTENT BASED ON THE PAGES 

                if($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php") {
include(TEMPLATE_BACK.DS."admin_content.php"); 



                }



if (isset($_GET['orders'])) {

include(TEMPLATE_BACK.DS."orders.php"); 

}
elseif (isset($_GET['categories'])) {
    include(TEMPLATE_BACK.DS."categories.php"); 
    # code...
}
elseif (isset($_GET['add_product'])) {
    # code...
        include(TEMPLATE_BACK.DS."add_product.php"); 
}
elseif (isset($_GET['products'])) {
    # code...
            include(TEMPLATE_BACK.DS."products.php"); 
}
elseif (isset($_GET['edit_product'])) {
    # code...
            include(TEMPLATE_BACK.DS."edit_product.php"); 
}
elseif (isset($_GET['users'])) {
    # code...
            include(TEMPLATE_BACK.DS."users.php"); 
}
elseif (isset($_GET['reports'])) {
    # code...
            include(TEMPLATE_BACK.DS."reports.php"); 
}





                ?>

                 <!-- FIRST ROW WITH PANELS -->

                <!-- /.row -->
               
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <?php include(TEMPLATE_BACK.DS."footer.php") ;       ?> 