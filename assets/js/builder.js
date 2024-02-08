var acc = document.getElementsByClassName("accordion");

var submitButtonWrapper = document.createElement("div"); // Créer une div parent
submitButtonWrapper.classList.add('submit-button-container');
var submitButton = document.createElement("button");
submitButton.innerText = "Submit";
submitButton.style.display = "none";
submitButton.classList.add("submit-button"); // Ajouter la classe au bouton

submitButtonWrapper.appendChild(submitButton); // Ajouter le bouton à la div parent

document.querySelector('.last-section').appendChild(submitButtonWrapper); // Ajouter la div parent à la dernière section

function checkIfChecked() {
    var checkboxes = document.querySelectorAll('.last-section input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            submitButton.style.display = "block";
            return;
        }
    }
    submitButton.style.display = "none";
}

var lastSectionCheckboxes = document.querySelectorAll('.last-section input[type="checkbox"]');
for (var i = 0; i < lastSectionCheckboxes.length; i++) {
    lastSectionCheckboxes[i].addEventListener("click", checkIfChecked);
}

submitButton.addEventListener("click", function () {
    alert("Form submitted!");
});
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {
        // Fermer toutes les sections qui ne sont pas cliquées
        for (var j = 0; j < acc.length; j++) {
            if (j !== i) {
                acc[j].classList.remove("active");
                acc[j].nextElementSibling.style.display = "none";
            }
        }

        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");

        /* Toggle between hiding and showing the active panel */
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}