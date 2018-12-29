
<?php 
 
/*  

query to get category and show the category with help of joins
refer in lecture 82  Q and A

$query = query("SELECT products.*, categories.cat_title FROM products join categories on products.product_category_id = categories.cat_id WHERE products.product_id = " . escape_string($_GET['id']));    



 */
if (isset($_GET['id'])) {


  $query = query("SELECT * FROM products WHERE product_id=".escape_string($_GET['id'])."");
  confirm($query);
  while ( $row = fetch_array($query)) {

    $product_title = escape_string($row['product_title']);
$_SESSION['product_name']=$product_title;
$product_category_id = escape_string($row['pro_cat_id']);
$product_price = escape_string($row['product_price']);
$product_description = escape_string($row['product_description']);
$product_short_desc = escape_string($row['short_description']);
$product_quantity = escape_string($row['product_quantity']);
$product_image =  escape_string($row['product_img']);
 $product_image= display_image($row['product_img']);
    # code...
  }



  
update_product();

  # code...
}




 ?>


<div class="col-md-12">

<div class="row">
<h1 class="page-header">
   Edit Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">


<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" value="<?php echo $product_title ?>" class="form-control">
       
    </div>


    <div class="form-group">
           <label for="product_description">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"><?php echo $product_description ?></textarea>
    </div>


    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" value="<?php echo $product_price ?>" name="product_price" class="form-control" size="60">
      </div>
    </div>

 <div class="form-group">
           <label for="short_description">Short Description</label>
      <textarea name="short_description" id="" cols="20" rows="3" class="form-control"><?php echo $product_short_desc ?></textarea>
    </div>



    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="update" class="btn btn-primary btn-lg" value="update">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="pro_cat_id">Product Category</label>
        
        <select name="pro_cat_id"  id="" class="form-control">
            <option value="<?php echo $product_category_id?>"><?php echo show_product_category_title($product_category_id) ?></option>
           <?php show_categories_in_add_productpage(); ?>
        </select>


</div>





    <!-- Product Brands-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
        <input type="number" value="<?php echo $product_quantity ?>" name="product_quantity" class="form-control">
       
    </div>


<!-- Product Tags -->

<!-- 
    <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div> -->

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="file">
        <br>
<label>Current Image:</label> <br><img src ="../../resources/<?php echo $product_image ?>" width="180" >
    </div>



</aside><!--SIDEBAR-->


    
</form>



                



            </div>
            <!-- /.container-fluid -->

      