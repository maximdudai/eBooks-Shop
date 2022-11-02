'use strict'


let s_bar = document.getElementById("searchBar");
let s_btn = document.getElementById("searchBtn");

s_bar.addEventListener('input', (e) => {
    document.querySelectorAll('.livro').forEach((b) => {
        b.style.display = s_bar.value.length ? "none" : "";
    });
});

s_btn.addEventListener('click', (e) => {
    if(!s_bar.value.length)
        e.preventDefault();
}); 
