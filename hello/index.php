<?php
/*
* "Hello World!" example using SessionPath
*/
session_start();
?>
<html>
<head>
<title>"Hello World!" example</title>
<script src="../js/sPath.js"></script>
<script type="text/javascript">sPathAJAX('../ajax/sPath.php');</script>
</head>
<body>
<a href="../">Home</a>
<center>

<?php 
if ($_SESSION['name'] == 'default') 
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
<a style="cursor:pointer" onclick="sPath('example');">DEFAULT</a>
&emsp;
<a style="cursor:pointer" onclick="sPath('name', 'everyone');">Everyone</a>
&emsp;
<a style="cursor:pointer" onclick="sPath('name', 'john');">John Doe</a>

</center>
</body>
</html>
