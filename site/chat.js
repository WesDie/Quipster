var window = null;
const mqSmall = window.matchMedia('(max-width: 800px)');
const mqMedium = window.matchMedia('(min-width: 800px) and (max-width: 1800px)');
const mqLarge = window.matchMedia('(min-width: 1800px)');
let leftOpen = true, rightOpen = false, left = "0", right = "0";


function Small() {
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

    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + 0;
}
function Medium() {
    window = "medium"; console.log('medium');

    document.getElementById("toggleLeft").innerHTML = "chevron_left";
    left = "auto";
    leftOpen = true;

    document.getElementById("toggleRight").innerHTML = "chevron_left";
    right = 0;
    rightOpen = false;

    document.getElementById("left").removeAttribute("inert", "");
    document.getElementById("right").setAttribute("inert", "");

    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
}
function Large() {
    window = "large"; console.log('large');

    document.getElementById("toggleLeft").innerHTML = "chevron_left";
    left = "auto";
    leftOpen = true;

    document.getElementById("toggleRight").innerHTML = "chevron_right";
    right = "auto";
    rightOpen = true;

    document.getElementById("left").removeAttribute("inert", "");
    document.getElementById("right").removeAttribute("inert", "");

    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
}

// // when page first opened, check windows width:
// if (window.innerWidth <= 800) {
//     Small();
// } else if (window.innerWidth >= 800 && window.innerWidth <= 1800) {
//     Medium();
//     console.log("dsad");
// } else if (window.innerWidth >= 1800) {
//     Large();
// } else {
//     console.log("welp");
// }

// // same as above but everytime:
// mqSmall.addEventListener('change', function (e) {
//     if (e.matches) { Small(); }
// });
// mqMedium.addEventListener('change', function (e) {
//     if (e.matches) { Medium(); console.log("dsa")}
// });
// mqLarge.addEventListener('change', function (e) {
//     if (e.matches) { Large(); }
// });

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
// $(window).on('load', function () {
//     // $("#loader-wrapper").fadeOut(700);

//     if (window.innerWidth <= 800) {
//         console.log("hier a");
//         Small();
//     } else if (window.innerWidth >= 800 && window.innerWidth <= 1800) {
//         console.log("hier b");
//         Medium();
//     } else if (window.innerWidth >= 1800) {
//         console.log("hier c");
//         Large();
//     } else {
//         console.log("welp");
//     }
// });





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


// send message
function SendMessage() {
    let input = document.querySelector("#newMessage input").value, chat_id = 'dsad';

    let queryString = 'new=true' + '&chat_id=' + chat_id + '&input=' + input;
    // console.log(queryString);
    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            // console.log("post success");
            // console.log(response);
            document.querySelector("#newMessage input").value = "";
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}

// send message when enter released:
$("#inpurt").on("keyup", function (event) {
    console.log(event);
});
// document.querySelector("#newMessage input").bind('keyup', function (e) {
//     if (e.keyCode === 13) { // 13 is enter key
//         SendMessage();
//     }
// });

// update messages in current chat:

// let loadedMsgs = new array();

var lastLoadedX = "1999";

// setInterval(function () {
//     UpdateMessages(lastLoadedX, "dev_chat");
// }, 1000);

function UpdateMessages(lastLoaded, chat_id) {
    let queryString = 'new=' + 'false' + '&chat_id=' + chat_id + '&lastLoaded=' + lastLoaded;
    // console.log(queryString);
    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            // console.log("update success");
            // console.log(response);
            const currentchat = document.getElementById("currentchat");
            response.forEach(element => {
                // console.log(element);
                // console.log(element.user);

                const message = document.createElement("div");
                const pfp = message.appendChild(document.createElement("img")).setAttribute("src", element.pfp);
                const user = message.appendChild(document.createElement("div"))
                user.classList.add("user");
                user.appendChild(document.createElement("b")).innerHTML = element.username;
                const details = user.appendChild(document.createElement("time"));
                // details.classList.add("timestamp");

                let now = new Date();
                let date = new Date(element.sent);
                // now.toDateString();
                // return element.sent.toDateString() === now.toDateString()
                //     ? "today at ${date.toLocaleTimeString([], { timeStyle: 'short' })}"
                //     : "${date.toLocaleDateString()} at ${date.toLocaleTimeString([], { timeStyle: 'short' })}";

                details.innerHTML = date.toDateString() === now.toDateString() ?
                    `Today at ${date.toLocaleTimeString([], { timeStyle: 'short' })}`
                    : `${date.toLocaleDateString()} at ${date.toLocaleTimeString([], { timeStyle: 'short' })}`;


                const tekst = message.appendChild(document.createElement("p"))
                tekst.innerHTML = element.message;

                message.classList.add("message");
                currentchat.appendChild(message);
                var objDiv = document.getElementById("currentchat");
                objDiv.scrollTop = objDiv.scrollHeight;

                lastLoadedX = element.sent;
            });
        },
        error: function (error) {
            console.log("update error");
            console.log(error);
            // console.log(lastLoadedX);
        }
    });
}



// reload everything else:
