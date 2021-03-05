<?php
//require "/home/stjamesk/dotcom/creds/creds.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../db.php";

include_once "common.php";
// if record is set in the $_GET array, then delete the row
if (isset($_GET['recordId'])) {
    $recordId = $_GET['recordId'];
    // construct a new Common() class
    $common = new Common();
    // delete the row
    //$delete = $common->deleteRecordById($conn, $recordId);
    $delete = $common->deleteRecordById($cnxn, $recordId);
    // if delete works, redirect page back to control page
    if ($delete) {
        //echo '<script>window.location.href="../control.php";</script>';
        echo '<script>window.location.href="../control";</script>';

    }
}
