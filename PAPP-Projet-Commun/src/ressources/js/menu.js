let menuButton = document.querySelector(".menuBarre");
let menuIcons = document.querySelector(".menuIcon");
let mini = document.querySelector(".mini");
let menuItems = document.querySelectorAll(".menuItem");
let deconnexion = document.querySelector(".Deconnexion")

menuButton.addEventListener('click', () => {
    if(menuButton.classList.contains('menuBarreActive')){
        menuItems.forEach((item) => {
            item.style.display = "none";
        })
    } else {
        menuItems.forEach((item) => {
            item.style.display = "flex";
        })    
    }
    mini.classList.toggle('miniActive');
    menuIcons.classList.toggle('menuIconActive');
    menuButton.classList.toggle('menuBarreActive');
    deconnexion.classList.toggle('DeconnexionActive');
})