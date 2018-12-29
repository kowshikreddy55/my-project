<?php
$uploads = "uploads";
//helper functions


function redirect($location){

header("Location: $location");

}


function query($sql){
	global $connection;

return mysqli_query($connection,$sql);

}

function confirm ($result){

	global $connection;
	if(!$result){

		die("QUERY FAILED".mysqli_error($connection));


	}
}


function escape_string($string){

	global $connection;
	return mysqli_real_escape_string($connection,$string);
}


function fetch_array($result){



	return  mysqli_fetch_array($result);
}




function set_message($msg){

if(!empty($msg)) {

$_SESSION['message'] = $msg;

} else {

$msg = "";


    }


}


function display_message() {

    if(isset($_SESSION['message'])) {

        echo $_SESSION['message'];
        unset($_SESSION['message']);

    }



}


function last_id(){



    global $connection;
return mysqli_insert_id($connection);
}








function login_user(){

if(isset($_POST['submit'])){

$username = escape_string($_POST['username']);
$password = escape_string($_POST['password']);

$query = query("SELECT * FROM users WHERE username = '{$username}' AND password = '{$password }' ");
confirm($query);

if(mysqli_num_rows($query) == 0) {

set_message("Your Password or Username are wrong");
redirect("login.php");


} else {

$_SESSION['username'] = $username;
redirect("admin");

         }



    }



}


//***************FRONT END FUNCTIONS***************

//get products


function get_products(){

$query =query("SELECT * FROM products");

confirm($query);

while ( $row = fetch_array($query)){
 $product_image = display_image($row['product_img']);  
$product = <<<DELIMETER
 <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="item.php?id={$row['product_id']}"><img src="../resources/{$product_image}" alt="" height="100" width= "200"></a>
                            <div class="caption">
                                <h4 class="pull-right"> &#8377;{$row['product_price']}</h4>
                                <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}  </a>
                                </h4>
                                <p>{$row['short_description']} </p>
                                   <a class="btn btn-primary"  href="../resources/cart.php?add={$row['product_id']}">Add to Cart</a>
                            </div>
                        
                        </div>
                    </div>
DELIMETER;

echo $product;





}


}





function get_categories(){


$query= query("SELECT * FROM categories");
confirm($query);
while($datarow =fetch_array($query)){
              
$category = <<<DELIMETER
<a href="category.php?id={$datarow['cat_id'] }" class='list-group-item'> {$datarow['cat_title'] }</a>
DELIMETER;

echo $category;



}
}



function get_products_in_categorypage(){


 $query =query("SELECT * FROM products WHERE pro_cat_id=".escape_string($_GET['id'])."");
confirm($query);
while($row =fetch_array($query)){
       $product_image = display_image($row['product_img']);       
$product_in_category = <<<DELIMETER
   <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                  <img src="../resources/{$product_image}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_description']}.</p>
                        <p>
                             <a class="btn btn-primary"  href="../resources/cart.php?add={$row['product_id']}">Add to Cart</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>



         

DELIMETER;

echo $product_in_category;



}
}




function get_products_in_shoppage(){


 $query =query("SELECT * FROM products ");
confirm($query);
while($row =fetch_array($query)){
              $product_image = display_image($row['product_img']);
$product_in_category = <<<DELIMETER
   <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                  <img src="../resources/{$product_image} " alt="" width="200">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_description']}.</p>
                        <p>
                            <a href="../resources/cart.php?add={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>



         

DELIMETER;

echo $product_in_category;



}
}







//***************Back END FUNCTIONS***************

function display_order(){


 $query =query("SELECT * FROM orders");
confirm($query);
while($row =fetch_array($query)){

$orders= <<<DELIMETER

   <tr>
 <td>{$row['order_id']}</td>
 <td>{$row['order_amount']}</td>
<td>{$row['order_transaction']}</td>
<td>{$row['order_currency']}</td>
<td>{$row['order_status']}</td>
<td><a href="../../resources/templates/back/delete_orders.php?order_id={$row['order_id']}" class= "btn btn-danger">Delete</a></td>
        </tr>





DELIMETER;
        echo $orders;




}

}


