<?php
require "User.php";
// require "Database.php";
class Core
{
    public Database $db;
    private User $user;
    public function __construct()
    {
        $this->db = new Database;
        $this->user = new User;
    }
    public function getUsers()
    {
        $users = $this->db->query("SELECT * FROM users");
        $data = [];
        foreach ($users->get() as $key => $row) {
            $blockedRow = '<button class="blocked-button btn ' . (!$row['is_blocked'] ? 'btn-danger' : 'btn-secondary') . ' m-1" data-block-status=' . (!$row["is_blocked"] ? 1 : 0) . ' data-id="' . $row['id'] . '">' . (!$row["is_blocked"] ? "Blocked" : "Unblocked") . '</button>';
            $acceptRow = !$row["is_accepted"] ? '<button class="accept-button btn btn-success m-1" data-id=' . $row['id'] . '>Accept</button>' : "";
            $selectedUser =  $row['role'] === 1 ? "selected" : "";
            $selectedAdmin =  $row['role'] === 2 ? "selected" : "";
            $selectedSuperAdmin =  $row['role'] === 3 ? "selected" : "";
            $dataId = $row['id'];
            $givePrivilege = "
            <select class='select-role form-select m-1' id='select-role'>
                <option class='role' data-id=" . $dataId . " value='1' $selectedUser>User</option>
                <option class='role' data-id=" . $dataId . " value='2' $selectedAdmin>Admin</option>
                <option class='role' data-id=" . $dataId . " value='3' $selectedSuperAdmin>Super Admin</option>
            </select>
            ";
            $isSuperAdmin = $_SESSION['user']['role'] != 3 ? "" : $givePrivilege;
            $subArray = [];
            $subArray[] = $row["username"];
            $subArray[] = $row["email"];
            $subArray[] = $row["firstname"] . " " . $row["middlename"] . " " . $row["lastname"];
            $subArray[] = "<div class='d-inline-flex'>" . $isSuperAdmin . $blockedRow . $acceptRow . "</div>";
            $data[] = $subArray;
        }
        $output = [
            "data" => $data,
            "draw" => intval($_GET['draw']),
            "recordsTotal" => count($data),
            "recordsFiltered" => count($data),
        ];
        echo json_encode($output);
    }
    public function userAccepted()
    {
        $isAccepted = $_POST['is_accepted'];
        $userId = $_POST['user_id'];

        $this->db->query("UPDATE users SET is_accepted = :is_accepted WHERE id = :id", [
            "is_accepted" => $isAccepted,
            "id" => $userId,
        ])->get();
        echo json_encode(["res" => "user is accepted and able to login now"]);
    }
    public function userBlocked()
    {
        $userId = $_POST["user_id"];
        $blockStatus = $_POST["block_status"];
        $this->db->query("UPDATE users SET is_blocked = :is_blocked WHERE id = :id", [
            "is_blocked" => $blockStatus,
            "id" => $userId,
        ])->get();
        echo json_encode(["res" => "user is block"]);
    }
    public function usersPrivilege()
    {
        $roleId = $_POST['role_id'];
        $userId = $_POST['user_id'];
        $this->db->query("UPDATE users SET role = :role WHERE id = :id", [
            "role" => $roleId,
            "id" => $userId,
        ])->get();
        echo json_encode(["res" => "role changes", "pos" => $_POST]);
    }
    public function createUser()
    {
        $this->user->registerUser(
            firstname: $_POST["fname"],
            middlename: $_POST["mname"],
            lastname: $_POST["lname"],
            suffix: $_POST["suffix"],
            sex: $_POST["sex"],
            birthdate: $_POST["bdate"],
            age: $_POST["age"],
            mobilenumber: $_POST["mobileNumber"],
            country: $_POST["country"],
            province: $_POST["province"],
            city: $_POST["city"],
            purok: $_POST["purokOrStreet"],
            barangay: $_POST["barangay"],
            zipcode: $_POST["zipcode"],
            username: $_POST["username"],
            email: $_POST["email"],
            password: $_POST["password"],
            role: $_POST["role"]
        );
        echo json_encode(["response" => "User Created!"]);
    }
}
$core = new Core();
$action = $_GET["f"] ?? null;
switch ($action) {
    case 'get-users':
        $core->getUsers();
        break;
    case 'user_accepted':
        $core->userAccepted();
        break;
    case 'user_blocked':
        $core->userBlocked();
        break;
    case 'create-user':
        $core->createUser();
        break;
    case 'change-users-privilege':
        $core->usersPrivilege();
        break;
}
