window.addEventListener("load", function() {

    
    showPassword = document.querySelector('.show-password');
    showPassword.addEventListener('click', () => {

       
        password1 = document.querySelector('.password1');

        if ( password1.type === "text" ) {
            password1.type = "password"
            showPassword.classList.remove('fa-eye-slash');
        } else {
            password1.type = "text"
            showPassword.classList.toggle("fa-eye-slash");
        }

    })

});