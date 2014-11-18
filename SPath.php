<?php
/*
* AJAX-proxy for SessionPath
*
* GET  sets session variables
* POST restores session to previos state
*/
$allowed = array('default', 'name');

session_start();

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $snapshot = array();
        foreach ($allowed as $key) {
            if (isset($_SESSION[$key])) $snapshot[$key] = $_SESSION[$key];
        }
        $destination = $snapshot;
        
        if (isset($_GET['key']) && !isset($_GET['value'])) {
            switch ($_GET['key']) {
                case 'example':
                    $_SESSION['default']    = true;
                    $_SESSION[$_GET['key']] = 'World';
                    
                    $destination['default']    = $_SESSION['default'];
                    $destination[$_GET['key']] = $_SESSION[$_GET['key']];
            }
        } elseif (isset($_GET['key']) && isset($_GET['value'])) {
            $_SESSION[$_GET['key']] = $_GET['value'];
            $destination[$_GET['key']] = $_GET['value'];
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