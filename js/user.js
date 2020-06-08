document.getElementById("af").onsubmit = validate;

function validate() {
    let valid = true;
    let errors = document.getElementsByClassName("errJ");
    // make all err span lane hidden
    for (let i = 0; i < errors.length; i++) {
        errors[i].style.visibility = "hidden";
    }

    // check firstName is empty or not
    let firstName = document.getElementById("firstName").value;
    if (firstName === "") {
        let errFirst = document.getElementById("errFirst");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    // check lastName is empty or not
    let lastName = document.getElementById("lastName").value;
    if (lastName === "") {
        let errFirst = document.getElementById("errlast");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    // check email contain @ and "."
    let email = document.getElementById("email").value;
    var mailformat = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    ;
    if (!email.match(mailformat)) {
        let errFirst = document.getElementById("errEmail");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    // validation phone number
    let phone = document.getElementById("phone").value;
    var phoneFormat=/^[0-999999999]+$/;
    if (!phone.match(phoneFormat)) {
        let errFirst = document.getElementById("errPhone");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    // validation password
    let password = document.getElementById("password").value;
    if (password === "") {
        let errFirst = document.getElementById("errPassword");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    //confirm password
    let confirm = document.getElementById("confirm").value;
    if (password !== confirm) {
        let errFirst = document.getElementById("errConfirm");
        errFirst.style.visibility = "visible";
        valid = false;
    }

    return valid;
}
