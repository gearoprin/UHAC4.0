<?php
session_start();
require("../database/dbconfig.php");
?>
<html>
<head>
	<?php
    include("../includes/header.php");
	?>
</head>
<body>
	<?php
	include("../includes/nav.php");
	?>
	  <main class="mdl-layout__content">
	    <div class="page-content">
		<form method="POST">
        <img src="../assets/img/sanguine.png" height="200"><br>

				<div class="mdl-textfield mdl-js-textfield">
		    <input class="mdl-textfield__input" type="text"  placeholder="E-mail" name="txt_uname_email" id="email" autofocus>
		    <label class="mdl-textfield__label" for="sample1">E-mail</label>
		  </div>

		<br>
					<div class="mdl-textfield mdl-js-textfield">
					<input class="mdl-textfield__input" type="password" placeholder="Password" name="txt_password" id="password">
					<label class="mdl-textfield__label" for="sample1">Password</label>
				</div>

				 <br>
					<select class="mdl-button  mdl-js-ripple-effect" id="type" name="slc">
					<option  value="FSO" selected="selected">---</option>
					<option value="Scholar">Scholar</option>
					<option value="Sponsor">Sponsor</option>
					</select>
				 <br><br>
				 <button type="submit" name="btn-login" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" id="btn">
		       LOGIN
		     </button>&nbsp;&nbsp;&nbsp;
				 <a href="signup.php"><button type="button" name="btn-reg" id="btn" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
					 Sign Up
				 </button></a><br><br>
				 <a href="fp.php">
					 Forgot Password
				 </a>

		</form>
	</div>
	  </main>
	</div>
	<!-- MDL Spinner Component -->
<?php
$conn=mysqli_connect('localhost','root','','powerbank') ;

if(!$conn){
	die("Connection Failed: ".mysqli_connect_error());
}
if(isset($_POST['btn-login'])){
	$slc = $_POST['slc'];
	$user_email = strip_tags($_POST['txt_uname_email']);
	$user_password = strip_tags($_POST['txt_password']);

if($slc == 'Scholar'){
	$sql="SELECT * FROM users WHERE (umail='$user_email' AND upass='$user_password')";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
	$id=$row[0];
	$user_email=$row[1];
	if($row[0] > 0){


		$_SESSION["umail"]=$user_email;
		$_SESSION["uid"]=$id;
		if($row['utype']=="Scholar"){
			header('location:profile.php');
		}
	}
	else{
		echo "<script>alert('Your email or password is incorrect.');window.location.href='login.php'</script>";
	}
}
if($slc == 'Sponsor'){
	$sql="SELECT * FROM users WHERE (umail='$user_email' AND upass='$user_password')";
	$res = mysqli_query($conn,$sql);
	$row = mysqli_fetch_array($res);
	$id=$row[0];
	$user_email=$row[1];
	if($row[0] > 0){
		session_start();
		$_SESSION["umail"]=$user_email;
		$_SESSION["uid"]=$id;
		if($row['utype']=="Sponsor"){
			header('location:profile2.php');
		}
	}
	else{
		echo "<script>alert('Your email or password is incorrect.');window.location.href='login.php'</script>";
	}
}
}
 include("../includes/scripts.php");
?>

</body>
</html>
