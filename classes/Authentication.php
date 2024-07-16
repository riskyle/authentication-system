<?php
require "Functions.php";

require "User.php";

require "Validation.php";

class Authentication
{
    public string $email;
    public User $user;
    public Database $db;
    public int|string $timeIncrement;
    public function __construct()
    {
        unset($_SESSION['error']);

        $this->db = new Database;

        $this->user = new User;
    }
    public function increment()
    {
        $increment = .5;

        if (!isset($_SESSION['timeIncrement'])) {

            $this->timeIncrement = $increment;
        } else if ($_SESSION['timeIncrement'] == 1 && $_SESSION['based'] == 2) {

            $increment = 1;

            $this->timeIncrement = $_SESSION['timeIncrement'];
        } else if ($_SESSION['timeIncrement'] >= 2) {

            $increment = 0;

            $this->timeIncrement = $_SESSION['timeIncrement'];
        } else {

            $this->timeIncrement = $increment;
        }

        $_SESSION['timeIncrement'] = $this->timeIncrement + $increment;
    }
    public function isUserBlocked()
    {
        $user = $this->db->query("SELECT * FROM users WHERE username = :username", [
            'username' => $_SESSION['user']['username'],
        ])->find();

        return $user['is_blocked'] == 1;
    }

    public function notVerified()
    {
        if (!$_SESSION['verified']) {
            header('location: otp-verification.php');
            exit;
        }
    }

    public function checkToVerify()
    {
        if (isset($_POST['verify_button'])) {

            $code = $_POST['code'];

            $user = $this->db->query("SELECT * FROM users WHERE username = :username", [
                'username' => $_SESSION['user']['username'],
            ])->find();

            if ($code != $user['otp']) {
                $_SESSION['error'] = "Incorrect OTP code!";
                return;
            }

            $_SESSION['verified'] = true;

            $this->user->redirectTo();
        }
    }

    public function login()
    {
        $username = checkInputs($_POST['username']);

        $password = checkInputs($_POST['password']);

        $_SESSION['username'] = $username;

        $ip = ipAddress();

        $time = time() - 15;

        $checkLoginRow = $this->db->query("SELECT COUNT(*) AS total_count FROM attempts WHERE login_time > :time AND
         ip_address = :ip", [
            'ip' => $ip,
            'time' => $time
        ])->find();

        $totalCount = $checkLoginRow['total_count'];

