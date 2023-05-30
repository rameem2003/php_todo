<?php

include './configuration/configuration.php';
session_start();

// user show
$user_id = $_SESSION['id'];

$load_user = "SELECT * FROM `user_account` WHERE id = '$user_id'";
$run_load_user = mysqli_query($conn, $load_user);

if (mysqli_num_rows($run_load_user) > 0) {
    $row = mysqli_fetch_assoc($run_load_user);
    $user_email = $row['email'];
}

// logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($user_id);
    header('location:./');
}


// update user account
if (isset($_POST['update'])) {
    $new_f_name = $_POST['up_f_name'];
    $new_l_name = $_POST['up_l_name'];
    // $new_email = $_POST['up_new_email'];
    $old_pass = $_POST['old_pass'];
    $check_pass = $_POST['check_pass'];

    $new_pass = $_POST['new_pass'];

    if ($old_pass == $check_pass) {
        // $existing_user = "SELECT * FROM `user_account` WHERE email = '$new_email'";

        // $existing_user_query = mysqli_query($conn, $existing_user);

        // if (mysqli_num_rows($existing_user_query) > 0) {
        //     $msg[] = "Registration failed. Email alredy exist";
        // }else{
        //     $update_query = "UPDATE `user_account` SET f_name='$new_f_name', l_name='$new_l_name', password='$new_pass' WHERE id = '$user_id'";

        //     mysqli_query($conn, $update_query);
        // }

        $update_query = "UPDATE `user_account` SET f_name='$new_f_name', l_name='$new_l_name', password='$new_pass' WHERE id = '$user_id'";

        mysqli_query($conn, $update_query);

        session_destroy();
        unset($user_id);
        header('location:./');
    } else {
        $msg[] = "Your password isnot correct. Try again";
    }
}

// upload todo
if (isset($_POST['upload'])) {
    $todo_title = $_POST['todo_title'];
    $todo_desc = $_POST['todo_desc'];
    $date = $_POST['date'];
    $email = $row['email'];

    $upload_todo = "INSERT INTO `todo_table`(user_email, todo_title, todo_desc, todo_date) VALUES ('$email','$todo_title','$todo_desc', '$date')";

    mysqli_query($conn, $upload_todo);
}

// delete todo
if(isset($_GET['dlTodo'])){
    $todoId = $_GET['dlTodo'];
    $delete_todo = "DELETE FROM `todo_table` WHERE id = '$todoId'";
    mysqli_query($conn, $delete_todo);
    header('location:profile.php');
}


