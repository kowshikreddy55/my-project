<?php 
require_once("../../config.php");

if (isset($_GET['product_id'])) {
$product_id = escape_string( $_GET['product_id']);

$query = query("DELETE from products WHERE product_id={$product_id}");

confirm($query);
set_message("Product Successfully Deleted");
redirect("../../../public/admin/index.php?products");



	# code...
}
else
{
	redirect("../../../public/admin/index.php?products");


}









?>