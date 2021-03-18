<?php
// Form set operates upon the toggle in the control page
//require("/home/stjamesk/dotcom/creds/creds.php");
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

// Set the form to the value of the toggle selected on the form page
$query = "UPDATE `admin_functions` SET `form` =";
$query = $query.$_POST['display'];
echo $query;
$success = mysqli_query($cnxn, $query);
// Echo out if the query was unsuccessful
if (!$success) {
    echo "<br><h4 class='text-center'>Something went wrong...</h4>";
}