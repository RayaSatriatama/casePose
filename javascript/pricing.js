function triggerButton(id) {
    document.getElementById(id).click();
}

function goToPage(url) {
    window.location.href = url;
}

function filterFunction() {
    var input, filter, div, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    div = document.getElementById("myDropdown");
    div = div.getElementsByTagName("div");
    for (i = 0; i < div.length; i++) {
        txtValue = div[i].textContent || div[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            div[i].style.display = "";
        } else {
            div[i].style.display = "none";
        }
    }
}

function selectItem(value, id) {
    document.getElementById("myInput").value = value;
    document.getElementById("projectID").value = id;
    var dropdown = document.getElementById("myDropdown");
    var items = dropdown.getElementsByTagName("div");
    for (var i = 0; i < items.length; i++) {
        items[i].style.display = "none";
    }
}

function showDropdown() {
    document.getElementById("myDropdown").style.display = "block";
}

window.onclick = function(event) {
    if (!event.target.matches('.dropdown-search input')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
    }
}