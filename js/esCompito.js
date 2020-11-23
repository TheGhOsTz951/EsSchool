function divChanger() {
    let sign = document.getElementById("reg-div");
    let login = document.getElementById("acc-div");
    let accessBtn = document.getElementById("btn-log");
    let changerBtn = document.getElementById("btn-changer");

    if (sign.style.display === "none" || sign.style.display === "") {
        sign.style.display = "block";
        login.style.display = "none";
        accessBtn.value = "Registrati";
        changerBtn.innerHTML = "Sei gia' registrato? Accedi!";
    } else {
        sign.style.display = "none";
        login.style.display = "block";
        accessBtn.value = "Accedi";
        changerBtn.innerHTML = "Non sei registrato? Registrati!";
    }
}

function changeSel(divId) {
    let sel = document.getElementById("selected-attrezzo");
    let div = document.getElementById(divId);
    let clone = div.cloneNode(true);
    clone.id = "clone";

    while (sel.firstChild) {
        sel.removeChild(sel.lastChild);
    }

    sel.appendChild(clone);

    location.href = "#";
    location.href = "#clone";
}