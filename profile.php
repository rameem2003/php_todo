<?php

include './configuration/configuration.php';
session_start();

$user_id = $_SESSION['id'];

$load_user = "SELECT * FROM `user_account` WHERE id = '$user_id'";
$run_load_user = mysqli_query($conn, $load_user);

if (mysqli_num_rows($run_load_user) > 0) {
    $row = mysqli_fetch_assoc($run_load_user);
}

// logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($user_id);
    header('location:./');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['f_name'] . " " . $row['l_name'] ?></title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css/hader.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/form_design.css">
</head>

<body>

    <?php include './header.php' ?>

    <div class="form_box" id="edit_form">
        <h1>Update Profile</h1>
        <?php

        if (isset($msg)) {
            foreach ($msg as $msg) {
                echo '<div class="msg_body">' . $msg . '</div>';
            }
        }

        ?>

        <form action="" method="post">
            <div class="input_box">
                <input type="text" name="f_name" id="" placeholder="First Name" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input_box">
                <input type="text" name="l_name" id="" placeholder="Last Name" required>
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input_box">
                <input type="email" name="new_email" id="" placeholder="Email" required>
                <i class="fa-solid fa-envelope"></i>
            </div>
            <div class="input_box">
                <input type="password" name="new_pass" id="new_pass" placeholder="Create Password" required>
                <i class="fa-solid fa-lock"></i>
                <i class="fa-solid fa-eye tog" id="new_pass_tog"></i>
            </div>

            <div class="input_box">
                <input type="password" name="con_new_pass" id="con_new_pass" placeholder="Confirm New Password" required>
                <i class="fa-solid fa-lock"></i>
                <i class="fa-solid fa-eye tog" id="con_new_pass_tog"></i>
            </div>

            <button type="submit" name="update" id="actionBtn">Update</button>
        </form>
    </div>

    <script src="./js/script.js"></script>
    <script>
        const new_pass = document.getElementById("new_pass");
        const con_new_pass = document.getElementById("con_new_pass");
        const new_pass_tog = document.getElementById("new_pass_tog");
        const con_new_pass_tog = document.getElementById("con_new_pass_tog");
        const actionBtn = document.getElementById("actionBtn");

        // check password match or not
        con_new_pass.addEventListener("keyup", () => {
            let password = new_pass.value;
            let cpass = con_new_pass.value;

            if (password == cpass) {
                actionBtn.style.pointerEvents = "all";
                actionBtn.style.opacity = "1";
                actionBtn.innerText = "Update"
            } else {
                actionBtn.style.pointerEvents = "none";
                actionBtn.style.opacity = "0.8";
                actionBtn.innerText = "Password not matching"
            }
        })


        // password show/hide
        new_pass_tog.addEventListener("click", () => {
            if (new_pass.type === "password") {
                new_pass.type = "text";
                new_pass_tog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                new_pass.type = "password";
                new_pass_tog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })


        // password show/hide
        con_new_pass_tog.addEventListener("click", () => {
            if (con_new_pass.type === "password") {
                con_new_pass.type = "text";
                con_new_pass_tog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                con_new_pass.type = "password";
                con_new_pass_tog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })


        // edit form open
        const editBtn = document.getElementById("editBtn");
        const edit_form = document.getElementById("edit_form");

        editBtn.addEventListener("click", (e) => {
            e.preventDefault();
            edit_form.classList.toggle("form_show")
            console.log("a");
        })
    </script>

</body>

</html>