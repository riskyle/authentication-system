<?php
$title = "Login";

require "./include/guest/header.php";

require "classes/Session.php";

$session->redirectIfSession();

$auth->ifLoginButtonCLick();
?>

<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN">

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div>
        <?php if (!isset($_SESSION['attempts']) || $_SESSION['attempts'] === 0) : ?>

            <!-- unlock icon -->
            <!-- <a href="/login">
                <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 fill-current text-gray-500">
                    <g id="XMLID_516_">
                        <path id="XMLID_517_" d="M15,160c8.284,0,15-6.716,15-15V85c0-30.327,24.673-55,55-55c30.327,0,55,24.673,55,55v45h-25
        c-8.284,0-15,6.716-15,15v170c0,8.284,6.716,15,15,15h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15H170V85
        c0-46.869-38.131-85-85-85S0,38.131,0,85v60C0,153.284,6.716,160,15,160z" />
                    </g>
                </svg>
            </a> -->
        <?php else : ?>
            <h1 style="font-size:xx-large; color:red;" class="fill-current text-red-500 font-large">
                <?= $_SESSION['attempts'] ?>
            </h1>

            <!-- lock icon -->
            <!-- <div> 
                <a>
                    <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 fill-current text-gray-500">
                        <g id="XMLID_509_">
                            <path id="XMLID_510_" d="M65,330h200c8.284,0,15-6.716,15-15V145c0-8.284-6.716-15-15-15h-15V85c0-46.869-38.131-85-85-85
        S80,38.131,80,85v45H65c-8.284,0-15,6.716-15,15v170C50,323.284,56.716,330,65,330z M180,234.986V255c0,8.284-6.716,15-15,15
        s-15-6.716-15-15v-20.014c-6.068-4.565-10-11.824-10-19.986c0-13.785,11.215-25,25-25s25,11.215,25,25
        C190,223.162,186.068,230.421,180,234.986z M110,85c0-30.327,24.673-55,55-55s55,24.673,55,55v45H110V85z" />
                        </g>
                    </svg>
                </a>
            </div> -->
        <?php endif; ?>
    </div>


    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <!-- Session Status -->

        <form class="" method="POST" action="">
            <input type="hidden" id="timeIncrement" value="<?= $auth->timeIncrement ?? null ?>">

            <!-- Email Address -->
            <div>
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="email">
                    Username
                </label>
                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" value="<?= $_SESSION['username'] ?? null ?>" id="username" type="text" name="username" required="required" autofocus="autofocus" autocomplete="username">

                <span class="text-sm text-red-600 dark:text-red-400 space-y-1" role="alert">
                    <strong>
                        <?= $_SESSION['error'] ?? null ?>
                    </strong>
                </span>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="password">
                    Password
                </label>

                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" id="password" type="password" name="password" required="required" autocomplete="current-password" />

            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" id="redirect-register-button" href="/register.php">
                    Don't have an account? Sign
                    Up
                </a>

                <button type="submit" id="login-button" name="login_button" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3">
                    Log in
                </button>
            </div>

        </form>
    </div>
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg" id="display-timer">
        <p class="limitreach flex items-center justify-center" style="color: red">Too many attempts!</p>
        <div class="flex items-center justify-center text-white" id="total-time-left"></div>
    </div>
</div>

<script>
    // localStorage.clear();
    var timeIncrement = $("#timeIncrement").val()

    let getTimeIncrement = localStorage.getItem("time_increment");

    if (timeIncrement || getTimeIncrement || count_timer != 0) {

        if (localStorage.getItem("count_timer")) {
            var count_timer = localStorage.getItem("count_timer");
        } else {
            var count_timer = 30 * timeIncrement
        }

        let minutes = parseInt(count_timer / 60);

        let seconds = parseInt(count_timer % 60);

        localStorage.setItem("time_increment", timeIncrement);

        $("#display-timer").css("display", "none")

        function countDownTimer() {

            if (seconds < 10) {
                seconds = "0" + seconds;
            }

            if (minutes < 10) {
                minutes = "0" + minutes;
            }

            $("#total-time-left").html(" Please wait for " + minutes + " Minutes " + seconds + " Seconds")

            if (count_timer == 0) {

                localStorage.removeItem("count_timer");

                localStorage.removeItem("time_increment");

                $("#redirect-register-button").prop('href', '/register.php');

                $("#login-button").prop("disabled", false)

                $("#username").prop("disabled", false)

                $("#password").prop("disabled", false)

                $("#display-timer").css("display", "none")
            } else {

                $("#display-timer").css("display", "block")

                history.pushState(null, document.title, location.href);

                $(window).on('popstate', function(event) {
                    history.pushState(null, document.title, location.href);
                });

                count_timer = count_timer - 1;

                minutes = parseInt(count_timer / 60);

                seconds = parseInt(count_timer % 60);

                localStorage.setItem("count_timer", count_timer + 1);

                $("#redirect-register-button").on("click", (e) => {
                    e.preventDefault()
                })

                $("#redirect-register-button").prop('href', '');

                $("#login-button").prop("disabled", true)

                $("#username").prop("disabled", true)

                $("#password").prop("disabled", true)

                setTimeout("countDownTimer()", 1000);
            }
        }

        countDownTimer();
    }
</script>
<?php require "./include/guest/footer.php" ?>