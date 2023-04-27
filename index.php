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

                    <form action="" method="post" id="form_login">
                        <input type="email" name="email" id="" placeholder="Email">
                        <input type="password" name="pass" id="" placeholder="Password">

                        <button type="submit" name="login">Login</button>
                    </form>

                    <form action="" method="post" id="form_register">
                        <input type="email" name="new_email" id="" placeholder="Email">
                        <input type="password" name="new_pass" id="" placeholder="Create Password">
                        <input type="password" name="con_new_pass" id="" placeholder="Confirm New Password">

                        <button type="submit" name="register">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <script src="./js/script.js"></script>
</body>
</html>