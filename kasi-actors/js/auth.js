window.addEventListener("load",() =>{
    const btn = document.getElementById("register");

    btn.addEventListener("click",(event) =>{
        event.preventDefault();
        console.log("clicked")
        const first_name = document.getElementById("first_name");
        const surname = document.getElementById("surname");
        const email = document.getElementById("email");
        const phone_number = document.getElementById("phone_number");
        const location = document.getElementById("location");
        const password = document.getElementById("password");
        const password_confirmation = document.getElementById("password_confirmation");

        const body = {
            first_name:first_name,
            surname:surname,
            email:email,
            phone_number:phone_number,
            location:location,
            password:password,
            password_confirmation:password_confirmation
        }

        fetch("http://127.0.0.1:8000/api/auth/register",{method:'POST',body:JSON.stringify(body)})
        .then(response => response.json())
        .then(data => {
            console.log("data")
        })
    });
});