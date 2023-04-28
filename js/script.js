const switchBtn = document.querySelectorAll(".button button");
const form_login = document.getElementById("form_login");
const form_register = document.getElementById("form_register");
console.log(switchBtn);


// login / registrayion switch
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


// update form hide / show