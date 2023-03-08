function toggleColorMode(checkboxElem) {
    if (checkboxElem.checked) {
        document.documentElement.setAttribute("color-mode", "light"); // Sets the user's preference in local storage

        localStorage.setItem("color-mode", "light");
    } else {
        document.documentElement.setAttribute("color-mode", "dark"); // Sets the user's preference in local storage

        localStorage.setItem("color-mode", "dark");
    }
}