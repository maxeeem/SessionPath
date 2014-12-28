<?php
/*
* AJAX-proxy for SessionPath
*
* GET  sets session variables
* POST restores session to previos state
*/
session_start();

$allowed = array('name', 'example');

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
            $_SESSION[$_GET['key']]    = $_GET['value'];
            $destination[$_GET['key']] = $_GET['value'];
        } 
        /*
        * custom routes
        */
        elseif (isset($_GET['key']) && !isset($_GET['value'])) {
            switch ($_GET['key']) {
                case 'example':
                    $_SESSION['name']    = 'default';
                    $destination['name'] = 'default';
            }
        }

        print json_encode(array('status' => 'OK', 'source' => $snapshot, 'destination' => $destination));
        break;

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
        break;
}

session_write_close();
