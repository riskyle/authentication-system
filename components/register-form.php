<form action="" method="POST" id="register-form" class="needs-validation">
    <h3 class="header mb-2 mt-3">Personal
        Information</h3>
    <div class="row"> <!-- firstname  and lastname row -->
        <!-- firstname -->
        <div class="col-md-3 mb-0">
            <div class="form-floating mb-3">
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" minlength="3" maxlength="20" name="firstname" id="firstname" value="" autofocus required />
                <label for='floatingInput' id="firstname-label">Firstname</label>
                <span class="text-danger fs-6" id="is-valid-firstname"></span>
            </div>
        </div>

        <!-- middlename -->
        <div class="col-md-3 mb-0">
            <div class="form-floating mb-3">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="2" maxlength="20" name="middlename" id="middlename" autofocus />
                <label for='floatingInput' id="middlename-label">Middlename</label>
                <span class="text-danger" id="is-valid-middlename"></span>
            </div>
        </div>

        <!-- lastname -->
        <div class="col-md-3 mb-0">
            <div class="form-floating mb-3">
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="3" maxlength="20" name="lastname" id="lastname" autofocus required />
                <label for='floatingInput' id="lastname-label">Lastname</label>
                <span class="text-danger fs-6" id="is-valid-lastname"></span>
            </div>
        </div>

        <!-- suffix name -->
        <div class="col-md-3 mb-0">
            <div class="form-floating mb-3">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="2" maxlength="3" name="suffix" id="suffix" autofocus />
                <label for='floatingInput' id="suffix-label">Suffix
                </label>
                <span class="text-danger fs-6" id="is-valid-suffix"></span>
            </div>
        </div>
    </div>

    <!-- sex -->
    <div class="row g-3">
        <div class="col-md-2 pb-2">
            <div class="form-floating">
                <select class="form-select form-select mb-3" id="sex" aria-label="Large select example" name="sex">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <label for="floatingSelect">Sex</label>
            </div>
        </div>

        <!-- birthdate -->
        <div class="col-md-3 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input type="date" value="" min="1960" max="2030" id="birthdate" name="birthdate" class="form-control input-sm" id="floatingstart" placeholder="Birthdate" autofocus required />
                <label id="birthdate-label">Birthdate</label>
            </div>
        </div>

        <!-- auto-generate age depends on birthdate -->
        <div class="col-md-1 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" min="18" max="150" name="age" id="age" readonly autofocus required />
                <label for='floatingInput' id="age-label">Age</label>
                <span class="text-danger fs-6" id="is-valid-age"></span>
            </div>
        </div>

        <!-- mobile number -->
        <div class="col-md-2 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="3" maxlength="13" name="mobilenum" id="mobilenum" autofocus required />
                <label for='floatingInput' id="mobilenum-label">Mobile Number</label>
                <span class="text-danger fs-6" id="is-valid-mobilenum"></span>
            </div>
        </div>

        <!-- email address -->
        <div class="col-md-4 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm" type="text" name="email" id="email" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" style="border: <?= isset($message['error-email']) ? "1px solid red" : "" ?>" minlength="5" maxlength="60" autofocus required />
                <label for='floatingInput' style="color: <?= isset($message['error-email']) ? "red" : "" ?>" id="email-label">Email</label>
                <span class="text-danger fs-6" id="is-valid-email">
                    <?= $message['error-email'] ?? null ?>
                </span>
            </div>
        </div>
    </div>


    <h3 class="header mt-0">
        Address
        Information</h3>
    <div class="row g-3">
        <!-- Purok -->
        <div class="col-md-4 mb-0">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="1" maxlength="20" name="purok" id="purok" autofocus required />
                <label for='floatingInput' id="purok-label">Purok/Street</label>
                <span class="text-danger fs-6" id="is-valid-purok"></span>
            </div>
        </div>

        <!-- barangay -->
        <div class="col-md-4 mb-0">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="1" maxlength="20" name="barangay" id="barangay" autofocus required />
                <label for='floatingInput' id="barangay-label">Barangay</label>
                <span class="text-danger fs-6" id="is-valid-barangay"></span>
            </div>
        </div>

        <!-- zipcode -->
        <div class="col-md-4 mb-0">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm" type="text" value="" placeholder=".form-control-sm" aria-label=".form-control-sm example" name="zipcode" id="zipcode" autofocus required />
                <label for='floatingInput' id="zipcode-label">Zipcode</label>
                <span class="text-danger fs-6" id="is-valid-zipcode"></span>
            </div>
        </div>
    </div>
    <div class="row g-3">
        <div class="col-md-4 mb-0">
            <!-- country -->
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="3" maxlength="20" name="country" id="country" autofocus required />
                <label for='floatingInput' id="country-label">Country</label>
                <span class="text-danger text-bg-light fs-6" id="is-valid-country"></span>
            </div>
        </div>

        <!-- province -->
        <div class="col-md-4 mb-0">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="2" maxlength="20" name="province" id="province" autofocus required />
                <label for='floatingInput' id="province-label">Province</label>
                <span class="text-danger fs-6" id="is-valid-province"></span>
            </div>
        </div>

        <!-- city -->
        <div class="col-md-4 mb-0">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="2" maxlength="20" name="city" id="city" autofocus required />
                <label for='floatingInput' id="city-label">Municipal / City</label>
                <span class="text-danger fs-6" id="is-valid-city"></span>
            </div>
        </div>
    </div>
    <h3 class="header mt-1">Identity</h3>
    <div class="row g-3">
        <div class="col-md-4 pb-2">
            <!-- username -->
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="text" placeholder=".form-control-sm" aria-label=".form-control-sm example" style="border: <?= isset($message['error-username']) ? "1px solid red" : "" ?>" value="" minlength="5" maxlength="20" name="username" id="username" autofocus required />
                <label for='floatingInput' style="color: <?= isset($message['error-username']) ? "red" : "" ?>" id="username-label">Username</label>
                <span class="text-danger fs-6" id="is-valid-username">
                    <?= $message['error-username'] ?? null ?>
                </span>
            </div>
        </div>
        <!-- password -->
        <div class="col-md-4 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="password" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="3" maxlength="80" name="password" id="password" autofocus required />
                <label for='floatingInput' id="password-label">Password</label>
                <i class="fa fa-eye showhide" id="togglePassword"></i>
                <span id="password-strength" class="fs-6"></span>
                <span class="fs-6 text-danger" id="is-valid-password"></span>
            </div>
        </div>


        <!-- confirm password -->
        <div class="col-md-4 pb-2">
            <div class="form-floating mb-3 text-dark">
                <input class="form-control form-control-sm " type="password" placeholder=".form-control-sm" aria-label=".form-control-sm example" value="" minlength="3" maxlength="80" name="confirmpassword" id="confirmpassword" autofocus required />
                <label for='floatingInput' id="confirmpassword-label">Confirm
                    Password</label>
                <i class="fa fa-eye showhide" id="toggleConfirmPassword"></i>
                <span class="text-danger fs-6" id="is-valid-confirmpassword"></span>
            </div>
        </div>
        <select name="role" id="role">
            <option value="1">User</option>
            <option value="2">Admin</option>
            <option value="3">Super Admin</option>
        </select>
        <!-- submit button to registered -->
        <center style="margin-top:auto">
            <button type="submit" id="button" class="btn btn-success btn-lg" data-mdb-ripple-color="dark">Register</button>
            <p class="mt-4 mb-0 text-dark">Have already an account?
                <a href="/login.php" class="fw-bold text-secondary"><u>Login here</u></a>
            </p>
        </center>
    </div>
</form>