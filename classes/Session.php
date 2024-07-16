<?php
require "Authentication.php";
class Session
{
    public function __construct(
        public Authentication $auth,
        private string|bool $userLogin,
        private string|bool $role
    ) {
        $this->auth = $auth;
        $this->userLogin = $userLogin;
        $this->role = $role;
    }

    public function redirectIfSession()
    {
        if ($this->userLogin && $this->role == 1) {
            header("location: /");
        } else if ($this->userLogin && $this->role != 1) {
            header("location: admin/");
        }
    }

    public function redirectIfVerified()
    {
        $this->redirectIfSession();
    }

    public function checkSession(bool $checkRole = false, $path = "")
    {
        if (!$this->userLogin) {

            header("location: /login.php");
        } else if ($checkRole) {

            header("location: $path");
        } else if ($this->auth->isUserBlocked()) {

            header("location: /login.php");

            $this->auth->logout();
        }
    }

    public function isAuthenticated()
    {
        return $this->userLogin;
    }
}

$session = new Session(new Authentication, $_SESSION['user']['login'] ?? false, $_SESSION["user"]["role"] ?? false);
