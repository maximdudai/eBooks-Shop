
let HIDE_TIME = 7000;
let notifyApp = document.querySelector(".toast");
let hideTime;

const userNotify = () => {
    if(hideTime)
        return;

    hideTime = setTimeout(() => {
        notifyApp.classList.toggle("show");
        clearTimeout(hideTime);

    }, HIDE_TIME);
};
userNotify();

let btnClose = document.querySelector(".btn-close");
btnClose.addEventListener("click", () => {
    if(hideTime) {
        clearTimeout(hideTime);
    }
});