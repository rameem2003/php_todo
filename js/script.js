const switchBtn = document.querySelectorAll(".button button");
const form_login = document.getElementById("form_login");
const form_register = document.getElementById("form_register");

const menu_tog = document.getElementById("menu_tog");
const menu = document.querySelector(".menu");
console.log(switchBtn);


// login / registration switch
switchBtn.forEach(option => {
    option.addEventListener("click", () => {
        document.querySelector(".button .active").classList.remove("active");
        option.classList.add("active")

        console.log(option.id);

        if(option.id === "login"){
            form_login.style.display = "initial";
            form_register.style.display = "none"
        }else if(option.id === "register"){
            form_login.style.display = "none";
            form_register.style.display = "initial"
        }
    })
})


// menu toggle
menu_tog.addEventListener("click", () => {
    menu.classList.toggle("open_menu")
})

menu.addEventListener("click", () => {
    menu.classList.remove("open_menu");
})

