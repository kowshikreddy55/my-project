<?php 
require_once("../../config.php");

if (isset($_GET['cat_id'])) {
$category_id = escape_string( $_GET['cat_id']);

$query = query("DELETE from categories WHERE cat_id={$category_id}");

confirm($query);
set_message("Category Successfully Deleted");
redirect("../../../public/admin/index.php?categories");



	# code...
}
else
{
	redirect("../../../public/admin/index.php?categories");


}









?>