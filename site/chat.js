var window = null;
const mqSmall = window.matchMedia('(max-width: 800px)');
const mqMedium = window.matchMedia('(min-width: 800px) and (max-width: 1200px)');
const mqLarge = window.matchMedia('(min-width: 1200px)');

mqSmall.addEventListener('change', function (e) {
    if (e.matches) {
        window = "small"; console.log('small');
        document.getElementsByTagName("body")[0].style.gridTemplateColumns = 0 + " 1fr " + 0;
    }
});
mqMedium.addEventListener('change', function (e) {
    if (e.matches) {
        window = "medium"; console.log('medium');
        document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + 0;
    }
});
mqLarge.addEventListener('change', function (e) {
    if (e.matches) {
        window = "large"; console.log('large');
        document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
    }
});


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
            if (window === "large") {
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
            } else {
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
                document.getElementById("toggleRight").innerHTML = "chevron_left";
                right = 0;
                rightOpen = false;
            }
        }
    } else {
        if (rightOpen) {
            document.getElementById("toggleRight").innerHTML = "chevron_left";
            right = 0;
            rightOpen = false;
        } else {
            if (window === "large") {
                document.getElementById("toggleRight").innerHTML = "chevron_right";
                right = "auto";
                rightOpen = true;
            } else {
                document.getElementById("toggleRight").innerHTML = "chevron_right";
                right = "auto";
                rightOpen = true;
                document.getElementById("toggleLeft").innerHTML = "chevron_right";
                left = 0;
                leftOpen = false;
            }
        }
    }
    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
}