<?php
session_start();

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
<body>
  <!-- Always shows a header, even in smaller screens. -->
  <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
    <header class="mdl-layout__header">
      <div class="mdl-layout__header-row">
        <!-- Title -->
        <span class="mdl-layout-title">SANGUINE</span>
        <!-- Add spacer, to align navigation to the right -->
        <div class="mdl-layout-spacer"></div>
        <!-- Navigation. We hide it in small screens. -->
        <nav class="mdl-navigation">
          <a class="mdl-navigation__link" href="logout.php"><i class="material-icons">account_circle</i></a>

        </nav>
      </div>
    </header>
    <div class="mdl-layout__drawer">
      <span class="mdl-layout-title profile"><img src="../assets/img/e1.jpg"  height="90" width="90"></span>
      <nav class="mdl-navigation">
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
        <a class="mdl-navigation__link" href="">Link</a>
      </nav>
    </div>

<main class="mdl-layout__content">
<div class="page-content">

<form method="post">
LOGIN SUCCESS!

<?php
include("../includes/scripts.php");
?>
</body>
</html>
