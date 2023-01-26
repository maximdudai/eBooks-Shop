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

    !type ? VISIBLE_OLD_PASSWORD = !VISIBLE_OLD_PASSWORD : VISIBLE_NEW_PASSWORD = !VISIBLE_NEW_PASSWORD

    const clickedButton = !type ? btnOldPassowrd : btnNewPassowrd;
    const inputToChange = !type ? oldUserPassowrd : newUserPassowrd;
    const toChange = !type ? VISIBLE_OLD_PASSWORD : VISIBLE_NEW_PASSWORD;


    clickedButton.innerHTML = toChange ? 'visibility' : 'visibility_off';
    inputToChange.type = !toChange ? 'text' : 'password';

    return;
};

btnOldPassowrd.addEventListener('click', () => togglePassword(0));
btnNewPassowrd.addEventListener('click', () => togglePassword(1));
