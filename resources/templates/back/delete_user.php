<?php 
require_once("../../config.php");

if (isset($_GET['user_id'])) {
$user_id = escape_string( $_GET['user_id']);

$query = query("DELETE from users WHERE user_id={$user_id}");

confirm($query);
set_message("user Successfully Deleted");
redirect("../../../public/admin/index.php?users");



	# code...
}
else
{
	redirect("../../../public/admin/index.php?users");


}









?>