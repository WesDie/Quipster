// document.getElementById("toggleLeft").addEventListener("click", Toggle(0));
// document.getElementById("toggleRight").addEventListener("click", Toggle(1));
let leftOpen = true, rightOpen = true, left = "auto", right = "auto";
function Toggle(side) {
    if (side) {
        if (leftOpen) {
            document.getElementById("toggleLeft").innerHTML = "chevron_right";
            left = 0;
            leftOpen = false;
        } else {
            document.getElementById("toggleLeft").innerHTML = "chevron_left";
            left = "auto";
            leftOpen = true;
        }
    } else {
        if (rightOpen) {
            document.getElementById("toggleRight").innerHTML = "chevron_left";
            right = 0;
            rightOpen = false;
        } else {
            document.getElementById("toggleRight").innerHTML = "chevron_right";
            right = "auto";
            rightOpen = true;
        }
    }
    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
}


const mqSmall = window.matchMedia('(max-width: 800px)');
const mqMedium = window.matchMedia('(min-width: 800px)');
const mqLarge = window.matchMedia('(min-width: 1200px)');

mqSmall.addEventListener('change', function (e) {
    console.log(e.matches ? 'small' : 'not small');
});
mqMedium.addEventListener('change', function (e) {
    console.log(e.matches ? 'medium' : 'not medium');
});
mqLarge.addEventListener('change', function (e) {
    console.log(e.matches ? 'large' : 'not large');
});