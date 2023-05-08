<?php

include './configuration/configuration.php';
session_start();

// user login
if (isset($_POST['login'])) {
    $login_email = $_POST['login_email'];
    $login_pass = $_POST['login_pass'];

    $login_query = "SELECT * FROM `user_account` WHERE email = '$login_email' AND password = '$login_pass'";

    $run_login_query = mysqli_query($conn, $login_query);

    if (mysqli_num_rows($run_login_query) > 0) {
        $row = mysqli_fetch_assoc($run_login_query);
        $_SESSION['id'] = $row['id'];
        header('location:profile.php');
    } else {
        $msg[] = "Email and password not exist";
    }
}

// user registration
if (isset($_POST['register'])) {
    $user_id = rand();
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['new_email'];
    $pass = $_POST['new_pass'];

    $existing_user = "SELECT * FROM `user_account` WHERE email = '$email'";

    $existing_user_query = mysqli_query($conn, $existing_user);

    if (mysqli_num_rows($existing_user_query) > 0) {
        $msg[] = "Registration failed. Email alredy exist";
    } else {
        $new_account = "INSERT INTO `user_account`(id, f_name, l_name, email, password) VALUES ('$user_id','$f_name','$l_name','$email','$pass')";

        if (mysqli_query($conn, $new_account)) {
            $msg[] = "Successfull";
        } else {
            $msg[] = "Failed";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO Application</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css/hader.css">
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <div class="container">
            <div class="logo">
                <h1>TODO</h1>
                <span>BETA</span>
            </div>

            <div class="menu">
                <ul>
                    <li><a href="">About</a></li>
                    <li><a href="">Github</a></li>
                    <li><a href=""><i class="fa-solid fa-user"></i></a></li>

                </ul>
            </div>
        </div>
    </header>


    <main>
        <div class="container">
            <div class="left">
                <h1>Make your daily life easy</h1>
                <h2>Create your todo</h2>
            </div>

            <div class="right">
                <div class="form_box">
                    <h1>Sign Up</h1>
                    <div class="button">
                        <button type="button" id="login" class="active">Login</button>
                        <button type="button" id="register">Register</button>
                    </div>

                    <?php

                    if (isset($msg)) {
                        foreach ($msg as $msg) {
                            echo '<div class="msg_body">' . $msg . '</div>';
                        }
                    }

                    ?>

                    <form action="" method="post" id="form_login">
                        <div class="input_box">
                            <input type="email" name="login_email" id="" placeholder="Email">
                            <i class="fa-solid fa-envelope"></i>
                        </div>


                        <div class="input_box">
                            <input type="password" name="login_pass" id="password" placeholder="Password">
                            <i class="fa-solid fa-lock"></i>
                            <i class="fa-solid fa-eye tog" id="tog"></i>
                        </div>

                        <button type="submit" name="login">Login</button>
                    </form>

                    <form action="" method="post" id="form_register">
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

                        <button type="submit" name="register" id="actionBtn">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <script src="./js/script.js"></script>
    <script>

        const password = document.getElementById("password");
        const tog = document.getElementById("tog");
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
                actionBtn.innerText = "Register"
            } else {
                actionBtn.style.pointerEvents = "none";
                actionBtn.style.opacity = "0.8";
                actionBtn.innerText = "Password not matching"
            }
        })


        // password show/hide
        tog.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
                tog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                password.type = "password";
                tog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })


        new_pass_tog.addEventListener("click", () => {
            if (new_pass.type === "password") {
                new_pass.type = "text";
                new_pass_tog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                new_pass.type = "password";
                new_pass_tog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })


        con_new_pass_tog.addEventListener("click", () => {
            if (con_new_pass.type === "password") {
                con_new_pass.type = "text";
                con_new_pass_tog.classList.replace("fa-eye", "fa-eye-slash")
            } else {
                con_new_pass.type = "password";
                con_new_pass_tog.classList.replace("fa-eye-slash", "fa-eye")
            }
        })
    </script>
</body>

</html>