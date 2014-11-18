<?php
/*
* AJAX-proxy for SessionPath
*
* GET  sets session variables
* POST restores session to previos state
*/
session_start();

$allowed = array('default', 'name');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $snapshot = array();
        foreach ($allowed as $key) {
            if (isset($_SESSION[$key])) $snapshot[$key] = $_SESSION[$key];
        }
        $destination = $snapshot;
        
        /*
        * simple route
        */
        if (isset($_GET['key']) && isset($_GET['value'])) {
            $_SESSION[$_GET['key']] = $_GET['value'];
            $destination[$_GET['key']] = $_GET['value'];
        } 
        /*
        * complex routes that require setting of more than one parameter
        */
        elseif (isset($_GET['key']) && !isset($_GET['value'])) {
            switch ($_GET['key']) {
                case 'example':
                    $_SESSION['default']    = true;
                    $_SESSION[$_GET['key']] = 'World';
                    
                    $destination['default']    = $_SESSION['default'];
                    $destination[$_GET['key']] = $_SESSION[$_GET['key']];
            }
        }

        print json_encode(array('status' => 'OK', 'source' => $snapshot, 'destination' => $destination));

    case 'POST':
        if (isset($_POST['snapshot'])) {
            $snapshot = $_POST['snapshot'];
            foreach ($allowed as $key) {
                if (isset($snapshot[$key])) {
                    $_SESSION[$key] = $snapshot[$key];
                }
            }
            print "READY";
        } else {
            print "ERROR - No snapshot provided";
        }
}

session_write_close();
