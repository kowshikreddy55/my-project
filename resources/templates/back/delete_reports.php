<?php 
require_once("../../config.php");

if (isset($_GET['report_id'])) {
$report_id = escape_string( $_GET['report_id']);

$query = query("DELETE from reports WHERE report_id={$report_id}");

confirm($query);
set_message("report Successfully Deleted");
redirect("../../../public/admin/index.php?reports");



	# code...
}
else
{
	redirect("../../../public/admin/index.php?reports");


}









?>