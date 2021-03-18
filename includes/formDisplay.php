<?php
// Returns whether or not the form should be displayed on the index.php
//require("/home/stjamesk/dotcom/creds/creds.php");
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

$query = "SELECT form FROM `admin_functions`";
$success = mysqli_query($cnxn, $query);
// If query is unsuccessful, print to the page
if(!$success) {
    echo "$query";
    echo "<br><h4 class='text-center'>Something went wrong...</h4>";
// echo the response from the database
} else {
    $row = $success->fetch_assoc();
    echo $row['form'];
}