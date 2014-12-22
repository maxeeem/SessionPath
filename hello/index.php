<?php
/*
* "Hello World!" example using SessionPath
*/
session_start();

$default = isset($_SESSION['default']) ? $_SESSION['default'] : null;
$name    = isset($_SESSION['name'])    ? $_SESSION['name']    : 'Stranger';
?>
<html>
<head>
<title>"Hello World!" example</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../js/sPath.js"></script>
<script type="text/javascript">sPathSet('../ajax/sPath.php');</script>
</head>
<body>
<center>

<?php if ($default) { ?>
<h3>This is the default output</h3>
<?php } ?>

<h1>Hello <?=$name?>!</h1>

Enter Name: <input type="text" id="name">
<button type="button" id="sPath">Go</button>
<br>
<a href='' onclick="sPath('name', 'John');">John</a>
&emsp;
<a href='' onclick="sPath('name', 'Jane');">Jane</a>
&emsp;
<a href='' onclick="sPath('example');">Default example</a>

</center>
</body>
</html>
