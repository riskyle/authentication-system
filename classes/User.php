<?php
require "Database.php";
class User
{
    private Database $database;
    public function __construct()
    {
        $this->database = new Database;
    }
    public function registerUser(
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
        $role
    ) {
        $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);

        $insertingUserQuery = "INSERT INTO users VALUES (
                                                            null, 
                                                            :firstname, 
                                                            :middlename, 
                                                            :lastname,
                                                            :suffix, 
                                                            :sex, 
                                                            :birthdate, 
                                                            :age, 
                                                            :mobilenumber, 
                                                            :country, 
                                                            :province, 
                                                            :city, 
                                                            :purok,
                                                            :barangay,
                                                            :zipcode, 
                                                            :username, 
                                                            :email, 
                                                            :password, 
                                                            :role,
                                                            0,
                                                            0,
                                                            null,
                                                            null 
                                                        )";
        $this->database->query(
            $insertingUserQuery,
            [
                "firstname" => $firstname,
                "middlename" => $middlename,
                "lastname" => $lastname,
                "suffix" => $suffix,
                "sex" => $sex,
                "birthdate" => $birthdate,
                "age" => $age,
                "mobilenumber" => $mobilenumber,
                "country" => $country,
                "province" => $province,
                "city" => $city,
                "purok" => $purok,
                "barangay" => $barangay,
                "zipcode" => $zipcode,
                "username" => $username,
                "email" => $email,
                "password" => $hashed_pwd,
                "role" => $role,
            ]
        )->get();
    }

    public function redirectTo()
    {
        $user = $this->database->query('SELECT role FROM users WHERE username = :username', [
            "username" => $_SESSION["user"]["username"]
        ])->find();

        header("location: /otp-verification.php");

        exit;

        if ($user['role'] == 1) {
            header("location: /");
        } else if ($user['role'] == 2 || $user['role'] == 3) {
            header("location: /admin/");
        }
    }
    public function delete()
    {
        // $this->database->query("DELETE FROM users WHERE id = :userId", ["userId" => $userId])->get();
        echo json_encode(["res" => "res", "id" => $_POST['userId']]);
    }
}
$user = new User();
switch ($_GET["f"] ?? "") {
    case 'delete':
        $user->delete();
        break;
}