if(isset($_GET['deleteAc'])){
    $deleteAcEmmail = $_GET['deleteAc'];

    // delete all todo from the account
    mysqli_query($conn, "DELETE FROM `todo_table` WHERE user_email = '$deleteAcEmmail'");
    mysqli_query($conn, "DELETE FROM `user_account` WHERE email = '$deleteAcEmmail'");

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
    <link rel="stylesheet" href="./css/todo.css">
</head>

<body>

    <?php include './header.php' ?>


    <!-- form for update user account -->
    <div class="form_box" id="edit_form">
        <h1>Update Profile</h1>
        <?php

        if (isset($msg)) {
            foreach ($msg as $msg) {
                echo '<div class="msg_body">' . $msg . '</div>';
            }
        }

        ?>

        <form action="" method="post" id="user_update_form">
            <div class="input_box">
                <input type="text" name="up_f_name" id="" placeholder="First Name" required value="<?php echo $row['f_name'] ?>">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input_box">
                <input type="text" name="up_l_name" id="" placeholder="Last Name" required value="<?php echo $row['l_name'] ?>">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="input_box">
                <input type="email" name="up_new_email" id="" placeholder="Email" required value="<?php echo $row['email'] ?>" readonly>
                <i class="fa-solid fa-envelope"></i>
            </div>

            <div class="input_box">
                <input type="password" name="old_pass" id="old_pass" placeholder="Enter Old Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>

            <input type="hidden" name="check_pass" value="<?php echo $row['password'] ?>">

            <div class="input_box">
                <input type="password" name="new_pass" id="new_pass" placeholder="Create New Password" required>
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


    <!-- todo form -->
    <div class="form_box" id="todo_form">
        <h1>Add your todo</h1>
        <!-- <?php

                if (isset($msg)) {
                    foreach ($msg as $msg) {
                        echo '<div class="msg_body">' . $msg . '</div>';
                    }
                }

                ?> -->

        <form action="" method="post" id="">
            <div class="input_box">
                <input type="text" name="todo_title" id="" placeholder="TODO Title" required>
                <i class="fa-solid fa-file-check"></i>
            </div>

            <div class="input_box">
                <textarea name="todo_desc" placeholder="Write Your Todo" id="" cols="30" rows="10" required></textarea>
            </div>

            <div class="input_box">
                <input type="date" name="date" id="" value="<?php echo date("Y-m-d"); ?>">
            </div>




            <button type="submit" name="upload" id="actionBtn">Upload Todo</button>
        </form>
    </div>


    <!-- todo list -->
    <section class="todo_list">
        <button id="add_todo"><i class="fa-solid fa-plus"></i></button>
        <!-- <div class="add_new_todo_screen">
            <div class="plus">
                <i class="fa-solid fa-plus"></i>
            </div>

            <h1>Add New Todo</h1>
        </div> -->

        <?php

        // show all todos in ui

        $show_todo = "SELECT * FROM `todo_table` WHERE user_email = '$user_email'";
        $show_todo_query = mysqli_query($conn, $show_todo);

        if (mysqli_num_rows($show_todo_query) > 0) {
            while ($todo_row = mysqli_fetch_assoc($show_todo_query)) {
        ?>
                <div class="todo">
                    <div class="head">
                        <div class="tile">
                            <h3><?php echo $todo_row['todo_title'] ?></h3>
                        </div>
                        <div class="action">
                            <a href="./profile.php?dlTodo=<?php echo $todo_row['id'] ?>"><i class="fa-solid fa-trash"></i></a>
                            <a href="./updateTodo.php?upTodo=<?php echo $todo_row['id'] ?>"><i class="fa-solid fa-pen"></i></a>
                        </div>
                    </div>

                    <div class="todo_desc">
                        <p><?php echo $todo_row['todo_desc'] ?></p>
                    </div>

                    <p>Time: <?php echo $todo_row['todo_date'] ?></p>
                </div>
        <?php
            }
        } else {
            echo "
            <div class='add_new_todo_screen'>
            <div class='plus'>
                <i class='fa-solid fa-plus'></i>
            </div>

            <h1>Add New Todo</h1>
        </div>
            ";
        }

        ?>


        <!-- <div class="todo">
            <div class="head">
                <div class="tile">
                    <h3>Todo Title</h3>
                </div>
                <div class="action">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="todo_desc">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi autem repudiandae ducimus harum alias iure molestias neque. Unde, sunt recusandae.</p>
            </div>

            <p>Time: </p>
        </div>

        <div class="todo">
            <div class="head">
                <div class="tile">
                    <h3>Todo Title</h3>
                </div>
                <div class="action">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="todo_desc">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi autem repudiandae ducimus harum alias iure molestias neque. Unde, sunt recusandae.</p>
            </div>

            <p>Time: </p>
        </div>

        <div class="todo">
            <div class="head">
                <div class="tile">
                    <h3>Todo Title</h3>
                </div>
                <div class="action">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="todo_desc">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi autem repudiandae ducimus harum alias iure molestias neque. Unde, sunt recusandae.</p>
            </div>

            <p>Time: </p>
        </div>

        <div class="todo">
            <div class="head">
                <div class="tile">
                    <h3>Todo Title</h3>
                </div>
                <div class="action">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="todo_desc">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi autem repudiandae ducimus harum alias iure molestias neque. Unde, sunt recusandae.</p>
            </div>

            <p>Time: </p>
        </div>

        <div class="todo">
            <div class="head">
                <div class="tile">
                    <h3>Todo Title</h3>
                </div>
                <div class="action">
                    <a href="#"><i class="fa-solid fa-trash"></i></a>
                    <a href="#"><i class="fa-solid fa-pen"></i></a>
                </div>
            </div>

            <div class="todo_desc">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi autem repudiandae ducimus harum alias iure molestias neque. Unde, sunt recusandae.</p>
            </div>

            <p>Time: </p>
        </div> -->


    </section>
    <!-- todo list end -->



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


        // todo form open
        const add_todo = document.getElementById("add_todo");
        const todo_form = document.getElementById("todo_form");
        const add_new_todo_screen = document.querySelector(".add_new_todo_screen");

        add_todo.addEventListener("click", () => {
            todo_form.classList.toggle("form_show");
        })

        add_new_todo_screen.addEventListener("click", () => {
            todo_form.classList.toggle("form_show");
        })
    </script>

</body>

</html>