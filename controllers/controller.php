<?php

/**
 * Class Controller
 * This class controls the templating access
 * @author Lewis Scott
 * @version 1.0
 * @date 3/1/21
 */
class IntakeController
{
    private $_f3; //router
    private $_validator; //validation object

    /**
     * Controller constructor.
     * @param $f3
     * @param $validator
     */
    public function __construct($f3, $validator)
    {
        $this->_f3 = $f3;
        $this->_validator = $validator;
    }

    public function home($f3)
    {

        session_start();
        //get the username and make it lowercase
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = strtolower(trim($_POST['username']));
            $password = trim($_POST['password']);
            //get login credentials
            //require('/home/stjamesk/dotcom/creds/creds.php');
            require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";

            //checks to see if username and password are correct and if they are creates a session
            if ($username == $adminUser && $password == $adminPassword) {
                $_SESSION['loggedin'] = true;
                $_SESSION['page'] = 'control.php';
                header("location: " . $_SESSION['page']);
            }
            $err = true;
        }
        include('includes/head.html');

        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/home.html');
    }

    public function admin($f3)
    {

        // Start session
        session_start();

        // Checks to see if logged in. If not - redirects to index.php
        if (!isset($_SESSION['loggedin'])) {
            // Store the page that I am currently on in the session
            $_SESSION['page'] = $_SERVER['SCRIPT_URI'];
            header("location: login.php");
        }
        // Include header file
        include("includes/head.html");
        //require("/home/stjamesk/dotcom/creds/creds.php");
        //require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
        //require_once $_SERVER['DOCUMENT_ROOT']."/../db.php";
        $database = new Database();
        $requests = $database->getRequests();

        $f3->set('requests', $requests);
        /*
        // Select column data from the database table
        $sql = "SELECT `completed`, `id`, `date`, `FirstName`, `LastName`, `Phone`, `Email`, 
                                `Address`, `AddressTwo`, `City`, `Zip`, `HelpList`, `Comments`, `Note`, `Attachments`
                                from outreach_form ORDER BY Date DESC";
        $result = $cnxn->query($sql);
        */
        //if submitted login form
        $template = new Template();
        echo $template->render('views/control.php');
    }
    public function form($f3)
    {
        include('includes/head.html');

        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/form.php');
    }

    public function logout($f3)
    {
        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/logout.php');
    }

    public function getinvolved($f3)
    {
        include('includes/head.html');

        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/getinvolved.php');
    }

    public function resources($f3)
    {
        include('includes/head.html');

        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/resources.php');
    }

    public function confirmation($f3)
    {
        // session start();
        include('includes/head.html');
        require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
        //require_once '/home2/lscottgr/db.php';
        //require_once $_SERVER['DOCUMENT_ROOT'] . "/../db.php";
        //require("/home/stjamesk/dotcom/creds/creds.php");
        /*
        if ($_SERVER['USER'] == 'lscottgr')
        {
            require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
            require_once $_SERVER['DOCUMENT_ROOT']."/../db.php";
        }
        else {
            require_once $_SERVER['DOCUMENT_ROOT']."/../config.php";
        }
        */

        require("includes/formFunctions.php");

        $target_file = "";
        //if (!(empty($_FILES))) {
        if ((isset($_FILES))) {

            echo '<pre>';
            // init image file path
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["myfile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if (isset($_POST["submit"]) && ($target_file != $target_dir)) {
                $check = getimagesize($_FILES["myfile"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
                //}

                // Check if file already exists
                if (file_exists($target_file) && ($target_file != $target_dir)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size
                if ($_FILES["myfile"]["size"] > 10000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["myfile"]["tmp_name"], $target_file)) {
                        echo "The file " . htmlspecialchars(basename($_FILES["myfile"]["name"])) . " has been uploaded.";
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                echo "</pre>";
            }
        }
        $isValid = true;

        // Check first name
        $fname = "";
        if (validName($_POST['fname'])) {
            $fname = $_POST['fname'];
        } else {
            echo "<br><h4 class='text-center'>Invalid first name</h4>";
            $isValid = false;
        }

        // Check last name
        $lname = "";
        if (validName($_POST['lname'])) {
            $lname = $_POST['lname'];
        } else {
            echo "<br><h4 class='text-center'>Invalid last name</h4>";
            $isValid = false;
        }

        // Check assistance
        $assistance = "";
        $other = "";
        $checkAssist = $_POST['otherTextInput'];
        if (validAssist($_POST['assistance']) && $checkAssist != "") {
            $assistance = implode(", ", $_POST['assistance']);
            $other = $_POST['otherTextInput'];
        } else if (validAssist($_POST['assistance'])) {
            $assistance = implode(", ", $_POST['assistance']);
        } else if ($checkAssist != "" && (!isset($_POST['assistance']))) {
            $other = $_POST['otherTextInput'];
        } else {
            echo "<br><h4 class='text-center'>Invalid Assistance</h4>";
            $isValid = false;
        }

        // Check email and phone number
        $email = "";
        $phone = "";
        $emailCheck = $_POST['emailFrom'];
        $phoneCheck = $_POST['phone'];
        // Check that phone number and email are valid and not empty
        if ($phoneCheck != "" && $emailCheck != "") {
            if ((validEmail($emailCheck)) && (validPhone($phoneCheck))) {
                $email = $emailCheck;
                $phone = $phoneCheck;
            } else if ((!validEmail($emailCheck)) && (validPhone($phoneCheck))) {
                echo "<br><h4 class='text-center'>Please provide a valid email </h4>";
                $isValid = false;
            } else if ((validEmail($emailCheck)) && (!validPhone($phoneCheck))) {
                echo "<br><h4 class='text-center'>Please provide a valid phone number </h4>";
                $isValid = false;
            } else {
                echo "<br><h4 class='text-center'>Please provide a valid phone number </h4>";
                echo "<br><h4 class='text-center'>Please provide a valid email </h4>";
                $isValid = false;
            }
        } else if ($phoneCheck != "") {
            if (validPhone($phoneCheck)) {
                $phone = $phoneCheck;
            } else {
                echo "<br><h4 class='text-center'>Please provide a valid phone number </h4>";
                $isValid = false;
            }
        } else if ($emailCheck != "") {
            if (validEmail($emailCheck)) {
                $email = $emailCheck;
            } else {
                echo "<br><h4 class='text-center'>Please provide a valid email </h4>";
                $isValid = false;
            }
        } else {
            echo "<br><h4 class='text-center'>Please provide either an email or phone number</h4>";
            $isValid = false;
        }

        // Check zip
        $zip = "";
        if (validZip($_POST['zip'])) {
            $zip = $_POST['zip'];
        } else {
            echo "<br><h4 class='text-center'>Invalid Zip</h4>";
            $isValid = false;
        }

        // Checks if isValid is not true
        if (!$isValid) {
            return;
        }

        $addressOne = $_POST['address'];
        $addressTwo = $_POST['addressTwo'];
        $city = $_POST['city'];
        $comment = $_POST['inComment'];

        // Set other if checked
        if ($other !== "") {
            $assistanceMore = $assistance . " Other: " . $other;
        } else {
            $assistanceMore = $assistance;
        }

        // Prevent SQL injection
        $fname = mysqli_real_escape_string($cnxn, $fname);
        $lname = mysqli_real_escape_string($cnxn, $lname);
        $phone = mysqli_real_escape_string($cnxn, $phone);
        $addressOne = mysqli_real_escape_string($cnxn, $addressOne);
        $addressTwo = mysqli_real_escape_string($cnxn, $addressTwo);
        $city = mysqli_real_escape_string($cnxn, $city);
        $zip = mysqli_real_escape_string($cnxn, $zip);
        $assistanceMore = mysqli_real_escape_string($cnxn, $assistanceMore);
        $comment = mysqli_real_escape_string($cnxn, $comment);


        // Send data to database
        $sql = "INSERT INTO outreach_form 
                (`completed`, `FirstName`, `LastName`, `Phone`, `Email`, `Address`, `AddressTwo`, 
                `City`, `Zip`, `HelpList`, `Comments`, `Attachments`) 
                VALUES (0, '$fname', '$lname', '$phone', 
                '$email', '$addressOne', '$addressTwo', '$city', '$zip', '$assistanceMore', '$comment', '$target_file');";

        // Test if query was successful
        $success = mysqli_query($cnxn, $sql);
        //echo $success;
        if (!$success) {
            echo "<br><h4 class='text-center'>Something went wrong...</h4>";
        }

        // Format data to be more easily read
        //$to = "bchadwick@mail.greenriver.edu";
        $to = "lscott19@mail.greenriver.edu";
        $headers = '';
        $headers .= "Reply-To: Peter Ostrander <lscott19@mail.greenriver.edu>\r\n";
        $headers .= "Return-Path: Peter Ostrander  <lscott19@mail.greenriver.edu>\r\n";
        $headers .= "From: Peter Ostrander <lscott19@mail.greenriver.edu>\r\n";
        $headers .= "Organization: St. James Outreach\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

        $subject = "Form completed";
        $message = "Form completed by: $fname $lname \r\n";
        $message .= "Phone: $phone\n";
        $message .= "Email: $email\n\n";
        $message .= "Address: $addressOne $addressTwo\n";
        $message .= "City: $city\n";
        $message .= "Zip: $zip \n\n";
        $message .= "Assistance Required: $assistance\n";
        $message .= "Other: $other\n";
        $message .= "Message: $comment";

        // Email data
        $confirmEmail = "Thank you for submitting your form, " . $fname . "\n\n" . $message;
        $confirmEmailSubject = "St.James Application";
        mail($to, $subject, $message, $headers);
        mail($email, $confirmEmailSubject, $confirmEmail, $headers);

        //$database = new Database();
        //if submitted login form
        $template = new Template();
        echo $template->render('views/confirmation.php');
    }

}