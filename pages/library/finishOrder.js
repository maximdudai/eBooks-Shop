// finish order
let finishBtn = document.getElementById("finishPayment");
finishBtn.addEventListener("click", (e) => {

    e.preventDefault();

    document.getElementById("paymentForm").classList.toggle("d-none");
    document.getElementById("backToShop").classList.toggle("d-none");

});