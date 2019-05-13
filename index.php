<?php
/**
 * Created by PhpStorm.
 * User: jrakk
 * Date: 4/8/2019
 * Time: 2:16 PM
 */

    // Start seesion
    session_start();
    // Turn on error reporting
    ini_set('display_error', 1);
    error_reporting(E_ALL);

    //require autoload file
    require_once ('vendor/autoload.php');

    // create an instance of the base class
    $f3 = Base::instance();

    // Turn on Fat-free error reporting
    $f3->set('DEBUG', 3);


    $f3->set('options', array('This midterm is easy', 'I like midterms', 'Please help me'));


    $f3->route('GET /', function()
    {
        echo "<h1>Midterm Survey</h1>";
        echo "<a href='survey'>Take my Midterm Survey</a>";
    });

    $f3->route('GET|POST /survey', function($f3)
    {
        if(isset($_POST['name'])){
            $name = $_POST['name'];
            $option = $_POST['option'];

            $f3->set('name', $name);
            $f3->set('option', $option);

            $_SESSION['name'] = $name;
            $_SESSION['option'] = $option;



            $f3->reroute('/summary');
        }
        $view = new Template();
        echo $view->render("views/form1.html");
    });


    $f3->route('POST|GET /summary', function()
    {

        $view = new Template();
        echo $view->render("views/results.html");
    });

    // Run Fat-Free
    $f3->run();
