<?php
$title = "Admin";
require "../include/auth/header.php";
require "../classes/Session.php";
$session->auth->notVerified();
$session->checkSession(checkRole: $_SESSION['user']['role'] == 1, path: "/");
$user = "";
?>
<button id=logout>Logout</button>
<?php if ($_SESSION['user']['role'] == 2) : ?>
    <h1>This is Admin Page</h1>
    <h1>Hey <?= $_SESSION['user']['username'] ?>, you're a ADMIN </h1>
<?php elseif ($_SESSION['user']['role'] == 3) : ?>
    <h1>This is Super Admin Page</h1>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Add User
    </button>
    <h1>Hey <?= $_SESSION['user']['username'] ?>, you're a SUPER ADMIN </h1>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php include "../components/register-form.php" ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

<?php endif ?>
<table class="table table-striped-columns" id="usersTable">
    <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Name</th>
            <th>Actions</th>
            <!--<th>Role</th>
            <th>Actions</th> -->
        </tr>
    </thead>
    <tbody id="get-users">
    </tbody>
</table>
<script>
    const userTable = $("#usersTable").DataTable({
        serverSide: true,
        processing: true,
        paging: true,
        order: [],
        ajax: {
            url: "../classes/Core.php/?f=get-users",
        },
        fnCreateRow: function(row, data, dataIndex) {
            // console.log($(row))  
        },
        columnDefs: [{
            target: [0, 1],
            orderable: false,
        }]
    });

    function getRoleName(roleId) {
        var roleName = ""
        if (roleId == 1) {
            roleName = "Student"
        } else if (roleId == 2) {
            roleName = "Admin"
        } else if (roleId == 3) {
            roleName = "Super Admin"
        } else {
            return "N/A"
        }
        return roleName;
    }

    function toEdit(roleId) {
        var isEditable = ""
        if (roleId == 3) {
            isEditable = `<button type="button" class="edit-button btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>`
        }
        return isEditable
    }

    $("#button").on("click", async (e) => {
        e.preventDefault()
        var registerForm = $("#register-form")[0]
        console.log(registerForm)
        var formData = {
            fname: registerForm[0].value,
            mname: registerForm[1].value,
            lname: registerForm[2].value,
            suffix: registerForm[3].value,
            sex: registerForm[4].value,
            bdate: registerForm[5].value,
            age: registerForm[6].value,
            mobileNumber: registerForm[7].value,
            email: registerForm[8].value,
            purokOrStreet: registerForm[9].value,
            barangay: registerForm[10].value,
            zipcode: registerForm[11].value,
            country: registerForm[12].value,
            province: registerForm[13].value,
            city: registerForm[14].value,
            username: registerForm[15].value,
            password: registerForm[16].value,
            confirmPassword: registerForm[17].value,
            role: registerForm[18].value,
        }
        console.log(formData)
        try {
            const response = await axios.post("../classes/Core.php/?f=create-user", formData, {
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded",
                },
            })
            console.log(response)
            userTable.draw()
            $("#editModal").modal("hide")
        } catch (error) {
            console.error(error)
        }
    })

    const acceptButton = document.getElementById("accept-button")
    $(document).on("click", async (e) => {
        if ($(e.target).hasClass("role")) {
            e.preventDefault()
            console.log($(e.target).attr("data-id"))
            console.log($(e.target).val())
            var roleId = $(e.target).val()
            var id = $(e.target).attr("data-id")
            try {
                const res = await axios.post("../classes/Core.php/?f=change-users-privilege", {
                    role_id: roleId,
                    user_id: id,
                }, {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                })
                console.log(res)
                userTable.draw()
            } catch (error) {
                console.error(error)
            }
        }
        if (e.target.classList.contains("accept-button")) {
            e.preventDefault()
            let id = e.target.getAttribute("data-id") //redundant
            try {
                const res = await axios.post("../classes/Core.php/?f=user_accepted", {
                    is_accepted: 1,
                    user_id: id,
                }, {
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                })
                console.log(res)
                userTable.draw()
            } catch (error) {
                console.error(error)
            }
        } else if (e.target.classList.contains("blocked-button")) {
            e.preventDefault()
            let id = e.target.getAttribute("data-id") //redundant
            let blockStatus = e.target.getAttribute("data-block-status")
            try {
                const res = await axios.post("../classes/Core.php/?f=user_blocked", {
                    user_id: id,
                    block_status: blockStatus,
                }, {
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                console.log(res)
                userTable.draw()
            } catch (error) {
                console.error(error)
            }
        }
    })
</script>
<script type="text/javascript" src="/assets/js/index.js"></script>
<script type="text/javascript" src="/assets/js/register/index.js"></script>
<?php require "../include/auth/footer.php"  ?>
<script>
    // users();
    // var getUsers = document.getElementById('get-users')
    // const modalBodyEdit = document.querySelector(".modal-body")
    // async function users() {
    //     const respose = await fetch("../classes/Core.php/?f=get-users")
    //     const json = await respose.json()
    //     const users = json.users
    //     let table = ""
    //     users.map((user) => {
    //         let acceptTable = !user.is_accepted ? `<button class='accept-button btn btn-success' data-id=${user.id}>Accept</button>` : ""
    //         let blockedRow = !user.is_blocked ? `<button class='blocked-button btn btn-danger' data-block-status=1 data-id=${user.id}>Blocked</button>` : `<button class='blocked-button btn btn-secondary' data-block-status=0 data-id=${user.id}>Unblocked</button>`
    //         table += `<tr>
    //         <td>${user.username}</td>
    //         <td>${user.firstname} ${user.middlename} ${user.lastname}</td>
    //         <td>${getRoleName(user.role)}</td>
    //         <td>
    //             ${acceptTable}
    //             ${blockedRow}
    //             ${toEdit(user.role)}
    //         </td>
    //         </tr>`
    //     })
    //     getUsers.innerHTML = table
    // }
</script>