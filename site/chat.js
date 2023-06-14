var windowD = null;
window.chat;
if (!window.chat) {
    window.chat = "dev_chat";
}
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
document.addEventListener("DOMContentLoaded", function () {



    intervalUpdateMessages = setInterval(function () {
        UpdateMessages(lastLoadedX, window.chat);
    }, 1000);

    let intervalUpdateOtherInfo = setInterval(function () {
        UpdateMembers(window.chat);
        UpdateNotifications();
    }, 2000);



    $(document).on("click", function (e) {
        let object = $(e.target);
        if (object.closest("#chats .list-item img, #chats .list-item p").length) {
            ChangeChat(object.parent().attr("data-id"));
        } else if (object.closest("#chats .list-item").length && !object.closest("#chats .list-item button").length) {
            // console.log(e.getAttribute("data-id"));
            ChangeChat(object.attr("data-id"));
        }
    });

    // change chat
    function ChangeChat(nextChat) {
        console.log("hey " + nextChat);
        window.chat = nextChat;
        $(".list .list-item").removeClass("selected");
        $("div[data-id='" + nextChat + "']").addClass("selected");
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
                    // console.log("added member");
                    const userProfile = document.createElement("div");
                    userProfile.setAttribute("class", "list-item");
                    userProfile.setAttribute("data-id", element.id);
                    userProfile.classList.add("showProfile");
                    const pfpProfile = userProfile.appendChild(document.createElement("img"));
                    pfpProfile.setAttribute("src", element.pfp);
                    const profileUsername = userProfile.appendChild(document.createElement("p"));
                    profileUsername.innerHTML = element.username;
                    const profileButton = userProfile.appendChild(document.createElement("button"));
                    profileButton.setAttribute("class", "material-symbols-outlined showProfile");
                    profileButton.setAttribute("data-id", element.id);
                    profileButton.innerHTML = "more_horiz";

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
    function sendFriendRequest(userid) {
        let queryString = 'action=friendRequest' + '&userid=' + userid;
        // console.log(queryString);
        $.ajax({
            url: "dbquery.php",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {

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
                /*  const currentchat = document.getElementById("currentchat");
                  response.forEach(element => {
                      // console.log(element);
                      // console.log(element.user);
      
                      const message = document.createElement("div");
                      const pfp = message.appendChild(document.createElement("img")).setAttribute("src", element.pfp);
                      const user = message.appendChild(document.createElement("div"))
                      // user.attr('data-id','yoooos');
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
                  });*/
                const currentchat = $("#currentchat");
                response.forEach(element => {
                    const message = $("<div></div>");
                    message.attr('data-id', element.id);
                    const pfp = $("<img>").attr("src", element.pfp).appendTo(message);
                    pfp.addClass('showProfile');
                    const user = $("<div></div>").addClass("user").appendTo(message);
                    user.attr('data-id', element.user);
                    const name = $("<b></b>").html(element.username).appendTo(user);
                    name.attr("data-id", element.user);
                    name.addClass('showProfile');
                    const details = $("<time></time>").appendTo(user);
                    let now = new Date();
                    let date = new Date(element.sent);
                    details.html(date.toDateString() === now.toDateString() ?
                        `Today at ${date.toLocaleTimeString([], { timeStyle: 'short' })}` :
                        `${date.toLocaleDateString()} at ${date.toLocaleTimeString([], { timeStyle: 'short' })}`);

                    const tekst = $("<p></p>").text(element.message).appendTo(message);
                    message.addClass("message");
                    currentchat.append(message);
                    $("#currentchat").scrollTop($("#currentchat")[0].scrollHeight);

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
    const contextMenu = document.getElementById("context-menu");

    function FillContextMenu(e) {
        console.log(e);
        // console.log(e.getAttribute("data-id"));

        // let asd = data.attr("data-id");
    }

    window.addEventListener("contextmenu", e => {
        e.preventDefault();
        contextMenu.style.display = "none";
        let x = e.clientX,
            y = e.clientY,
            winWidth = window.innerWidth,
            winHeight = window.innerHeight,
            cmWidth = contextMenu.offsetWidth,
            cmHeight = contextMenu.offsetHeight;

        x = x > winWidth - cmWidth ? winWidth - cmWidth - 5 : x;
        y = y > winHeight - cmHeight ? winHeight - cmHeight - 5 : y;

        FillContextMenu(e);

        contextMenu.style.left = `${x}px`;
        contextMenu.style.top = `${y}px`;
        contextMenu.style.display = "grid";
    });

    function ContextMenu(e) {
        console.log('das');
        // e.preventDefault();
        contextMenu.style.display = "none";

        const buttonRect = e.target.getBoundingClientRect();
        const buttonWidth = buttonRect.width;

        let x = buttonRect.left + buttonWidth + 5;
        let y = buttonRect.top;

        const winWidth = window.innerWidth;
        const winHeight = window.innerHeight;
        const cmWidth = contextMenu.offsetWidth;
        const cmHeight = contextMenu.offsetHeight;

        x = x > winWidth - cmWidth ? buttonRect.left - cmWidth - 5 : x;
        y = y > winHeight - cmHeight ? winHeight - cmHeight - 5 : y;

        FillContextMenu(e);

        contextMenu.style.left = `${x}px`;
        contextMenu.style.top = `${y}px`;
        contextMenu.style.display = "grid";
    }


    $(document).on("click", function (event) {
        if (!$(event.target).closest(".list-item button").length) {
            contextMenu.style.display = "none";
        }
    });
    $(".list-item button").on("click", function (e) {
        ContextMenu(e);
    });



    $(document).on("click", function (e) {
        if (!$(e.target).closest(".showProfile, #user-profile").length) {
            $("#user-profile").removeClass("show");
        } else if (!$(e.target).closest("#chats .list-item button").length) {
            console.log(e.getAttribute("data-id"));
        } else if (!$(e.target).closest("#chats .list-item, #chats .list-item img, #chats .list-item p").length) {
            ChangeChat(e.getAttribute("data-id"));
        }
    });

    $(document).on("click", ".showProfile", function (e) {
        const buttonRect = $(this)[0].getBoundingClientRect();
        const buttonWidth = buttonRect.width;

        const x = buttonRect.left + buttonWidth + 5; // Adjust the value as needed
        const y = buttonRect.top;

        const popoverWidth = $("#user-profile").outerWidth();
        const popoverHeight = $("#user-profile").outerHeight();
        const screenWidth = $(window).width();
        const screenHeight = $(window).height();

        let newX = x;
        if (x + popoverWidth > screenWidth) {
            newX = x - popoverWidth - buttonWidth - 5;
        }

        let newY = y;
        if (y + popoverHeight > screenHeight) {
            newY = y - popoverHeight + buttonRect.height;
        }

        $("#user-profile").css({
            "left": `${newX}px`,
            "top": `${newY}px`
        });

        $("#user-profile").addClass("show");

        let userid = $(this).attr('data-id');
        let queryString = 'action=getProfileData' + '&userid=' + userid;

        $.ajax({
            url: "dbquery.php",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                $("#user-profile div h2").text(response.username);
                $("#user-profile div:nth-child(1) img").attr("src", response.pfp);
                if (response.status == "online") {
                    $("#user-profile div:nth-child(1) img").addClass("onlinePfp");
                } else if ($("#user-profile div:nth-child(1) img").hasClass("onlinePfp")) {
                    $("#user-profile div:nth-child(1) img").removeClass("onlinePfp");
                }

                $("#user-profile div:nth-child(3) p2").text(response.description);
                $("#user-profile div:nth-child(1) p").text("Created: " + response.created);


                let queryString2 = 'action=getFriendshipStatus' + '&userid=' + userid;
                $.ajax({
                    url: "dbquery.php",
                    data: queryString2,
                    type: "POST",
                    dataType: "json",
                    success: function (response2) {
                        if (response2.type == "request") {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", true);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Already sent friende request!");
                        } else if (response2.type == "friends") {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", true);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Already friends!");
                        } else if (response2.type == "block") {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Unblock");
                        } else {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'sendFriendRequest(' + '"' + response.id + '"' + ')');
                            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Send friend request");
                        }
                    },
                    error: function (error) {
                        console.log("post error");
                        console.log(error);
                    }
                });

            },
            error: function (error) {
                console.log("post error");
                console.log(error);
            }
        });

        queryString = 'action=getProfileAwardsData' + '&userid=' + userid;

        $.ajax({
            url: "dbquery.php",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                for (let index = 0; index < 5; index++) {
                    $("#user-profile div:nth-child(2) img:nth-child(" + index + ")").attr("src", "https://www.freepnglogos.com/uploads/circle-png/circle-outline-blank-png-icon-download-16.png");
                }
                let count = 1;
                response.forEach(element => {
                    $("#user-profile div:nth-child(2) img:nth-child(" + count + ")").attr("src", element.icon);
                    count++;
                });
            },
            error: function (error) {
                console.log("post error");
                console.log(error);
            }
        });
    });
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
                // console.log("added member");
                const userProfile = document.createElement("div");
                userProfile.setAttribute("class", "list-item");
                userProfile.setAttribute("data-id", element.id);
                userProfile.classList.add("showProfile");
                const pfpProfile = userProfile.appendChild(document.createElement("img"));
                pfpProfile.setAttribute("src", element.pfp);
                const profileUsername = userProfile.appendChild(document.createElement("p"));
                profileUsername.innerHTML = element.username;
                const profileButton = userProfile.appendChild(document.createElement("button"));
                profileButton.setAttribute("class", "material-symbols-outlined showProfile");
                profileButton.setAttribute("data-id", element.id);
                profileButton.innerHTML = "more_horiz";

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

function UpdateNotifications() {

    //friend Request notifications
    let queryStringFriendRequests = 'action=UpdateNotifications';
    $.ajax({
        url: "dbquery.php",
        data: queryStringFriendRequests,
        type: "POST",
        dataType: "json",
        success: function (response) {
            const friendTab = document.getElementById("tabFriend");
            friendTab.innerHTML = '';
            const listFriends = document.createElement("div");
            listFriends.setAttribute("class", "list");
            friendTab.appendChild(listFriends);
            if ($.trim(response) == '') {
                const emptyFriends = document.createElement("p");
                emptyFriends.innerHTML = "No friend requests";
                listFriends.appendChild(emptyFriends);
            }

            response.forEach(element => {
                const friendRequest = document.createElement("div");
                friendRequest.setAttribute("class", "list-item");
                friendRequest.setAttribute("data-id", element.id);

                const pfpRequest = friendRequest.appendChild(document.createElement("img"));
                pfpRequest.setAttribute("src", element.pfp);
                const friendRequestName = friendRequest.appendChild(document.createElement("p"));
                friendRequestName.innerHTML = element.username;
                const profileButton = friendRequest.appendChild(document.createElement("button"));
                profileButton.setAttribute("class", "material-symbols-outlined");
                profileButton.setAttribute("data-id", element.id);
                profileButton.innerHTML = "more_horiz";

                profileButton.innerHTML = "more_horiz"

                listFriends.appendChild(friendRequest);
            });
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}

function sendFriendRequest(userid) {
    let queryString = 'action=friendRequest' + '&userid=' + userid;

    $.ajax({
        url: "dbquery.php",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {

        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });

    $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", true);
    $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
    $("#user-profile div:nth-child(4) button:nth-child(1)").text("Already sent friende request!");
}
function UpdateMessages(lastLoaded, chat_id) {
    if (chat_id) {
        chat_id = "dev_chat";
    }
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
            /*  const currentchat = document.getElementById("currentchat");
              response.forEach(element => {
                  // console.log(element);
                  // console.log(element.user);
  
                  const message = document.createElement("div");
                  const pfp = message.appendChild(document.createElement("img")).setAttribute("src", element.pfp);
                  const user = message.appendChild(document.createElement("div"))
                  // user.attr('data-id','yoooos');
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
              });*/
            const currentchat = $("#currentchat");
            response.forEach(element => {
                const message = $("<div></div>");
                message.attr('data-id', element.id);
                const pfp = $("<img>").attr("src", element.pfp).appendTo(message);
                pfp.addClass('showProfile');
                const user = $("<div></div>").addClass("user").appendTo(message);
                user.attr('data-id', element.user);
                const name = $("<b></b>").html(element.username).appendTo(user);
                name.attr("data-id", element.user);
                name.addClass('showProfile');
                const details = $("<time></time>").appendTo(user);
                let now = new Date();
                let date = new Date(element.sent);
                details.html(date.toDateString() === now.toDateString() ?
                    `Today at ${date.toLocaleTimeString([], { timeStyle: 'short' })}` :
                    `${date.toLocaleDateString()} at ${date.toLocaleTimeString([], { timeStyle: 'short' })}`);

                const tekst = $("<p></p>").text(element.message).appendTo(message);
                message.addClass("message");
                currentchat.append(message);
                $("#currentchat").scrollTop($("#currentchat")[0].scrollHeight);

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
