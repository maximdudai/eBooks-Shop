'use strict'

const profileItems = document.querySelectorAll(".profile-item");

profileItems.forEach(e => {
    e.addEventListener('mouseover', () => {
        e.style.scale = '1.1';
    });
    e.addEventListener('mouseout', () => {
        e.style.scale = '1';
    });
});
