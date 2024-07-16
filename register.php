<?php
$title = "Register";
require "./include/guest/header.php";
require "classes/Session.php";
$session->redirectIfSession();
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link href="../../assets/css/register/style.css" rel="stylesheet">

<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-0">
        <div class="col-12">
            <div class="card card-registration card-registration-2" style="border-radius: 15px; background: linear-gradient(to right,white,white,white,white,white,white,white);">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <div class="olala p-3">
                                <?php include "./components/register-form.php" ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script src="./assets/js/register/index.js"></script>
<?php require "./include/guest/footer.php" ?>