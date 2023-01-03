
let HIDE_TIME = 5000;
let notifyApp = document.querySelector(".toast");
let isNotificationVisible;

const userNotify = () => {
    if(isNotificationVisible)
        return;

    isNotificationVisible = setTimeout(() => {
        notifyApp.classList.toggle("show");
        clearTimeout(isNotificationVisible);

    }, HIDE_TIME);
};
userNotify();

let btnClose = document.querySelector(".btn-close");
btnClose.addEventListener("click", () => {
    if(isNotificationVisible) {
        clearTimeout(isNotificationVisible);
    }
});