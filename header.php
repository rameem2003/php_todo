<header>
    <div class="container">
        <div class="logo">
            <h1>TODO</h1>
            <span>BETA</span>

            <i class="fa-solid fa-bars" id="menu_tog"></i>
        </div>

        <div class="menu">
            <ul>
                <li><a href="">About</a></li>
                <li><a href="">Github</a></li>
                <li><a href="" id="context_menu"><i class="fa-solid fa-user"></i> <?php echo $row['f_name'] ?></a></li>
            </ul>

            <ul class="sub_menu_open" id="sub_menu_open">
                <li><a href="" id="editBtn"><i class="fa-solid fa-pen-to-square"></i> Edit Profile</a></li>
                <li><a href="./profile.php?logout=<?php echo $row['id'] ?>"><i class="fa-solid fa-power-off"></i> Logout</a></li>
                <li><a href="./profile.php?deleteAc=<?php echo $user_email ?>"><i class="fa-solid fa-circle-xmark"></i> Delete Account</a></li>
            </ul>
        </div>
    </div>
</header>


<script>
    const context_menu = document.getElementById("context_menu");
    const sub_menu_open = document.querySelector(".sub_menu_open");


    context_menu.addEventListener("click", (e) => {
        e.preventDefault();
        sub_menu_open.classList.toggle("active")
    })
</script>