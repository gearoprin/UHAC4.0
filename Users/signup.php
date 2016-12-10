<?php
session_start();

if(isset($_SESSION['umail'])){ //if login in session is not set
    header("Location:../index.php");
}

require('class_user.php');
$user = new USER();

if(isset($_POST['btn-signup'])){
	$FN = strip_tags($_POST['fname']);
	$LN = strip_tags($_POST['lname']);
	$UMail = strip_tags($_POST['umail']);
	$UPass = strip_tags($_POST['upass']);
	$RUPass = strip_tags($_POST['rupass']);
	$UType = strip_tags($_POST['utype2']);
	$BDay = strip_tags($_POST['bday']);
	$Gen = strip_tags($_POST['gender2']);
	$Cont = strip_tags($_POST['cont']);
/*----------------------FULL     NAME-------------------------------------*/
	if($FN=="")	{
		$error[] = "provide First Name!";
	}
	else if($LN=="")	{
		$error[] = "provide Last Name!";
	}
/*--------------------------USER------------------------------------------*/
	if($UType=="")	{
		$error[] = "Select User Type!";
	}
	if($BDay=="") {
		$error[] = "Provide Birthday!";
	}
	if($Gen=="") {
		$error[] = "Select Gender!";
	}
	if($Cont=="") {
		$error[] = "Select Contact Number!";
	}
/*----------------------USER EMAIL/PASS-----------------------------------*/
	if($UMail=="")	{
		$error[] = "provide E-Mail!";
	}
	else if(!filter_var($UMail, FILTER_VALIDATE_EMAIL))	{
	    $error[] = 'Please enter a valid email address!';
	}
	if($UPass=="")	{
		$error[] = "provide Password!";
	}
	else if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z]{6,}$/', $UPass))
	{
		?>
		<script type='text/javascript'>
    	alert("The password does not meet the requirements!\nPassword Requirements:\n* Must include at least one letter.\n* Must include at least one number.\n* Must not contain any special characters.\n* Must not be less than 6 characters.")
		</script>
		<?php
	}
	if($RUPass!=$UPass)	{
		?>
		<script>
		alert("Wrong password");
		</script>
		<?php
	}

	else
	{
		try
		{
			$sql = "SELECT fname,lname,umail,upass,utype,bday,gender,contno FROM users WHERE umail=:ue";
			$stmt = $user->runQuery($sql);
			$stmt->execute(array(':ue'=>$UMail));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			if($row['umail']==$UMail) {
				$error[] = "E-Mail already used";
			}
			else{
				if($user->register($FN,$LN,$UMail,$UPass,$UType,$BDay,$Gen,$Cont)){
					$user->redirect('signup.php?joined');
					?>
					<script>
						alert("You are now registered!");
					</script>
					<?php
					header("Location: login.php");
				}
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}
}
?>
<html>
<head>
<?php
  include("../includes/header.php");
?>
<script>
  $(document).ready(function() {
    $("#utype2").change(function(){
      $("#utype_hidden").val(("#utype2").find(":selected").text());
    });
  });
</script>
<script>
  $(document).ready(function() {
    $("#gender2").change(function(){
      $("#gender_hidden").val(("#gender2").find(":selected").text());
    });
  });
</script>
</head>
<body>
  <?php
	include("../includes/nav.php");
	?>
  <main class="mdl-layout__content">
    <div class="page-content">


  <form method="POST">
      <img src="../assets/img/sanguine.png" height="100" width="100"><br>
		<div class="mdl-textfield mdl-js-textfield">
		<input class="mdl-textfield__input" type="text"  placeholder="First Name" name="fname" id="fname">
		<label class="mdl-textfield__label" for="First Name">First Name</label>
		</div>

		<br>

		<div class="mdl-textfield mdl-js-textfield">
		<input class="mdl-textfield__input" type="text"  placeholder="Last Name" name="lname" id="lname">
		<label class="mdl-textfield__label" for="sample1">Last Name</label>
		</div>

		<br>

		<div class="mdl-textfield mdl-js-textfield">
		<input class="mdl-textfield__input" type="email"  placeholder="E-mail" name="umail" id="email">
		<label class="mdl-textfield__label" for="sample1">E-mail</label>
		</div>

		<br>
        <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="password" placeholder="Password" name="upass" id="password">
        <label class="mdl-textfield__label" for="sample1">Password</label>
		</div>

        <br>

        <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="password" placeholder="Re-type Password" name="rupass" id="password2">
        <label class="mdl-textfield__label" for="sample1">Re-type Password</label>
		</div>

		<br>

		<div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="date" name="bday" placeholder="Birthday" id="bday">
        <label class="mdl-textfield__label" for="sample1">Birthday</label>
		</div>

		<br>

		<select class="mdl-button  mdl-js-ripple-effect" name="gender2" id="gender2">
		<option value="FSO" selected="selected">---Gender---</option>
		<option value="Male">Male</option>
		<option value="Female">Female</option>
		</select>

		<br>

		<div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="text" placeholder="Contact Number" name="cont" id="cont">
        <label class="mdl-textfield__label" for="sample1">Contact Number</label>
		</div>

		<br>
    <input type="hidden" name="gender" id="gender_hidden">
    <br>
		<select class="mdl-button  mdl-js-ripple-effect" name="utype2" id="utype2">
		<option value="FSO" selected="selected">---</option>
		<option value="Scholar">Scholar</option>
		<option value="Sponsor">Sponsor</option>
		</select>
		<input type="hidden" name="utype" id="utype_hidden">

       <br>
       <button type="submit" name="btn-signup" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
         REGISTER
       </button>&nbsp;&nbsp;&nbsp;
       <a href="login.php"><button type="button" name="btn-back" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
         BACK
       </button></a><br><br>

  </form>
</div>
  </main>
</div>
<?php
include("../includes/scripts.php");
?>
</body>
</html>
