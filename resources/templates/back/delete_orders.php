<?php 
require_once("../../config.php");

if (isset($_GET['order_id'])) {
$order_id = escape_string( $_GET['order_id']);

$query = query("DELETE from orders WHERE order_id={$order_id}");

confirm($query);
set_message("Order Successfully Deleted");
redirect("../../../public/admin/index.php?orders");



	# code...
}
else
{
	redirect("../../../public/admin/index.php?orders");


}









?>