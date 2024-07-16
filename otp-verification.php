<?php
$title = "Verify Otp";

require "./include/guest/header.php";

require "classes/Session.php";

$session->checkSession();

if ($_SESSION['verified'] ?? false) {
    $session->redirectIfSession();
}

$auth->checkToVerify();
?>
<script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN">

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <!-- Session Status -->

        <form class="" method="POST" action="">
            <!-- code -->
            <div class="mt-4">
                <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="otp">
                    One Time Password
                </label>

                <input class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full" id="code" type="password" name="code" required="required" autocomplete="code" />

                <span class="text-sm text-red-600 dark:text-red-400 space-y-1" role="alert">
                    <strong>
                        <?= $_SESSION['error'] ?? null ?>
                    </strong>
                </span>
            </div>
            <div class="flex items-center justify-end mt-4">
                <button type="submit" id="verify-button" name="verify_button" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-3">
                    Verify
                </button>
            </div>

        </form>

        <button type="button" id="logout" class="underline text-sm text-gray-300 hover:text-gray-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Log Out
        </button>
    </div>
</div>

<script type="text/javascript" src="assets/js/index.js"></script>

<?php require "./include/guest/footer.php" ?>