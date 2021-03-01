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
            require('/home/stjamesk/dotcom/creds/creds.php');

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

}