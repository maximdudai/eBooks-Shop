'use strict'

const profileItems = document.querySelectorAll(".profile-item");

const newsLetterEmail = document.getElementById("index_mail");
const addNewsLetter = document.getElementById("send_button");

newsLetterEmail.addEventListener('input', () => {

    console.log(newsLetterEmail.length)

    if(newsLetterEmail.length != 0 && addNewsLetter.classList.contains('disabled'))
        addNewsLetter.classList.toggle('disabled');
});

profileItems.forEach(e => {
    e.addEventListener('mouseover', () => {
        e.style.scale = '1.1';
    });
    e.addEventListener('mouseout', () => {
        e.style.scale = '1';
    });
});
