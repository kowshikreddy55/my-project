
<?php require_once("../resources/config.php")         ?> 


<?php include(TEMPLATE_FRONT.DS."header.php") ;       ?> 
    <!-- Page Content -->
<div class="container">

       <!-- Side Navigation -->
 <?php include(TEMPLATE_FRONT.DS."sidenav.php") ;       ?> 
       <?php

        $query =query("SELECT * FROM products WHERE product_id=".escape_string($_GET['id'])."");

confirm($query);

while ( $row = fetch_array($query)){



    ?>


<div class="col-md-9">

<!--Row For Image and Short Description-->

<div class="row">

    <div class="col-md-7">
       <img class="img-responsive" src="../resources/<?php echo display_image($row['product_img']); ?>" width="200" alt="">

    </div>

    <div class="col-md-5">

        <div class="thumbnail">
         

    <div class="caption-full">
        <h4><a href="#"><?php echo $row['product_title']; ?></a> </h4>
        <hr>
        <h4 class="">&#8377;<?php echo $row['product_price']; ?></h4>

    <div class="ratings">
     
        <p>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star-empty"></span>
            4.0 stars
        </p>
    </div>
          
        <p><?php echo $row['short_description']; ?></p>

   
    <form action="">
        <div class="form-group">
            <a class="btn btn-primary"  href="../resources/cart.php?add=<?php echo $row['product_id'] ?>">Add to Cart</a>
        </div>
    </form>

    </div>
 
</div>

</div>


</div><!--Row For Image and Short Description-->


        <hr>


<!--Row for Tab Panel-->

<div class="row">

<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="home">

<p></p>
           
    <p><?php echo $row['product_description']; ?></p>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">

  <div class="col-md-6">

       <h3> Reviews From </h3>
<?php comment(); ?>
        <hr>

 

<?php display_comment(); ?>

      

    </div>


    <div class="col-md-6">
        <h3>Add A review</h3>
        <h3 class="bg-success"><?php display_message(); ?></h3>

     <form action="#profile" method="post" class="form-inline">
        <div class="form-group">
            <label for="">Name</label>
                <input type="text" name="name" class="form-control" >
            </div>
             <div class="form-group">
            <label for="">Email</label>
                <input type="test" name="email" class="form-control">
            </div>

        <div>
            <h3>Your Rating</h3>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
            <span class="glyphicon glyphicon-star"></span>
        </div>

            <br>
            
             <div class="form-group">
             <textarea name="comment" id="" cols="60" rows="10" class="form-control"></textarea>
            </div>

             <br>
              <br>
            <div class="form-group">
                <input type="submit"  name="submit" class="btn btn-primary" value="SUBMIT">
            </div>
        </form>

    </div>

 </div>

 </div>

</div>


</div><!--Row for Tab Panel-->




</div>
<?php } ?>

</div>
    <!-- /.container -->

 <?php include(TEMPLATE_FRONT.DS."footer.php") ;       ?>
