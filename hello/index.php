<?php
/*
* "Hello World!" example using SessionPath
*/
session_start();

$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Stranger';
?>
<html>
<head>
<title>"Hello World!" example</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js/sPath.js"></script>
<script type="text/javascript">sPathAJAX('../ajax/sPath.php');</script>
</head>
<body>
<center>

<h1>Hello <?=$name?>!</h1>

<br>
<a href='' onclick="sPath('name');">Default example</a>
&emsp;
<a href='' onclick="sPath('name', 'John Doe');">John Doe</a>
&emsp;
<a href='' onclick="sPath('name', 'Everyone');">Everyone</a>

</center>
</body>
</html>