        if ($totalCount >= 3) {

            $this->increment();
        } else {

            $user = $this->db->query("SELECT * FROM users WHERE username = :username", [
                'username' => $username,
            ])->find();

            if ($user && password_verify($password, $user['password'])) {
                if ($user['is_blocked'] == 1 && $user["is_accepted"] == 0) {

                    $_SESSION['error'] = "You are blocked and not accepted";
                } else if ($user['is_blocked'] == 1) {

                    $_SESSION['error'] = "You have been blocked!";
                } else if ($user["is_accepted"] == 0) {

                    $_SESSION['error'] = "You cannot login because you are not accepted by the admin!";
                } else {

                    $_SESSION['user'] = [
                        "id" => $user['id'],
                        "username" => $user['username'],
                        "role" => $user['role'],
                        "is_blocked" => $user['is_blocked'],
                        "is_accepted" => $user['is_accepted'],
                        "login" => true
                    ];

                    $this->db->query("DELETE FROM attempts WHERE ip_address= :ip", [
                        'ip' => $ip,
                    ])->find();

                    unset($_SESSION['timeIncrement']);

                    unset($_SESSION['based']);

                    unset($_SESSION['username']);

                    $code = random_int(111111, 999999);

                    $this->db->query("UPDATE users SET otp = $code WHERE username = :username", [
                        'username' =>  $user['username'],
                    ])->get();

                    require "Mail.php";

                    $mail = new Mail;

                    $mail->send($user['email'], $user['username'], "Code", "This is your code: <h1>$code</h1>");

                    $this->user->redirectTo();
                }
            } else {

                $login_time = time();

                $this->db->query("INSERT INTO attempts VALUES (null, :ip_address, :login_time)", [
                    'ip_address' => $ip,
                    'login_time' => $login_time
                ])->get();

                $totalCount++;

                $_SESSION['attempts'] = 3 - $totalCount;

                if ($_SESSION['attempts'] <= 0) {

                    if (empty($_SESSION['based'])) {
                        $_SESSION['based'] = 0;
                    }

                    $_SESSION['based'] += 1;

                    $this->increment();
                } else {

                    $_SESSION['error'] = "These credentials do not match our records.";
                }
            }
        }
    }
    public function ifLoginButtonCLick()
    {
        if (isset($_POST['login_button'])) {
            $this->login();
        }
    }
    public function register()
    {
        $firstname = checkInputs($_POST['firstname']);

        $lastname = checkInputs($_POST['lastname']);

        $middlename = checkInputs($_POST['middlename']);

        $suffix = checkInputs($_POST['suffix']);

        $sex = checkInputs($_POST['sex']);

        $birthdate = checkInputs($_POST['birthdate']);

        $age = checkInputs($_POST['age']);

        $mobilenumber = checkInputs($_POST['mobilenum']);

        $country = checkInputs($_POST['country']);

        $province = checkInputs($_POST['province']);

        $city = checkInputs($_POST['city']);

        $purok = checkInputs($_POST['purok']);

        $barangay = checkInputs($_POST['barangay']);

        $zipcode = checkInputs($_POST['zipcode']);

        $username = checkInputs($_POST['username']);

        $email = checkInputs($_POST['email']);

        $password = checkInputs($_POST['password']);

        $role = checkInputs($_POST['role']);

        $confirmpassword = checkInputs($_POST['confirmpassword']);

        $user = new User;

        if (Validation::checkUserExist('email', $email,)) {

            $type = "email";

            $message = "This {$email} email is already taken";

            $isRegister = false;
        } else if (Validation::checkUserExist('username', $username)) {

            $type = "username";

            $message = "This {$username} username is already taken";

            $isRegister = false;
        } else {

            $user->registerUser(
                $firstname,
                $middlename,
                $lastname,
                $suffix,
                $sex,
                $birthdate,
                $age,
                $mobilenumber,
                $country,
                $province,
                $city,
                $purok,
                $barangay,
                $zipcode,
                $username,
                $email,
                $password,
                $role,
            );

            $type = "success";

            $message = "Successfully Registered. You can now login";

            $isRegister = true;
        }

        echo json_encode([
            "type" => $type,
            "message" => $message,
            "ok" => $isRegister
        ]);
    }
    public function isUserExist($username, $email)
    {
        if (isset($username)) {

            if (!isset($username)) {

                echo json_encode(["ok" => false]);

                return;
            }

            $exist = Validation::checkUserExist("username", $username);

            if ($exist) {

                echo json_encode(["ok" => true, "message" => "This '{$username}' username is already taken"]);

                exit;
            } else {

                echo json_encode(["ok" => false]);

                exit;
            }
        } else if (isset($email)) {

            if (!isset($email)) {

                echo json_encode(["ok" => false]);

                return;
            }

            $exist = Validation::checkUserExist("email", $email);

            if ($exist) {

                $response = ["ok" => true, "message" => "This '{$email}' email is already taken"];

                echo json_encode($response);

                exit;
            } else {

                echo json_encode(["ok" => false]);

                exit;
            }
        }
    }
    public function logout()
    {
        $this->db->query("UPDATE users SET otp = null WHERE username = :username", [
            'username' =>  $_SESSION['user']['username'],
        ])->get();

        session_destroy();

        $params = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

        echo json_encode(["logout" => true]);

        exit;
    }
}

$auth = new Authentication();

$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);

switch ($action) {

    case "register":
        $auth->register();
        break;

    case "check":
        $auth->isUserExist(username: $_GET["username"] ?? null, email: $_GET["email"] ?? null);
        break;

    case "logout":
        $auth->logout();
        break;
}
