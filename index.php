<?php
$title = "Dashboard";

require "include/auth/header.php";

require "classes/Session.php";

$session->auth->notVerified();

$session->checkSession($_SESSION['user']['role'] != 1, "admin/");
?>

<h1>Hey, <?= $_SESSION['user']['username'] ?>, you're a USER </h1>
you are now at the home page
<button id=logout>Logout</button>

<script type="text/javascript" src="assets/js/index.js"></script>

<?php require "include/auth/header.php" ?>