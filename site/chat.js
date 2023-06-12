var windowD = null;
window.chat;
const mqSmall = window.matchMedia('(max-width: 800px)');
const mqMedium = window.matchMedia('(min-width: 800px) and (max-width: 1200px)');
const mqLarge = window.matchMedia('(min-width: 1200px)');
let leftOpen = true, rightOpen = false, left = "0", right = "0";


function Small() {
    windowD = "small"; console.log('small');
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
    windowD = "medium"; console.log('medium');

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
    windowD = "large"; console.log('large');

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
            document.getElementById("left").setAttribute("inert", "");
        } else {
            console.log(windowD);
            if (windowD === "large") {
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
                document.getElementById("left").removeAttribute("inert", "");
            } else {
                console.log("yes");
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
                document.getElementById("toggleRight").innerHTML = "chevron_left";
                right = 0;
                rightOpen = false;
                document.getElementById("left").removeAttribute("inert", "");
                document.getElementById("right").setAttribute("inert", "");
            }
        }
    } else {
        if (rightOpen) {
            document.getElementById("toggleRight").innerHTML = "chevron_left";
            right = 0;
            rightOpen = false;
            document.getElementById("right").setAttribute("inert", "");
        } else {
            console.log(windowD);
            if (windowD === "large") {
                document.getElementById("toggleRight").innerHTML = "chevron_right";
                right = "auto";
                rightOpen = true;
                document.getElementById("right").removeAttribute("inert", "");
            } else {
                document.getElementById("toggleRight").innerHTML = "chevron_right";
                right = "auto";
                rightOpen = true;
                document.getElementById("toggleLeft").innerHTML = "chevron_right";
                left = 0;
                leftOpen = false;
                document.getElementById("left").setAttribute("inert", "");
                document.getElementById("right").removeAttribute("inert", "");
            }
        }
    }
    document.getElementsByTagName("body")[0].style.gridTemplateColumns = left + " 1fr " + right;
}

function InviteMembers() {
    const inviteMembersBox = document.getElementById('InviteMembersBox');
    inviteMembersBox.showModal();
}
function CreateChatModal() {
    const createChatBox = document.getElementById('CreateChatBox');
    createChatBox.showModal();
}
function ChangePasswordBoxModal() {
    const changePasswordBox = document.getElementById('changePasswordBox');
    changePasswordBox.showModal();
}

function logout() {
    window.location.href = 'chat.php?logout=1';
}


let requests;
function LeftTabsToggle() {
    if (requests) {
        requests = false
        $("#requestToggle").removeClass("selected");
        $("#chats").addClass("open");
        $("#requests").removeClass("open");
        $("chats").removeAttr("inert", "");
        $("right").attr("inert", "");
    } else {
        requests = true;
        $("#requestToggle").addClass("selected");
        $("#chats").removeClass("open");
        $("#requests").addClass("open");
        $("chats").attr("inert", "");
        $("right").removeAttr("inert", "");
    }
}
function LeftChildToggle(side) {
    if (side) {
        $("#switchSides:nth-child(0)").addClass("selected");
        $("#switchSides:nth-child(1)").removeClass("selected");
        $("#tabFriend").addClass("open");
        $("#tabChat").removeClass("open");
        $("#tabFriend").removeAttr("inert", "");
        $("#tabChat").attr("inert", "");
    } else {
        $("#switchSides:nth-child(0)").removeClass("selected");
        $("#switchSides:nth-child(1)").addClass("selected");
        $("#tabFriend").removeClass("open");
        $("#tabChat").addClass("open");
        $("#tabFriend").attr("inert", "");
        $("#tabChat").removeAttr("inert", "");
    }
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

//Toggle settings tab
function SettingsTabToggle(tabName) {
    $("#catagories button").removeClass("selected");
    $("#settingTabContainer div").removeClass("showSettingsTab");
    document.getElementById(tabName).classList.add("showSettingsTab");
    $("button[onclick=\"SettingsTabToggle('" + tabName + "')\"]").addClass("selected");
}

//check if users leaves page
$(window).on('beforeunload', function () {
    let queryString = 'new=true' + '&action=' + "goOffline";

    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            console.log("leaving chat");
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });

    // You can optionally provide a custom message to be displayed in the browser dialog
    return 'Are you sure you want to leave this page?';
});

// create chat
function CreateChat() {
    let queryString = 'new=true' + '&descCreateChat=' + $('#descCreateChat').val() + '&nameCreateChat=' + $('#nameCreateChat').val() + '&iconCreateChat=' + $('#iconCreateChat').val();
    $.ajax({
        url: "createchatquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            //succes
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}
let intervalUpdateMessages;
// load chat
$(window).on('load', function () {



    intervalUpdateMessages = setInterval(function () {
        UpdateMessages(lastLoadedX, window.chat);
    }, 1000);

    let intervalUpdateOtherInfo = setInterval(function () {
        UpdateMembers(window.chat);
    }, 2000);
});

// change chat
function ChangeChat(nextChat) {
    window.chat = nextChat;
    $(".list .list-item").removeClass("selected");
    $("div[onclick=\"ChangeChat('" + nextChat + "')\"]").addClass("selected");
    clearInterval(intervalUpdateMessages);
    $("#currentchat .message").remove();
    document.getElementById("memberList").innerHTML = '';
    UpdateMembers(window.chat);
    lastLoadedX = 0;
    intervalUpdateMessages = setInterval(function () {
        UpdateMessages(lastLoadedX, window.chat);
    }, 1000);
}

// send message
function SendMessage() {
    let input = document.querySelector("#newMessage input").value, chat_id = window.chat;

    let queryString = 'action=chatUpload' + '&chat_id=' + chat_id + '&input=' + input;
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
            UpdateMessages(lastLoadedX, chat_id)
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}
$(document).ready(function () {// when the dom is loaded
    // send message when enter released:
    $("#inpurt").on("keyup", function (event) {
        if (event.which === 13) {
            SendMessage();
        }
    });
});
// update messages in current chat:

// let loadedMsgs = new array();

var lastLoadedX = "1999";

// setInterval(function () {
//     UpdateMessages(lastLoadedX, "dev_chat");
// }, 1000);
function UpdateMembers(chat_id) {
    let queryString = 'action=updateMembers' + '&chat_id=' + chat_id;

    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            document.getElementById("memberList").innerHTML = '';
            //succes
            response.forEach(element => {
                console.log("added member");
                const userProfile = document.createElement("div");
                userProfile.setAttribute("class", "list-item");
                const pfpProfile = userProfile.appendChild(document.createElement("img"));
                pfpProfile.setAttribute("src", element.pfp);
                const profileUsername = userProfile.appendChild(document.createElement("p"));
                profileUsername.innerHTML = element.username;
                const profileButton = userProfile.appendChild(document.createElement("button"));
                profileButton.setAttribute("class", "material-symbols-outlined");
                // profileButton.innerHTML = "more_horiz"

                document.getElementById("memberList").appendChild(userProfile);

                if (element.status == "online") {
                    pfpProfile.setAttribute("class", "onlinePfp");
                }
            });
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}
function UpdateMessages(lastLoaded, chat_id) {
    let queryString = 'action=chatLoad' + '&chat_id=' + chat_id + '&lastLoaded=' + lastLoaded;
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
                tekst.textContent = element.message;

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
