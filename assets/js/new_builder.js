let builder_form = document.forms.builder;
// ABILITY PANNEL
// ABILITY POINTS
let total_points = document.forms.builder.total_points;

let strength_input = builder_form.builder_strength;
let dexterity_input = builder_form.builder_dexterity;
let constitution_input = builder_form.builder_constitution;
let intelligence_input = builder_form.builder_intelligence;
let wisdom_input = builder_form.builder_wisdom;
let charisma_input = builder_form.builder_charisma;

const ability_inputs = {
    "strength" : strength_input,
    "dexterity" : dexterity_input,
    "constitution" : constitution_input,
    "intelligence" : intelligence_input,
    "wisdom" : wisdom_input,
    "charisma" : charisma_input
}

builder_form.addEventListener("click", (event) => {
    // Check if the button pressed is minus
    if (event.target.classList.value == "minus") {
        // Check and get the correct input number
        if (event.target.getAttribute("name") in ability_inputs) {
            target_input = ability_inputs[event.target.getAttribute("name")];
            // Check if operation is valid
            if (target_input.value > 13) {
                target_input.stepDown();
                total_points.stepUp(2);
            } else if (total_points.value < 27 && target_input.value > 8) {
                target_input.stepDown();
                total_points.stepUp();
            }
        }
    }

    // Check if the button pressed is plus
    if (event.target.classList.value == "plus") {
        // Check and get the correct input number
        if (event.target.getAttribute("name") in ability_inputs) {
            target_input = ability_inputs[event.target.getAttribute("name")];
            // Check if operation is valid
            if (total_points.value > 1 && target_input.value < 15 && target_input.value >= 13) {
                target_input.stepUp();
                total_points.stepDown(2);
            } else if (total_points.value > 0 && target_input.value < 13) {
                target_input.stepUp();
                total_points.stepDown();
            }
        }
    }
})
// END ABILITY POINTS

// ABILITY SCORE BONUS
let ability_bonus_1 = builder_form.builder_abilityScoreBonus1;
let ability_bonus_2 = builder_form.builder_abilityScoreBonus2;

// Change the selected option on the other select when both are the same
ability_bonus_1.addEventListener("change", () =>{
    if (ability_bonus_1.selectedIndex == ability_bonus_2.selectedIndex) {
        ability_bonus_2.selectedIndex = (ability_bonus_2.selectedIndex + 1) % ability_bonus_2.length;
    }
})
ability_bonus_2.addEventListener("change", () =>{
    if (ability_bonus_2.selectedIndex == ability_bonus_1.selectedIndex) {
        ability_bonus_1.selectedIndex = (ability_bonus_1.selectedIndex + 1) % ability_bonus_1.length;
    }
})
// END ABILITY SCORE BONUS

// CLEAR BUTTON
const clear_button = builder_form.clear;

function reset_abilities()
{
    // Reset all abilities back to 8
    for (ability in ability_inputs) {
        ability_inputs[ability].value = 8;
        ability_inputs[ability].setAttribute("value", 8);
    }

    // Reset total points back to 27
    total_points.value = 27;
    total_points.setAttribute("value", 27);

    // Reset the ability score bonus to STR and DEX
    ability_bonus_1.selectedIndex = 0;
    ability_bonus_2.selectedIndex = 1;
}

clear_button.addEventListener("click", () => {
    reset_abilities();
})
// END CLEAR BUTTON
// END ABILITY PANNEL