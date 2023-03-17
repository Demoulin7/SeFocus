function initColorMode(){

    let cookie = getCookie("color_mode");

    let checkbox = document.getElementById("checkbox-input-theme");

    if (cookie == "light"){
        checkbox.checked = true;
        document.documentElement.setAttribute("color-mode", "light");
        localStorage.setItem("color-mode", "light");
    }
}

function toggleColorMode(checkboxElem) {
    if (checkboxElem.checked) {
        document.documentElement.setAttribute("color-mode", "light"); // Sets the user's preference in local storage

        document.cookie = 'color_mode=light; path=/';

        localStorage.setItem("color-mode", "light");
    } else {
        document.documentElement.setAttribute("color-mode", "dark"); // Sets the user's preference in local storage

        document.cookie = 'color_mode=dark; path=/';

        localStorage.setItem("color-mode", "dark");
    }
}

function getCookie(cname) {
    let name = cname + "=";
    let ca = document.cookie.split(';');
    for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

//Execution
window.addEventListener('load', function () {
    initColorMode();
})
