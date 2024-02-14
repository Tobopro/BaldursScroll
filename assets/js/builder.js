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
    submitButtonInfo.classList.add('submit-button-info');






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

// document.addEventListener('DOMContentLoaded', function () {
//     let abilityPoints = 27;
//     document.querySelector('.ability_point').innerText = abilityPoints;
//     let currentValue = 8;

//     function updateAbilityPoints(input) {
//         const newValue = parseInt(input.value);

//         if (abilityPoints > 0) {
//             if (newValue > currentValue) {
//                 // Augmentation
//                 abilityPoints -= (newValue <= 12) ? 1 : 2;
//             } else if (newValue < currentValue) {
//                 // Diminution
//                 abilityPoints += (newValue < 12) ? 1 : 2;
//             }

//             currentValue = newValue;
//             document.querySelector('.ability_point').innerText = abilityPoints;
//         }
//     }

//     const abilityInputs = document.querySelectorAll('input[type="number"]');
//     abilityInputs.forEach(function (input) {
//         // Initialiser input.dataset.previousvalue avec la valeur par défaut
//         input.dataset.previousvalue = currentValue;

//         input.addEventListener('change', function () {
//             updateAbilityPoints(input);
//         });
//     });
// }); 


document.addEventListener('DOMContentLoaded', function () {
    let abilityPoints = 27;
    const abilityPointElement = document.querySelector('.ability_point');
    let currentValue = 8;
    abilityPointElement.innerText = abilityPoints;
    let newValue = currentValue;
    let input = this.parentElement.querySelector('input[type=number]');
                 newValue = parseInt(input.value);


    function handleButtonClick(btnClass, increment) {
        const buttons = document.querySelectorAll(btnClass);
        buttons.forEach(function (button) {
            button.addEventListener('click', function (event) {
                const clickedButton = event.target;
                

                if (abilityPointElement.innerText !== '0') {
                    if (btnClass === '.moins' ) {
                        if (newValue === 8) {
                            clickedButton.disabled = true;
                        }
                        else{
                            clickedButton.disabled = false;
                        }
                        if (newValue <= 13) {
                            abilityPoints +=  increment ;
                        }else{
                            abilityPoints += 2 * increment;
                        }
                       
                    } else if (btnClass === '.plus' ) {
                        if (newValue === 15) {
                            clickedButton.disabled = true;
                        }else{
                            clickedButton.disabled = false;
                        }
                        
                        if (newValue >= 13) {
                            abilityPoints += 2*increment;
                        }
                        else{
                            abilityPoints += increment;
                        }
                        
                        // abilityPoints += (newValue >= 12) ? increment : 2 * increment;
                    }
                    
                    abilityPointElement.innerText = abilityPoints;
                }
                
            });
        });
    }

    handleButtonClick('.moins', 1);
    handleButtonClick('.plus', -1);
});









// if (value == 15) {
//     plus.disabled = true;
// }