// ******************Admin Products***********
function display_image($picture){
global $uploads;

    return $uploads.DS.$picture;
}

function get_products_in_admin(){

$query =query("SELECT * FROM products");

confirm($query);

while ( $row = fetch_array($query)){

    //function in a function
$category_title = show_product_category_title($row['pro_cat_id']); 

////
$product_image = display_image($row['product_img']);

$product = <<<DELIMETER

      <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']} <br>
             <a href="index.php?edit_product&id={$row['product_id']}" class= "btn"> <img src="../../resources/{$product_image}" alt="" width="150"></a>
            </td>
            <td>{$category_title}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
           <td> <a href="index.php?edit_product&id={$row['product_id']}" class= "btn btn-warning">Edit</a>

           <a href="../../resources/templates/back/delete_product.php?product_id={$row['product_id']}" class= "btn btn-danger">Delete</a>
</td>
        </tr>
 
DELIMETER;

echo $product;





}


}




function show_product_category_title($product_category_id){
$category_query = query("SELECT * FROM categories WHERE cat_id ={$product_category_id}");
confirm($category_query);
while($category_row = fetch_array($category_query)){


    return $category_row['cat_title'];
}





}





// ****Add product in admin panel ******

function add_product(){

if(isset($_POST['publish'])){

$product_title = escape_string($_POST['product_title']);
$_SESSION['product_name']=$product_title;
$product_category_id = escape_string($_POST['pro_cat_id']);
$product_price = escape_string($_POST['product_price']);
$product_description = escape_string($_POST['product_description']);
$product_short_desc = escape_string($_POST['short_description']);
$product_quantity = escape_string($_POST['product_quantity']);
$product_image =  $_FILES['file']['name'];
$image_temp =  $_FILES['file']['tmp_name'];
move_uploaded_file($image_temp, UPLOADS.DS.$product_image);

 $insert_query =query("INSERT INTO products(product_title,pro_cat_id,product_price,product_quantity,short_description,product_description,product_img) 
    VALUES('{$product_title}','{$product_category_id}','{$product_price}','{$product_quantity}','{$product_short_desc}','{$product_description}','{$product_image}')");
 $last_id = last_id();
confirm($insert_query);
set_message("New Product  {$_SESSION['product_name']} Added Successfully");
redirect('index.php?products');

}

}









function show_categories_in_add_productpage(){


$query= query("SELECT * FROM categories");
confirm($query);
while($row =fetch_array($query)){
              
$category_options = <<<DELIMETER
 <option value="{$row['cat_id']}">{$row['cat_title']}</option>
DELIMETER;

echo $category_options;



}
}


// ******8************Updating Product*************

function update_product(){

if(isset($_POST['update'])){

$product_title = escape_string($_POST['product_title']);
$_SESSION['product_name']=$product_title;
$product_category_id = escape_string($_POST['pro_cat_id']);
$product_price = escape_string($_POST['product_price']);
$product_description = escape_string($_POST['product_description']);
$product_short_desc = escape_string($_POST['short_description']);
$product_quantity = escape_string($_POST['product_quantity']);
$product_image =  $_FILES['file']['name'];
$image_temp =  $_FILES['file']['tmp_name'];

if (empty($product_image)) {

$get_picture = query("SELECT product_img FROM products WHERE product_id= ".escape_string($_GET['id']. ""));
confirm($get_picture);
while ($pic = fetch_array($get_picture)){

$product_image= $pic['product_img'];

}

    # code...
}




move_uploaded_file($image_temp, UPLOADS.DS.$product_image);

 $update_query =query("UPDATE products SET product_title ='{$product_title}',
    product_price='{$product_price}',
    pro_cat_id='{$product_category_id}',
    product_quantity='{$product_quantity}',
    short_description='{$product_short_desc}',
    product_description='{$product_description}',
    product_img='{$product_image}' WHERE product_id=".escape_string($_GET['id'])."") ;
  

confirm($update_query);
set_message("Product  {$_SESSION['product_name']} Update Successfully");
redirect('index.php?products');

}

}


//********categories in admin*********

function show_categories_in_admin(){

$query=query("SELECT * FROM categories");
confirm($query);

while ($row = fetch_array($query)) {

    $category_id= $row['cat_id'];

    $category_title =$row['cat_title'];

    $category_admin= <<<DELIMETER

  <tr>
            <td>$category_id</td>
            <td>$category_title</td>
            <td> <a href="../../resources/templates/back/delete_category.php?cat_id={$row['cat_id']}" class= "btn btn-danger">Delete</a></td>
        </tr>
DELIMETER;
        echo $category_admin;
}



}


//******add category **********


function add_category(){

if(isset($_POST['add_category'])){

$cat_title = escape_string($_POST['cat_title']);
if (empty($cat_title)) {

set_message("Category can not be empty");

    # code...
}
else{
$_SESSION['new_category']=$cat_title ;

 $insert_query =query("INSERT INTO categories(cat_title) VALUES('{$cat_title}')");

confirm($insert_query);
set_message("Category {$_SESSION['new_category']} Added Successfully");

// redirect('index.php?categories');



}
}
}

// *****************8Admin Users*******************8


function show_users(){

$query=query("SELECT * FROM users");
confirm($query);

while ($row = fetch_array($query)) {

    $user_id= $row['user_id'];

    $username =$row['username'];

    $email =$row['email'];
     $password =$row['password'];

    $user_admin= <<<DELIMETER

  <tr>
            <td>$user_id</td>
            <td>Image</td>
            <td>$username</td>
            <td>$email</td>
            <td> <a href="../../resources/templates/back/delete_user.php?user_id={$row['user_id']}" class= "btn btn-danger">Delete</a></td>
        </tr>
DELIMETER;
        echo $user_admin;
}



}



function get_reports(){


 $query =query("SELECT * FROM reports");
confirm($query);
while($row =fetch_array($query)){

$reports= <<<DELIMETER

   <tr>
 <td>{$row['report_id']}</td>
 <td>{$row['product_id']}</td>
<td>{$row['order_id']}</td>
<td>{$row['product_title']}</td>
<td>{$row['product_price']}</td>
<td>{$row['product_quantity']}</td>
<td><a href="../../resources/templates/back/delete_reports.php?report_id={$row['report_id']}" class= "btn btn-danger">Delete</a></td>
        </tr>





DELIMETER;
        echo $reports;




}

}




//***********Add comment************

function comment(){
if(isset($_POST["submit"])){
$Name=escape_string($_POST["name"]);
$Email=escape_string($_POST["email"]);
$Comment=escape_string($_POST["comment"]);
date_default_timezone_set("Asia/Karachi");
$date=date("Y-m-d H:i:s");
$Product_Id=$_GET["id"];

if(empty($Name)||empty($Email) ||empty($Comment)){
    echo "All Fields are required";
    
}elseif(strlen($Comment)>500){
    echo "only 500  Characters are Allowed in Comment";
    
}else{

        $Query= query("INSERT INTO comments(date_time,name,email,comment,status,product_id)
    VALUES('$date','$Name','$Email','$Comment','ON','$Product_Id')");
    confirm($Query);
   set_message("Comment Added Successfully");
    
}   
    
}

}


function display_comment(){

$PostIdForComments=$_GET["id"];
$ExtractingCommentsQuery=query("SELECT * FROM comments
WHERE product_id='$PostIdForComments' AND status='ON' ");
confirm($ExtractingCommentsQuery);
while($DataRows=fetch_array($ExtractingCommentsQuery)){
    $CommentDate=$DataRows["date_time"];
    $CommenterName=$DataRows["name"];
    $Comments=$DataRows["comment"];

$comment= <<<DELIMETER
       <div class="row">
            <div class="col-md-12">
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
                {$CommenterName}
                <span class="pull-right">{$CommentDate}</span>
                <p>{$Comments}</p>
            </div>
        </div>

        <hr>
DELIMETER;
        echo $comment;






}



}






?>