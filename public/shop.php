
<?php require_once("../resources/config.php")         ?> 


<?php include(TEMPLATE_FRONT.DS."header.php") ;       ?> 

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header >
            <h3>Shop Page</h3>
          
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">

                <h3>ALL Products</h3>

       
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

        <?php get_products_in_shoppage(); ?>
         

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
 

    </div>
    <!-- /.container -->

    <!-- jQuery -->

 <?php include(TEMPLATE_FRONT.DS."footer.php") ;       ?>
