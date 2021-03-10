<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 3/9/2018
 * Time: 11:31 AM
 */
require("/home/stjamesk/dotcom/creds/creds.php");

//require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
//require_once $_SERVER['DOCUMENT_ROOT']."/../db.php";

//echo DB_DSN;
//echo DB_USERNAME;
//echo DB_PASSWORD;
/**
 * Class Database, preforms sql statements to insert/delete/update/view
 */
class Database
{
    protected $dbh;
    public $id;

    /**
     * Database constructor. connects to the database
     */
    function __construct()
    {
        try {
            //Instantiate a database object
            $this->dbh = new PDO(DB_DSN, DB_USERNAME,
                DB_PASSWORD);
            //echo "Connected to database!!!";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * getter for a single guest to edit
     * @param $id , the guest id
     * @return array row, values of the guest
     */
    function getRequestDetails($id)
    {
        // Define the query
        $sql = "SELECT * FROM outreach_form WHERE id = $id";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * getter for all the requests in the outreach_form database table
     * @return array of requests
     */
    function getRequests()
    {
        // Define the query
        $sql = "SELECT * FROM outreach_form ";
        // Prepare the statement
        $statement = $this->dbh->prepare($sql);
        // Execute the statement
        $statement->execute();
        // Process the result
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

}


