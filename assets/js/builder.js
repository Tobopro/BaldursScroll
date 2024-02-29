const builder_form = document.forms.builder;
// ABILITY PANNEL
// ABILITY POINTS
let total_points = builder_form.total_points;

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
// TODO calculate available points for edit
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

// AJAX CLASSES
const classField = document.querySelector("#builder_idClasses");
const subclassField = document.querySelector("#builder_idSubClasses");

let classId;

let ajaxClass;

async function getClassesAndSubClasses() {
    const request = await fetch(`${window.location.origin}/builder/info/classes`);
    ajaxClass = await request.json();

    for (const formCheck of classField.children) {
        for (const input of formCheck.children) {
            if (input.getAttribute("checked") == "checked") {
                classId = input.value;
            }
        }
    }

    let subclassId = 0;
    for (const formCheck of subclassField.children) {
        for (const input of formCheck.children) {
            if (input.getAttribute("checked") == "checked") {
                subclassId = input.value;
            }
        }
    }

    changeAvailableSubclasses(subclassId);
}

function changeAvailableSubclasses(dbSubClass = 0) {
    if (!classId) {
        document.querySelector("#subclasses-accordion").classList.add("d-none");
        subclassField.innerHTML = `
        <div class="form-check">
            <input type="radio" id="builder_idSubClasses_placeholder" name="builder[idSubClasses]" class="form-check-input" value checked="checked">
            <label class="form-check-label" for="builder_idSubClasses_placeholder">Choose a subclass</label>
        </div>
        `;
        return;
    }

    html = "";
    ajaxClass.forEach(gameClass => {
        if (gameClass.id == classId) {
            let first = true;
            gameClass.subclasses.forEach(subClass => {
                if (dbSubClass) {
                    if (subClass.id == dbSubClass) {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubClasses_${subClass.id}" name="builder[idSubClasses]" class="form-check-input" value="${subClass.id}" checked>
                            <label class="form-check-label" for="builder_idSubClasses_${subClass.id}">${subClass.name}</label>
                        </div>
                        `;
                    } else {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubClasses_${subClass.id}" name="builder[idSubClasses]" class="form-check-input" value="${subClass.id}">
                            <label class="form-check-label" for="builder_idSubClasses_${subClass.id}">${subClass.name}</label>
                        </div>
                        `;
                    }
                } else {
                    if (first) {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubClasses_${subClass.id}" name="builder[idSubClasses]" class="form-check-input" value="${subClass.id}" checked>
                            <label class="form-check-label" for="builder_idSubClasses_${subClass.id}">${subClass.name}</label>
                        </div>
                        `;
                        first = false;
                    } else {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubClasses_${subClass.id}" name="builder[idSubClasses]" class="form-check-input" value="${subClass.id}">
                            <label class="form-check-label" for="builder_idSubClasses_${subClass.id}">${subClass.name}</label>
                        </div>
                        `;
                    }
                }
            })
        }
    });
    subclassField.innerHTML = html;
    document.querySelector("#subclasses-accordion").classList.remove("d-none");
}

getClassesAndSubClasses();

accordionClass = document.querySelector("#accordion-class");
accordionClass.addEventListener("click", (event) => {
    if (ajaxClass && event.target.nodeName == "INPUT") {
        classId = event.target.value;
        changeAvailableSubclasses();
    }
})
// END AJAX SUBCLASSES

// AJAX SUBRACES
const racesField = document.querySelector("#builder_idRaces");
const subracesField = document.querySelector("#builder_idSubRace");

let racesId;
let ajaxRaces;

async function getRacesAndSubRaces() {
    const request = await fetch(`${window.location.origin}/builder/info/races`);
    ajaxRaces = await request.json();

    let subraceId = 0;
    for (const formCheck of racesField.children) {
        for (const input of formCheck.children) {
            if (input.getAttribute("checked") == "checked") {
                racesId = input.value;
            }
        }
    }

    changeAvailableSubraces(subraceId);
}

function changeAvailableSubraces(dbsubrace = 0) {
    if (!racesId) {
        document.querySelector("#subraces-accordion").classList.add("d-none");
        subracesField.innerHTML = `
        <div class="form-check">
            <input type="radio" id="builder_idSubRace_placeholder" name="builder[idSubRace]" class="form-check-input" value checked="checked">
            <label class="form-check-label" for="builder_idSubRace_placeholder">Choose a subrace</label>
        </div>
        `;
        return;
    }

    html = "";
    ajaxRaces.forEach(gameRaces => {
        if (gameRaces.id == racesId) {
            let first = true;
            gameRaces.subraces.forEach(subRaces => {
                if (dbsubrace) {
                    if (subRaces.id == dbsubrace) {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubRace_${subRaces.id}" name="builder[idSubRace]" class="form-check-input" value="${subRaces.id}" checked>
                            <label class="form-check-label" for="builder_idSubRace_${subRaces.id}">${subRaces.name}</label>
                        </div>
                        `;
                    } else {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubRace_${subRaces.id}" name="builder[idSubRace]" class="form-check-input" value="${subRaces.id}">
                            <label class="form-check-label" for="builder_idSubRace_${subRaces.id}">${subRaces.name}</label>
                        </div>
                        `;
                    }
                } else {
                    if (first) {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubRace_${subRaces.id}" name="builder[idSubRace]" class="form-check-input" value="${subRaces.id}" checked>
                            <label class="form-check-label" for="builder_idSubRace_${subRaces.id}">${subRaces.name}</label>
                        </div>
                        `;
                        first = false;
                    } else {
                        html +=  `
                        <div class="form-check">
                            <input type="radio" id="builder_idSubRace_${subRaces.id}" name="builder[idSubRace]" class="form-check-input" value="${subRaces.id}">
                            <label class="form-check-label" for="builder_idSubRace_${subRaces.id}">${subRaces.name}</label>
                        </div>
                        `;
                    }
                }
            })
        }
    });
    subracesField.innerHTML = html;
    document.querySelector("#subraces-accordion").classList.remove("d-none");
}

getRacesAndSubRaces();

accordionRaces = document.querySelector("#accordion-races");
accordionRaces.addEventListener("click", (event) => {
    if (ajaxRaces && event.target.nodeName == "INPUT") {
        racesId = event.target.value;
        changeAvailableSubraces();
    }
})