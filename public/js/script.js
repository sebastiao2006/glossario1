const modal = document.querySelector(".modal");
const btn = document.getElementById("showFormBtn");
const close = document.querySelector(".close");

btn.onclick = function() {
    modal.style.display = "flex";
}

close.onclick = function() {
    modal.style.display = "none";
}

window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}