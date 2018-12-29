
<?php require_once("../resources/config.php")         ?> 


<?php include(TEMPLATE_FRONT.DS."header.php") ;       ?> 

    <!-- Page Content -->
    <div class="container">

        <!-- Jumbotron Header -->
        <header class="jumbotron hero-spacer">
            <h1>A Warm Welcome!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
            <p><a class="btn btn-primary btn-large">Call to action!</a>
            </p>
        </header>

        <hr>

        <!-- Title -->
        <div class="row">
            <div class="col-lg-12">

<?php
                 $query =query("SELECT * FROM categories WHERE cat_id=".escape_string($_GET['id'])."");
confirm($query);
while($row =fetch_array($query)){ ?>
                <h3><?php echo $row['cat_title'] ?> Products</h3>

              <?php }  ?>
            </div>
        </div>
        <!-- /.row -->

        <!-- Page Features -->
        <div class="row text-center">

        <?php get_products_in_categorypage(); ?>
         

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
 

    </div>
    <!-- /.container -->

    <!-- jQuery -->

 <?php include(TEMPLATE_FRONT.DS."footer.php") ;       ?>
