'use strict'


// search bar
let s_bar = document.getElementById("searchBar");
let s_btn = document.getElementById("searchBtn");

// book amount
let bookAmount = document.getElementById("bookAmount");
let minBook = bookAmount.getAttribute("min");
let maxBook = bookAmount.getAttribute("max");


// search bar
s_bar.addEventListener('input', (e) => {
    document.querySelectorAll('.livro').forEach((b) => {
        b.style.display = s_bar.value.length ? "none" : "";
    });
});

s_btn.addEventListener('click', (e) => {
    if(!s_bar.value.length)
        e.preventDefault();
}); 


// book amount
bookAmount.addEventListener("input", (e) => {
    if(bookAmount.value > parseInt(maxBook))
        bookAmount.value = maxBook;

    if(bookAmount.value < parseInt(minBook))
        bookAmount.value = minBook;
});

function reloadPageWithCategory() {
    document.getElementById("submitCategory").click();
    return false;
};