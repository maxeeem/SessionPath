<?php
/*
* "Hello World!" example using SessionPath
*/
session_start();
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

<?php 
if (!isset($_SESSION['name'])) 
{ 
?>
  <h1>Hello World!</h1>

<?php 
} 
else 
{ 
  include $_SESSION['name'].'.php'; 
} 
?>

<br>
<a href='' onclick="sPath('name');">Default example</a>
&emsp;
<a href='' onclick="sPath('name', 'john');">John Doe</a>
&emsp;
<a href='' onclick="sPath('name', 'everyone');">Everyone</a>

</center>
</body>
</html>
