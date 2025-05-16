// ====================== MENU BURGER INTERACTIF ======================

// Bouton du menu (les 3 barres)
let menuButton = document.querySelector(".MenuBarre");

// Barre contenant les liens
let menuIcons = document.querySelector(".MenuLienBarre");

// Conteneur du menu
let mini = document.querySelector(".Menu");

// Liens du menu
let menuItems = document.querySelectorAll(".MenuLien");

let menuOuvert = false; // État du menu

menuButton.addEventListener('click', () => {
    if (menuOuvert) {
        // Fermer avec animation
        menuIcons.classList.remove('MenuLienActive');
        menuIcons.classList.add('MenuLienClosing');
        
        setTimeout(() => {
            menuItems.forEach((item) => {
                item.style.display = "none";
            });
            menuIcons.classList.remove('MenuLienClosing');
        }, 500); // durée identique à l'animation CSS

    } else {
        // Ouvrir
        menuItems.forEach((item) => {
            item.style.display = "flex";
        });
        menuIcons.classList.add('MenuLienActive');
    }

    // Bascule les classes d'état
    mini.classList.toggle('MenuActive');
    menuButton.classList.toggle('MenuBarreActive');
    menuOuvert = !menuOuvert;
});

// ====================== GESTION DES ÉTOILES CLIQUABLES (AVIS) ======================

// Récupère toutes les étoiles de notation
let etoiles = document.querySelectorAll("#etoiles span");

// Pour chaque étoile, on ajoute un clic
etoiles.forEach(star => {
    star.addEventListener("click", function() {
        // Récupère la valeur de l’étoile cliquée
        let etoilesValue = this.getAttribute("data-value");

        // Affecte cette valeur à l’input caché (envoyée au serveur)
        document.getElementById("etoilesInput").value = etoilesValue;

        // Réinitialise toutes les étoiles en noir
        etoiles.forEach(s => s.style.color = "black");

        // Colore en doré les étoiles jusqu’à la note sélectionnée
        for (let i = 0; i < etoilesValue; i++) {
            etoiles[i].style.color = "gold";
        }
    });
});

// ====================== AFFICHAGE DES ÉTOILES DE LA MOYENNE ======================

// Récupère la moyenne depuis le HTML (doit être dans un span avec id 'etoiles_moyenne')
const moyenne = parseFloat(document.getElementById('etoiles_moyenne')?.innerText || 0);

// Récupère le conteneur destiné à afficher les étoiles de la moyenne
const starContainer = document.querySelector('.stars-container');

// Génère dynamiquement 5 étoiles (remplies ou non selon la moyenne)
for (let i = 1; i <= 5; i++) {
    const star = document.createElement('span');
    star.classList.add('star');
    if (i <= moyenne) {
        star.classList.add('filled'); // Ajoute une classe spéciale si l’étoile est dans la moyenne
    }
    starContainer?.appendChild(star); // Ajoute l’étoile dans le conteneur si celui-ci existe
}


// ====================== INTERACTIONS DYNAMIQUES SUR LES ÉTOILES ======================

document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.etoiles span'); // Étoiles interactives
    const etoilesInput = document.getElementById('etoilesInput'); // Champ de note caché

    // Clic sur une étoile => sélectionne la note
    stars.forEach(star => {
        star.addEventListener('click', function () {
            let value = this.getAttribute('data-value');
            etoilesInput.value = value;

            // Réinitialise les étoiles sélectionnées
            stars.forEach(s => s.classList.remove('selected'));

            // Ajoute la classe "selected" jusqu’à la note sélectionnée
            for (let i = 0; i < value; i++) {
                stars[i].classList.add('selected');
            }
        });

        // Survol de la souris => effet visuel temporaire
        star.addEventListener('mouseover', function () {
            let value = this.getAttribute('data-value');
            stars.forEach((s, index) => {
                if (index < value) {
                    s.classList.add('hover');
                } else {
                    s.classList.remove('hover');
                }
            });
        });

        // Fin du survol => supprime l’effet
        star.addEventListener('mouseout', function () {
            stars.forEach(s => s.classList.remove('hover'));
        });
    });
});

    // ============================================
    //  Empêche l'ouverture du menu clic droit
    // ============================================
    document.addEventListener('contextmenu', function(e) {
        e.preventDefault(); // Empêche le menu contextuel (clic droit)
    });

    // ============================================
    // Empêche l'ouverture des outils développeur via le clavier
    // ============================================
    document.addEventListener('keydown', function(e) {
        // Empêche F12 (dev tools)
        if (e.key === 'F12') {
            e.preventDefault();
        }

        // Empêche Ctrl+Shift+I (Inspecter)
        if (e.ctrlKey && e.shiftKey && e.key === 'I') {
            e.preventDefault();
        }

        // Empêche Ctrl+Shift+J (Console)
        if (e.ctrlKey && e.shiftKey && e.key === 'J') {
            e.preventDefault();
        }

        // Empêche Ctrl+U (voir le code source)
        if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
        }

        // Empêche Ctrl+S (enregistrer la page)
        if (e.ctrlKey && e.key === 's') {
            e.preventDefault();
        }

        // Empêche Ctrl+Shift+C (Inspecter un élément)
        if (e.ctrlKey && e.shiftKey && e.key === 'C') {
            e.preventDefault();
        }
    });