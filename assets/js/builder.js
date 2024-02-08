var acc = document.getElementsByClassName("accordion");

// var submitButton = document.createElement("button");
// submitButton.innerText = "Submit";
// submitButton.style.display = "none";

document.addEventListener("DOMContentLoaded", function () {
    var sections = document.querySelectorAll('.panel');
    var submitButton = document.createElement('button');
    var submitButtonWrapper = document.createElement("div");
    var submitButtonInfo = document.createElement("div");
    submitButton.classList.add("submit-button");
    submitButton.innerText = 'Submit';
    submitButton.style.display = 'none';
    submitButtonWrapper.classList.add('submit-button-container');
    submitButtonInfo.classList.add('submit-button-info')





    // Cacher le bouton initialement

    var allSectionsChecked = false;

    // Vérifier si toutes les cases de chaque section sont cochées
    function checkAllSectionsChecked() {
        allSectionsChecked = true;
        sections.forEach(function (section) {
            var checkboxes = section.querySelectorAll('input[type="checkbox"]');
            var sectionChecked = false;
            checkboxes.forEach(function (checkbox) {
                if (checkbox.checked) {
                    sectionChecked = true;
                }
            });
            if (!sectionChecked) {
                allSectionsChecked = false;
            }
        });

        // Afficher le bouton de soumission si toutes les sections sont cochées
        if (allSectionsChecked) {
            submitButton.style.display = 'block';
            submitButtonInfo.innerHTML = '';
        } else {
            submitButton.style.display = 'none';
            submitButtonInfo.innerHTML = 'Il faut cocher un choix par catégorie pour valider le formulaire.';

        }
    }

    // Ajouter un écouteur d'événements à chaque case
    sections.forEach(function (section) {
        var checkboxes = section.querySelectorAll('input[type="checkbox"]');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', checkAllSectionsChecked);
        });
    });

    document.querySelector('.last-section').appendChild(submitButtonWrapper); // Ajouter la div parent à la dernière section
    document.querySelector('.last-section').appendChild(submitButtonInfo); // Ajouter la div parent à la dernière section
    submitButtonWrapper.appendChild(submitButton); // Ajouter le bouton à la div parent

    // Ajouter un gestionnaire d'événements pour le clic sur le bouton de soumission
    submitButton.addEventListener('click', function () {
        alert('Form submitted!');
    });
});


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