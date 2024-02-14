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


// document.addEventListener('DOMContentLoaded', function () {
//     let abilityPoints = 27;
//     const abilityPointElement = document.querySelector('.ability_point');
//     abilityPointElement.innerText = abilityPoints;
//     let newValue = document.querySelector('input[type=number]').value;




//     function handleButtonClick(btnClass, increment) {
//         const buttons = document.querySelectorAll(btnClass);
//         buttons.forEach(function (button) {
//             button.addEventListener('click', function (event) {
//                 const clickedButton = event.target;


//                 let input = this.parentElement.querySelector('input[type=number]');
//                  newValue = parseInt(input.value);
//                  console.log(clickedButton.nextSibling);
//                 if (abilityPointElement.innerText !== '0') {
//                     if (btnClass === '.moins' ) {
//                         if (newValue === 8) {
//                             clickedButton.disabled = true;
//                         }
//                         else{
//                             clickedButton.disabled = false;
//                         }
//                         if (newValue <= 13) {
//                             abilityPoints +=  increment ;
//                         }else{
//                             abilityPoints += 2 * increment;
//                         }

//                     } else if (btnClass === '.plus' ) {
//                         if (newValue === 15) {
//                             clickedButton.disabled = true;
//                         }else{
//                             clickedButton.disabled = false;
//                         }

//                         if (newValue >= 13) {
//                             abilityPoints += 2*increment;
//                         }
//                         else{
//                             abilityPoints += increment;
//                         }

//                         // abilityPoints += (newValue >= 12) ? increment : 2 * increment;
//                     }

//                     abilityPointElement.innerText = abilityPoints;
//                 }

//             });
//         });
//     }

//     handleButtonClick('.moins', 1);
//     handleButtonClick('.plus', -1);
// });




// document.addEventListener("DOMContentLoaded", function () {
//     // Get all the number-input elements
//     var numberInputs = document.querySelectorAll(".number-input input");
//     let abilityPoints = 27;
//     const abilityPointElement = document.querySelector('.ability_point');
//     abilityPointElement.innerText = abilityPoints;

//     // Add event listeners to each number-input element
//     numberInputs.forEach(function (input) {
//         input.addEventListener("input", function () {
//             // Get the corresponding moins and plus buttons
//             var moinsButton = input.parentNode.querySelector(".moins");
//             var plusButton = input.parentNode.querySelector(".plus");

//             // Check if the input value is strictly equal to 8 and disable moinsButton
//             moinsButton.disabled = input.value == 8;

//             // Check if the input value is strictly equal to 15 and disable plusButton
//             plusButton.disabled = input.value == 15;
//         });
//     });
//     // Clear button functionality
//     var clearButton = document.getElementById("Clear");
//     clearButton.addEventListener("click", function () {
//         // Reset all inputs to their initial value (8)
//         numberInputs.forEach(function (input) {
//             input.value = 8;
//         });

//         // Enable all moins and plus buttons
//         var moinsButtons = document.querySelectorAll(".moins");
//         var plusButtons = document.querySelectorAll(".plus");

//         moinsButtons.forEach(function (button) {
//             button.disabled = false;
//         });

//         plusButtons.forEach(function (button) {
//             button.disabled = false;
//         });
//     });
// });

document.addEventListener("DOMContentLoaded", function () {
    // Initialize .ability_point to 27
    var abilityPointElement = document.querySelector(".ability_point");
    var abilityPoints = 27;
    updateAbilityPointDisplay();

    // Get all the number-input elements
    var numberInputs = document.querySelectorAll(".number-input input");

    // Add event listeners to each number-input element
    numberInputs.forEach(function (input) {
      input.addEventListener("input", function () {
        // Get the corresponding moins and plus buttons
        var moinsButton = input.parentNode.querySelector(".moins");
        var plusButton = input.parentNode.querySelector(".plus");

        // Check if the input value is strictly equal to 8 and disable moinsButton
        moinsButton.disabled = input.value == 8;

        // Check if the input value is strictly equal to 15 and disable plusButton
        plusButton.disabled = input.value == 15;
      });
    });

    // Add event listeners to moins and plus buttons
    var moinsButtons = document.querySelectorAll(".moins");
    var plusButtons = document.querySelectorAll(".plus");

    moinsButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        // Decrement abilityPoints by 1 and update the display
        abilityPoints--;
        updateAbilityPointDisplay();
      });
    });

    plusButtons.forEach(function (button) {
      button.addEventListener("click", function () {
        // Increment abilityPoints by 1 and update the display
        abilityPoints++;
        updateAbilityPointDisplay();
      });
    });

    // Clear button functionality
    var clearButton = document.getElementById("Clear");
    clearButton.addEventListener("click", function () {
      // Reset all inputs to their initial value (8)
      numberInputs.forEach(function (input) {
        input.value = 8;
      });

      // Enable all moins and plus buttons
      moinsButtons.forEach(function (button) {
        button.disabled = false;
      });

      plusButtons.forEach(function (button) {
        button.disabled = false;
      });

      // Reset abilityPoints to 27 and update the display
      abilityPoints = 27;
      updateAbilityPointDisplay();
    });

    // Function to update the display of .ability_point
    function updateAbilityPointDisplay() {
      abilityPointElement.textContent = abilityPoints;
    }
  });


// if (value == 15) {
//     plus.disabled = true;
// }



