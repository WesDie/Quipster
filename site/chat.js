var window = null;
const mqSmall = window.matchMedia('(max-width: 800px)');
const mqMedium = window.matchMedia('(min-width: 800px) and (max-width: 1200px)');
const mqLarge = window.matchMedia('(min-width: 1200px)');
let leftOpen = true, rightOpen = true, left = "auto", right = "auto";

mqSmall.addEventListener('change', function (e) {
    if (e.matches) {
        window = "small"; console.log('small');
        document.getElementsByTagName("body")[0].style.gridTemplateColumns = 0 + " 1fr " + 0;

        document.getElementById("toggleLeft").innerHTML = "chevron_right";
        left = 0;
        leftOpen = false;

        document.getElementById("toggleRight").innerHTML = "chevron_left";
        right = 0;
        rightOpen = false;

        document.getElementById("left").setAttribute("inert", "");
        document.getElementById("right").setAttribute("inert", "");
    }
});
mqMedium.addEventListener('change', function (e) {
    if (e.matches) {
        window = "medium"; console.log('medium');
        document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + 0;

        document.getElementById("toggleLeft").innerHTML = "chevron_left";
        left = "auto";
        leftOpen = true;

        document.getElementById("toggleRight").innerHTML = "chevron_left";
        right = 0;
        rightOpen = false;

        document.getElementById("left").removeAttribute("inert", "");
        document.getElementById("right").setAttribute("inert", "");
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
function Toggle(side) {
    if (side) {
        if (leftOpen) {
            document.getElementById("toggleLeft").innerHTML = "chevron_right";
            left = 0;
            leftOpen = false;
        } else {
            if (window == "large") {
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
            } else {
                console.log("yes");
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
            if (window == "large") {
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




function ChangeChat() {

}


function ChangeSettingTab() {

}

var settingsOpen = false;
function SettingsToggle() {
    if (settingsOpen) {
        document.getElementById("middle").removeAttribute("inert", "");
        document.getElementById("right").removeAttribute("inert", "");

        document.getElementById("settings").style.display = "none";
        document.getElementById("settings").setAttribute("inert", "");
        settingsOpen = false;
    } else {
        document.getElementById("middle").setAttribute("inert", "");
        document.getElementById("right").setAttribute("inert", "");

        document.getElementById("settings").style.display = "grid";
        document.getElementById("settings").removeAttribute("inert", "");
        settingsOpen = true;
    }
}



//  loading screen
window.onload = function () {
    setTimeout(function () {
        document.getElementById("fadein").remove();
    }, 1000);
};
$(window).on('load', function () {
    $("#loader-wrapper").fadeOut(700);
});





/*

const contextMenu = document.getElementById("cmenu");
console.log(contextMenu)

window.addEventListener("contextmenu", e => {
    e.preventDefault();
    let x = e.offsetX, y = e.offsetY,
        winWidth = window.innerWidth,
        winHeight = window.innerHeight,
        cmWidth = contextMenu.offsetWidth,
        cmHeight = contextMenu.offsetHeight;

    x = x > winWidth - cmWidth ? winWidth - cmWidth - 5 : x;
    y = y > winHeight - cmHeight ? winHeight - cmHeight - 5 : y;

    contextMenu.style.left = `${x}px`;
    contextMenu.style.top = `${y}px`;
    contextMenu.style.visibility = "visible";
});

document.addEventListener("click", () => contextMenu.style.visibility = "hidden");*/









let arrayLastMessages = new array();

// update messages in current chat:
function cartAction(action, chat_id) {
    var queryString = 'action=' + action + '&id=' + chat_id;
    console.log(queryString);
    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            console.log(response);
            
            
            /*
            $("#cart-list").html(response);
            $.ajax({
                url: "ajax_cart_data.php",
                data: "extra=true",
                type: "POST",
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    var table = document.getElementById("cart-list");
                    if (response.cartCounter == 0) {
                        table.innerHTML = "Nog geen smaken gekozen.";
                        document.getElementById("cartCounter").innerHTML = "0";
                        document.getElementById("cartCounter").style.display = "none";
                    } else {
                        document.getElementById("cartCounter").style.display = "inline-block";
                        document.getElementById("cartCounter").innerHTML = response.cartCounter + " L";
                    }
                },
                error: function (error) {
                    document.getElementById("cartCounter").style.display = "inline-block";
                    document.getElementById("cartCounter").innerHTML = "-";
                }
            });*/
        },
        error: function (error) {
            console.log(error);
        }
    });

}



// reload everything else:
