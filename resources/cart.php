
<?php require_once("config.php")         ?> 


<?php 

 if (isset($_GET['add'])) {

// $_SESSION['product_'.$_GET['add']] += 1 ; // add one everytime when we click on add button


// redirect("index.php");



   $query = query("SELECT * FROM products WHERE product_id=" . $_GET['add'] ." ");


confirm($query);

while ($row = fetch_array($query)) {

if ( ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) && ($row['product_quantity'] > $_SESSION['product_' . $_GET['add']]) ) {

 $_SESSION['product_'.$_GET['add']] += 1 ; // add one everytime when we click on add button
redirect("../public/checkout.php");
}
else {

set_message("We only have {$row['product_quantity']} " .$row['product_title']." "."items available" );
redirect("../public/checkout.php");

}   # code...
}
    # code...
 }




 if (isset($_GET['remove'])) {
         $_SESSION['product_'.$_GET['remove']]-- ;

    if ( $_SESSION['product_'.$_GET['remove']] < 1) {
unset($_SESSION['total_price']);
unset($_SESSION['total_quantity']);
redirect("../public/checkout.php");

}
else
{

    redirect("../public/checkout.php");

}

}


 if (isset($_GET['delete'])) {


  $_SESSION['product_'.$_GET['delete']] = '0'  ;

unset($_SESSION['total_price']);
unset($_SESSION['total_quantity']);
redirect("../public/checkout.php");


}



function cart(){

$total= 0;
$item_quantity=0;
$sub_total=0;

// variable for paypal in below form 

$item_name =1;
$item_number= 1;
$amount =1;
$quantity=1;
 //
foreach ($_SESSION as $name => $value) {
    if ($value > 0) { //display only items when items added>0

 if(substr($name, 0,8) == "product_"){

    $length = strlen($name - 8); //get the length after 'product_'
    $id = substr($name ,8 ,$length); //get the value after product_

$query =  query("SELECT * FROM products WHERE product_id = {$id}");
confirm($query);

while($row = fetch_array($query)){
$product_image = display_image($row['product_img']); 
$sub_total = $row['product_price'] *$value;
$item_quantity+= $value;
$product = <<<DELIMETER

   <tr>
 <td>{$row['product_title']}<br>
 <img class='img-responsive thumbnail' src='../resources/{$product_image}' alt="" width="100">
  </td>
<td>&#8377;{$row['product_price']}</td>
 <td>{$value}</td>
<td>&#8377;{$sub_total}</td>
 <td><a class= "btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class='glyphicon glyphicon-plus'></span></a>
 <a class= "btn btn-warning"  href="../resources/cart.php?remove={$row['product_id']}"><span class='glyphicon glyphicon-minus'></span></a>
  <a class= "btn btn-danger"href="../resources/cart.php?delete={$row['product_id']}"><span class='glyphicon glyphicon-remove'></span></a>
   
   </td>

  </tr>


   <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
  <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
  <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
  <input type="hidden" name="quantity_{$quantity}" value="{$value}">



DELIMETER;
  echo $product;

// to increase every time after loop in  paypal abouve form for uniqueness
$item_name ++;
$item_number++;
$amount ++;
$quantity++;

    }
 $_SESSION['total_price']= $total += $sub_total;
  $_SESSION['total_quantity'] =$item_quantity;
   }
}

    # code...

 }




}


function show_paypalbutton(){ 

if (isset( $_SESSION['total_quantity']) &&  $_SESSION['total_quantity']>=1) {
    # code...

$paypal_button = <<<DELIMETER
   <input type="image" class="" name="upload"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="PayPal - The safer, easier way to pay online">

DELIMETER;
return $paypal_button;


}
}



function process_transaction(){


//orders
if (isset($_GET['tx'])) {

$amount = $_GET['amt'];
$currency = $_GET['cc'];
$transaction= $_GET['tx'];;
$status =$_GET['st'];

// $send_order= query("INSERT INTO orders (order_amount,order_transaction, order_status, order_currency) VALUES ('{$amount}','{$transaction}','{$status}','{$currency}')");

// $last_id= last_id();

// confirm($send_order);







//report functionaliy
$total= 0;
$item_quantity=0;

foreach ($_SESSION as $name => $value) {
    if ($value > 0) { //display only items when items added>0

 if(substr($name, 0,8) == "product_"){

    $length = strlen($name - 8); //get the length after 'product_'
    $id = substr($name ,8 ,$length); //get the value after product_


// orders

     $send_order= query("INSERT INTO orders (order_amount,order_transaction, order_status, order_currency) VALUES ('{$amount}','{$transaction}','{$status}','{$currency}')");

 $last_id= last_id();

confirm($send_order);















$query =  query("SELECT * FROM products WHERE product_id = {$id}");
confirm($query);

while($row = fetch_array($query)){
$product_price =$row['product_price'];
$product_quantity=$row['product_quantity'];
$sub_total = $row['product_price'] *$value;
$item_quantity+= $value;
$product_title =$row['product_title'];

$insert_report= query("INSERT INTO reports (product_id,order_id,product_title,product_price, product_quantity) VALUES ('{$id}','{$last_id}','{$product_title}','{$product_price}','{$value}')");
confirm($insert_report);

    }
  $total += $sub_total;
 echo $item_quantity;
   }
}

    # code...

 }


session_destroy(); // to avoid insertion of same order again and again on page refresh refresh

}


else{

  redirect("index.php");
}




}












?>