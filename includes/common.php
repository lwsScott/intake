<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
// This class is able to display all records and delete individual ones
class Common
{
    // this function returns all the records
    public function getAllRecords($conn) {
        $query = "SELECT * FROM outreach_form";
        $result = $conn->query($query) or die("Error in query1".$conn->error);
        return $result;
    }

    // this function deletes a record by id and removes any associated images
    public function deleteRecordById($conn,$recordId) {
        $imageQuery = "SELECT `Attachments` FROM `outreach_form` WHERE id='$recordId'";
        $imagePath = $conn->query($imageQuery) or die("Error in query2".$conn->error);
        $path = mysqli_fetch_array($imagePath);
        var_dump($path);
        if ($path[0] != "uploads/") {
            unlink("/home2/lscottgr/public_html/intake/$path[0]");
            //unlink("/home/dotcomgr/public_html/$path[0]");
        }
        $query = "DELETE FROM outreach_form WHERE id='$recordId'";
        $result = $conn->query($query) or die("Error in query3".$conn->error);
        return $result;
    }
}