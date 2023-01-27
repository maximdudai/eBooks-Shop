'use strict'

const bookPrice = document.getElementById("newBookPrice");

bookPrice.addEventListener('input', () => {
    console.log(bookPrice.value);

    if(bookPrice.value < bookPrice.ariaValueMin)
        return bookPrice.value = 1;
});