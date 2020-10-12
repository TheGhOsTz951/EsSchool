function showAdd() {
    var div = document.getElementById("add-es-div");

    if (div.style.display === "none") {
        div.style.display = "block"
    } else {
        div.style.display = "none"
    }
}

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}