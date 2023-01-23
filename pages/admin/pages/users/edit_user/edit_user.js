'use strict'

const passBtn = document.getElementById("changePasswordVisibility");
const changeInputType = document.getElementById("validUserPassowrd");

let VISIBLE_PASSWORD = true;

passBtn.addEventListener("click", () => {
    VISIBLE_PASSWORD = !VISIBLE_PASSWORD;

    passBtn.innerHTML = VISIBLE_PASSWORD ? 'visibility' : 'visibility_off';
    changeInputType.type = !VISIBLE_PASSWORD ? 'text' : 'password';
});