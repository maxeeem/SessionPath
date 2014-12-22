<?php
/*
* SessionPath navigation example
*
* @author Maxim Vitoshka-Tarasov
*/
session_start();

/*
* (re)set defaults
*
* reset any defaults here if needed
*/
if (isset($_SESSION['name'])) {
    unset($_SESSION['name']);
}
?>
<html>
<head>
<title>SessionPath navigation example</title>
</head>
<body>
<center>
<h3><a href="./hello">Hello World example</a></h3>
</center>
</body>
</html>
