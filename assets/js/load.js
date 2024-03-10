
function loadScript() {
    var script = document.createElement('script');
    script.src = "modal.js";
    document.body.appendChild(script);
}
window.onload = loadScript; // Charge le script lorsque le corps de la page est entièrement chargé
