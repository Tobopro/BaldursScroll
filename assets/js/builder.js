
document.addEventListener("DOMContentLoaded", function () {
  var accordionButtons = document.querySelectorAll('.accordion');

  accordionButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      event.preventDefault(); // Empêche l'action par défaut du bouton (ouverture du panneau)
      // Ajoutez ici votre propre logique pour gérer l'ouverture/fermeture des panneaux si nécessaire
    });
  });

  const moinsButtons = document.querySelectorAll('.moins');
  moinsButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      const inputElement = button.parentNode.querySelector('input[type=number]');
      inputElement.stepDown();
    });
  });

  const plusButtons = document.querySelectorAll('.plus');
  plusButtons.forEach(function (button) {
    button.addEventListener('click', function (event) {
      event.preventDefault();
      const inputElement = button.parentNode.querySelector('input[type=number]');
      inputElement.stepUp();
    });
  });

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
    // function checkAllSectionsChecked() {
    //   allSectionsChecked = true;
    //   sections.forEach(function (section) {
    //     var checkboxes = section.querySelectorAll('input[type="checkbox"]');
    //     var sectionChecked = false;
    //     checkboxes.forEach(function (checkbox) {
    //       if (checkbox.checked) {
    //         sectionChecked = true;
    //       }
    //     });
    //     if (!sectionChecked) {
    //       allSectionsChecked = false;
    //     }
    //   });

    //   // Afficher le bouton de soumission si toutes les sections sont cochées
    //   if (allSectionsChecked) {
    //     submitButton.style.display = 'block';
    //     submitButtonInfo.innerHTML = '';
    //   } else {
    //     submitButton.style.display = 'none';
    //     submitButtonInfo.innerHTML = 'Il faut cocher un choix par catégorie pour valider le formulaire.';

    //   }
    // }

    // Ajouter un écouteur d'événements à chaque case
    // sections.forEach(function (section) {
    //   var checkboxes = section.querySelectorAll('input[type="checkbox"]');
    //   checkboxes.forEach(function (checkbox) {
    //     checkbox.addEventListener('change', checkAllSectionsChecked);
    //   });
    // });

    // document.querySelector('.last-section').appendChild(submitButtonWrapper); // Ajouter la div parent à la dernière section
    // document.querySelector('.last-section').appendChild(submitButtonInfo); // Ajouter la div parent à la dernière section
    // submitButtonWrapper.appendChild(submitButton); // Ajouter le bouton à la div parent

    // Ajouter un gestionnaire d'événements pour le clic sur le bouton de soumission
    // submitButton.addEventListener('click', function () {
    //   alert('Form submitted!');
    // });
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



  // Fonction pour désactiver tous les boutons "moins"
  function disableMinusButtons() {
    const minusButtons = document.querySelectorAll('.moins');
    minusButtons.forEach(function (button) {
      // button.disabled = true;
    });
  }

  // Fonction pour activer tous les boutons "moins"
  function enableMinusButtons() {
    const minusButtons = document.querySelectorAll('.moins');
    minusButtons.forEach(function (button) {
      button.disabled = false;
    });
  }
  // Fonction pour gérer l'événement du bouton "moins"
  function handleMinusButtonClick(nodeName) {
    const inputElement = document.getElementById(nodeName);
    inputElement.stepDown();
    const minusButton = document.querySelector(`.moins[name="${nodeName}"]`);

    if (parseInt(inputElement.value, 10) !== 8) {
      console.log('false minus');
      minusButton.disabled = false;
    } else {
      console.log('true minus');
      minusButton.disabled = true;
    }
    console.log(`Clicked on minus for ${nodeName}, Node number: ${inputElement.value}`);
  }

  // Fonction pour gérer l'événement du bouton "plus"
  function handlePlusButtonClick(nodeName) {
    const inputElement = document.getElementById(nodeName);
    inputElement.stepUp();
    const plusButton = document.querySelector(`.plus[name="${nodeName}"]`);
    if (parseInt(inputElement.value, 10) !== 15) {
      console.log('false plus');
      plusButton.disabled = false;
    } else {
      console.log('true plus');
      plusButton.disabled = true;
    }
    console.log(`Clicked on plus for ${nodeName}, Node number: ${inputElement.value}`);
  }

  document.addEventListener('DOMContentLoaded', function () {
    // Désactiver tous les boutons "moins" au début
    disableMinusButtons();

    // Activer les boutons "moins" lorsque le Clear button est cliqué
    // document.getElementById('Clear').addEventListener('click', function () {
    //   enableMinusButtons();
    // });

    // Sélectionnez tous les boutons "moins" et ajoutez un écouteur d'événements
    const minusButtons = document.querySelectorAll('.moins');
    minusButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const nodeName = button.getAttribute('name');
        handleMinusButtonClick(nodeName);
      });
    });

    // Sélectionnez tous les boutons "plus" et ajoutez un écouteur d'événements
    const plusButtons = document.querySelectorAll('.plus');
    plusButtons.forEach(function (button) {
      button.addEventListener('click', function () {
        const nodeName = button.getAttribute('name');
        handlePlusButtonClick(nodeName);
      });
    });
  });


});


