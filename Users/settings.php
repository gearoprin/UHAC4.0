<?php
session_start();
?>
<?php
if(!isset($_SESSION['umail'])){ //if login in session is not set
    header("Location:login.php");
}
?>
<html>
<head>
<?php
  include("../includes/header.php");
?>
</head>
<form method="post">
<body>
<?php
	include("../includes/nav.php");
?>
Birthday: <div class="mdl-textfield mdl-js-textfield"><input type="date">
</div>
Gender: <div class="mdl-textfield mdl-js-textfield"><select>
<option>Male</option>
<option>Female</option>
</select>
</div>
Contact Number: <div class="mdl-textfield mdl-js-textfield"><input type="text">
</div>
<?php
include("../includes/scripts.php");
?>
</body>
</html>