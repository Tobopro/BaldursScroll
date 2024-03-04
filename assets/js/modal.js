// Récupérer la référence vers la modale et le bouton pour ouvrir la modale
const modal = document.getElementById("myModal");
const btn = document.getElementById("deleteBtn");

// Récupérer la référence vers le bouton de fermeture de la modale
const span = document.getElementsByClassName("close")[0];

if (modal && btn && span) {

btn.addEventListener("click", function (event) {
    event.preventDefault(); // Empêcher le comportement de redirection par défaut du lien
    modal.style.display = "block"; // Ouvrir la modale
});

// Ouvrir la modale lorsque le bouton est cliqué
btn.onclick = function () {
    modal.style.display = "block";
}

// Fermer la modale lorsque l'utilisateur clique sur le bouton de fermeture
span.onclick = function () {
    modal.style.display = "none";
}

// Fermer la modale lorsque l'utilisateur clique en dehors de la modale
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Exécuter l'action de suppression lorsque l'utilisateur clique sur le bouton de confirmation
document.getElementById("confirmDeleteBtn").addEventListener("click", function () {
    // Ici, vous pouvez exécuter votre code pour supprimer l'élément
    // Par exemple, vous pouvez utiliser une requête AJAX pour envoyer une demande de suppression au serveur
    // Après la suppression réussie, vous pouvez rediriger l'utilisateur vers une autre page ou mettre à jour l'interface utilisateur

    modal.style.display = "none"; // Fermer la modale après la suppression
});

}