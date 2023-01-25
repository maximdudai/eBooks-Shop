'use strict'

// OLD PASSWORD
const btnOldPassowrd = document.getElementById("btnOldPassowrd");
const oldUserPassowrd = document.getElementById("oldUserPassowrd");

// MEW PASSWORD
const btnNewPassowrd = document.getElementById("btnNewPassowrd");
const newUserPassowrd = document.getElementById("newUserPassowrd");

let VISIBLE_OLD_PASSWORD = true;
let VISIBLE_NEW_PASSWORD = true;

const togglePassword = (type) => {

    console.log(type);

    const clickedButton = !type ? btnOldPassowrd : btnNewPassowrd;
    const inputToChange = !type ? oldUserPassowrd : newUserPassowrd;

    console.log(clickedButton);

    clickedButton.innerHTML = VISIBLE_NEW_PASSWORD ? 'visibility' : 'visibility_off';
    inputToChange.type = !VISIBLE_NEW_PASSWORD ? 'text' : 'password';

    return !type ? VISIBLE_OLD_PASSWORD = !VISIBLE_OLD_PASSWORD : VISIBLE_NEW_PASSWORD = !VISIBLE_NEW_PASSWORD;
};

btnOldPassowrd.addEventListener('click', () => togglePassword(0));
btnNewPassowrd.addEventListener('click', () => togglePassword(1));
