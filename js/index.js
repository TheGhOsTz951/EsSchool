function showAdd() {
    let div = document.getElementById("add-es-div");

    if (div.style.display === "none") {
        div.style.display = "block";
        selShow();
    } else {
        div.style.display = "none"
    }
}

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

function selShow() {
    let sel = document.getElementById("sel-file");
    let fileType = sel.options[sel.selectedIndex].value;
    
    let descInput = document.getElementById("desc");

    if (fileType === "html") {
        descInput.style.display = "block";
    } else {
        descInput.style.display = "none";
    }
}