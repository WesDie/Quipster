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
    windowD = "small";
    // console.log('small');
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
    windowD = "medium";
    // console.log('medium');

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
    windowD = "large";
    // console.log('large');

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
            // console.log(windowD);
            if (windowD === "large") {
                document.getElementById("toggleLeft").innerHTML = "chevron_left";
                left = "auto";
                leftOpen = true;
                document.getElementById("left").removeAttribute("inert", "");
            } else {
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
            // console.log(windowD);
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
    window.location.href = 'chat?logout=1';
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

let pins = true;
function PinsToggle() {
    let text = $(".top p").text();
    if (pins) {
        pins = false

        let queryString = 'action=chatLoadPinned' + '&chat_id=' + window.chat;
        $.ajax({
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                const currentchat = $("#pinnedmsgs");
                currentchat.text("");
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
                    $("#pinnedmsgs").scrollTop($("#pinnedmsgs")[0].scrollHeight);

                    lastLoadedX = element.sent;
                });
            },
            error: function (error) {
                console.log("update error");
                console.log(error);
            }
        });

        $("#pinstoggle").addClass("selected");
        $("#currentchat").addClass("close");
        $("#pinnedmsgs").removeClass("close");
        $(".top p").text(text + " (Pinned Messages)");
        $("chats").removeAttr("inert", "");
        $("right").attr("inert", "");
    } else {
        pins = true;
        $("#pinstoggle").removeClass("selected");
        $("#currentchat").removeClass("close");
        $("#pinnedmsgs").addClass("close");
        $(".top p").text(text.replace(" (Pinned Messages)", ""));
        $("chats").attr("inert", "");
        $("right").removeAttr("inert", "");
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
        url: "dbquery",
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
let loadedMsgs = new Array();

document.addEventListener("DOMContentLoaded", function () {
    // UpdateMembers(window.chat);
    // UpdateNotifications();
    // UpdateChats();
    intervalUpdateMessages = setInterval(function () {
        UpdateMessages(lastLoadedX, window.chat);
    }, 1000);

    let intervalUpdateOtherInfo = setInterval(function () {
        UpdateMembers(window.chat);
        UpdateNotifications();
        UpdateChats();
    }, 10000);



    $(document).on("click", function (e) {
        let object = $(e.target);
        if (object.closest("#chats .list-item img, #chats .list-item p").length) {
            ChangeChat(object.parent().attr("data-id"));
        } else if (object.closest("#chats .list-item").length && !object.closest("#chats .list-item button").length) {
            // console.log(e.getAttribute("data-id"));
            ChangeChat(object.attr("data-id"));
        } else if (object.closest("#chats .list-item button").length) {
            //
        }
    });

    // change chat
    function ChangeChat(nextChat) {
        // console.log("hey " + nextChat);
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
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                // console.log("post success");
                // console.log(response);
                document.querySelector("#newMessage input").value = "";
                UpdateMessages(lastLoadedX, chat_id);
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
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                document.getElementById("memberList").innerHTML = '';
                //succes
                if (response.isPrivate == "Yes") {
                    $("#inviteMembersBtn").css("display", "none");
                    $("#memberList-uppertext").text("Private chat");
                    const privatChatInfoContainer = document.createElement("div");
                    privatChatInfoContainer.setAttribute("class", "privateChatInfoContainer");

                    document.getElementById("memberList").appendChild(privatChatInfoContainer);

                    const pfpProfileBg = privatChatInfoContainer.appendChild(document.createElement("div"));
                    const pfpProfile = pfpProfileBg.appendChild(document.createElement("img"));
                    pfpProfile.setAttribute("src", response[0].pfp);
                    if (response.status == "online") {
                        pfpProfile.setAttribute("class", "onlinePfp");
                    }

                    const username = document.createElement("h1");
                    username.innerHTML = response[0].username;
                    privatChatInfoContainer.appendChild(username);

                } else {
                    $("#inviteMembersBtn").css("display", "block");
                    $("#memberList-uppertext").text("Members - " + response.length);
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
                        profileButton.setAttribute("class", "google-icon showProfile");
                        profileButton.setAttribute("data-id", element.id);
                        profileButton.innerHTML = "more_horiz";

                        // profileButton.innerHTML = "more_horiz"

                        document.getElementById("memberList").appendChild(userProfile);

                        if (element.status == "online") {
                            pfpProfile.setAttribute("class", "onlinePfp");
                        }
                    });
                }
            },
            error: function (error) {
                console.log("post error");
                console.log(error);
            }
        });
    }

    //  loading screen
    window.onload = function () {
        setTimeout(function () {
            document.getElementById("fadein").remove();
        }, 1000);

        UpdateMembers(window.chat);
        UpdateNotifications();
        UpdateChats();
    };

    function UpdateMessages(lastLoaded, chat_id) {
        let queryString = 'action=chatLoad' + '&chat_id=' + chat_id + '&lastLoaded=' + lastLoaded;
        // console.log(queryString);
        $.ajax({
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
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
                    if ($.inArray(element.id, loadedMsgs) !== -1) {
                        message.remove();
                        console.log("remove");
                    } else {
                        currentchat.append(message);
                    }
                    loadedMsgs.push(element.id);

                    $("#currentchat").scrollTop($("#currentchat")[0].scrollHeight);

                    lastLoadedX = element.sent;

                });
            },
            error: function (error) {
                console.log("update error");
                console.log(error);
            }
        });
    }


    const contextMenu = document.getElementById("context-menu");

    function FillContextMenu(e) {
        let object = $(e.target);
        let what = "";
        if (object.hasClass("chat")) {
            what = "chat";
        } else if (object.parent().hasClass("chat")) {
            what = "chat";
        } else if (object.hasClass("message")) {
            what = "message";
        } else if (object.parent().hasClass("message")) {
            what = "message";
        } else if (object.parent().parent().hasClass("message")) {
            what = "message";
        } else if (object.parent().hasClass("showProfile")) {
            what = "user";
        }
        let id = object.parent().attr("data-id");
        if (id == null) {
            id = object.attr("data-id");
        }
        console.log(id);

        let possibilities = {
            "chat": {
                "Leave": "LeaveChat",
                "Mute": "MuteChat",
                "Favourite": "FavouriteChat",
                "Invite": "InviteToChat"
            },
            "chat-owner": {
                "Edit": "EditChat",
                "Delete": "DeleteChat",
            },
            "chat-induvidual": {
                "Unfriend": "Unfriend",
                "Block": "Block",
            },
            "message": {
                "Emoji": "EmojiMessage",
                "Reply": "ReplyMessage",
                "Pin": "PinMessage",
            },
            "message-owner": {
                "Delete": "DeleteMessage"
            },
            "message-chat-owner": {
                "Delete": "DeleteMessage",
                "Pin": "PinMessage",
            },
            "user": {
                "Friend": "SendFriendRequest",
                "Block": "BlockUser",
                "Message": "MessageUser",
            },
            "user-chat-owner": {
                "Kick": "KickUser",
                "Ban": "BanUser",
            },
        }

        // for (let catagory in possibilities) {
        //     console.log("Catagory:", catagory);

        //     for (let name in possibilities[catagory]) {
        //         console.log("Visible name:", name);
        //         console.log("Function name:", possibilities[catagory][name]);
        //     }
        // }

        contextMenu.innerHTML = "";
        contextMenu.style.display

        for (let name in possibilities[what]) {
            let button = document.createElement("button");
            button.innerHTML = name;
            button.setAttribute("data-function", possibilities[what][name]);
            button.setAttribute("data-id", id);
            // button.setAttribute("onclick", possibilities[what][name] + "(" + id + ")");
            contextMenu.appendChild(button);
        }

        if (what) contextMenu.style.display = "grid"; else contextMenu.style.display = "none";
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
    });

    function ContextMenu(e) {
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
    }

    // $("#context-menu button").on("click", function (e) {
    //     console.log($(e.target).attr("data-function"));
    //     PinMessage($(e.target).attr("data-function"));
    // });

    $("#context-menu").on("click", "button", function (e) {
        var dataFunction = $(this).attr("data-function");
        var dataId = $(this).attr("data-id");
        // console.log(dataFunction);
        // if ($(this).attr("data-function")) {

        // }
        PinMessage(dataId);
    });

    $(document).on("click", function (event) {
        if (!$(event.target).closest(".list-item button").length) {
            contextMenu.style.display = "none";
        }
    });
    $("#chats .list-item button").on("click", function (e) {
        ContextMenu(e, "chats");
    });



    $(document).on("click", function (e) {
        if (!$(e.target).closest(".showProfile, #user-profile").length) {
            $("#user-profile").removeClass("show");
        }
    });

    $("#chats").on("click", function (e) {
        if (!$(e.target).closest("#chats .list-item button").length) {
            console.log(e.getAttribute("data-id"));
        } else if (!$(e.target).closest("#chats .list-item, #chats .list-item img, #chats .list-item p").length) {
            ChangeChat(e.getAttribute("data-id"));
        }
    });

    function PinMessage(message) {
        let queryString = 'action=chatPinMessage' + '&chat_id=' + window.chat + "&message=" + message;
        $.ajax({
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                console.log("success?");
            },
            error: function (error) {
                console.log("post error");
                console.log(error);
            }
        });
    }

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
            url: "dbquery",
            data: queryString,
            type: "POST",
            dataType: "json",
            success: function (response) {
                $("#user-profile").attr('data-id', response.id);

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
                    url: "dbquery",
                    data: queryString2,
                    type: "POST",
                    dataType: "json",
                    success: function (response2) {
                        if (response2.isYou == "Yes") {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", true);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
                            $("#user-profile div:nth-child(4) button:nth-child(1)").text("(-X-)");
                            $("#user-profile div:nth-child(4) button:nth-child(1)").addClass("hide");
                        } else {
                            $("#user-profile div:nth-child(4) button:nth-child(1)").removeClass("hide");
                            if (response2.type == "request") {
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'cancelFriendRequest(' + '"' + response.id + '"' + ')');
                                $("#user-profile div:nth-child(4) button:nth-child(1)").text("Cancel friend request");
                            } else if (response2.type == "friends") {
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'ChangeChat(' + '"' + response.id + '"' + ')');
                                $("#user-profile div:nth-child(4) button:nth-child(1)").text("Chat with friend (doesnt work)");
                            } else if (response2.type == "block") {
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', false);
                                $("#user-profile div:nth-child(4) button:nth-child(1)").text("Unblock");
                            } else {
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
                                $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'sendFriendRequest(' + '"' + response.id + '"' + ')');
                                $("#user-profile div:nth-child(4) button:nth-child(1)").text("Send friend request");
                            }
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
            url: "dbquery",
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



function UpdateNotifications() {

    //friend Request notifications
    let queryStringFriendRequests = 'action=UpdateFriendRequest';
    $.ajax({
        url: "dbquery",
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
                emptyFriends.setAttribute("class", "emptyListItem");
                emptyFriends.innerHTML = "No friend requests";
                listFriends.appendChild(emptyFriends);
            }

            response.forEach(element => {
                const friendRequest = document.createElement("div");
                friendRequest.setAttribute("class", "list-item notifications");
                friendRequest.setAttribute("data-id", element.id);

                const pfpRequest = friendRequest.appendChild(document.createElement("img"));
                pfpRequest.setAttribute("src", element.pfp);
                const friendRequestName = friendRequest.appendChild(document.createElement("p"));
                friendRequestName.innerHTML = element.username;
                const acceptButton = friendRequest.appendChild(document.createElement("button"));
                acceptButton.setAttribute("class", "google-icon acceptButton");
                acceptButton.setAttribute("onclick", 'acceptFriendRequest(' + '"' + element.id + '"' + ')');
                acceptButton.innerHTML = "done";

                const declineButton = friendRequest.appendChild(document.createElement("button"));
                declineButton.setAttribute("class", "google-icon declineButton");
                declineButton.setAttribute("onclick", 'declineFriendRequest(' + '"' + element.id + '"' + ')');
                declineButton.innerHTML = "close";

                listFriends.appendChild(friendRequest);
            });

            const friendNotificationDevider = document.createElement("div");
            friendNotificationDevider.setAttribute("class", "friendRequestDivider");
            listFriends.appendChild(friendNotificationDevider);

            let queryStringSentFriendRequests = 'action=UpdateSentFriendRequest';
            $.ajax({
                url: "dbquery",
                data: queryStringSentFriendRequests,
                type: "POST",
                dataType: "json",
                success: function (response2) {
                    response2.forEach(element => {
                        const friendRequest = document.createElement("div");
                        friendRequest.setAttribute("class", "list-item notifications");
                        friendRequest.setAttribute("data-id", element.id);

                        const pfpRequest = friendRequest.appendChild(document.createElement("img"));
                        pfpRequest.setAttribute("src", element.pfp);
                        const friendRequestName = friendRequest.appendChild(document.createElement("p"));
                        friendRequestName.innerHTML = element.username;

                        const declineButton = friendRequest.appendChild(document.createElement("button"));
                        declineButton.setAttribute("class", "google-icon declineButton");
                        declineButton.setAttribute("onclick", 'cancelFriendRequest(' + '"' + element.id + '"' + ')');
                        declineButton.innerHTML = "close";

                        listFriends.appendChild(friendRequest);
                    });
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
}
function UpdateChats() {
    let queryString = 'action=uiLoadChats';

    $.ajax({
        url: "dbquery",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            const mainListChats = document.getElementById("chats")
            mainListChats.innerHTML = '';
            const listChats = document.createElement("div");
            listChats.setAttribute("class", "list");
            mainListChats.appendChild(listChats);

            response.forEach(element => {
                if (element.type == "duo") {

                    const chatItem = document.createElement("div");
                    chatItem.setAttribute("data-id", element.id);
                    chatItem.setAttribute("class", "chat list-item privateChat");
                    if (element.id == window.chat) {
                        chatItem.classList.add("selected");
                    }
                    listChats.appendChild(chatItem);

                    let queryStringPrivateChat = 'action=GetPrivateChatInfo' + '&chatid=' + element.id;

                    $.ajax({
                        url: "dbquery",
                        data: queryStringPrivateChat,
                        type: "POST",
                        dataType: "json",
                        success: function (response2) {
                            const chatImg = document.createElement("img");
                            chatImg.setAttribute("src", response2.pfp);
                            chatImg.classList.add("onlinePfp");
                            chatItem.appendChild(chatImg);

                            if (response2.status == "online") {
                                chatImg.classList.add("onlinePfp");
                            } else {
                                chatImg.classList.remove("onlinePfp");
                            }

                            const chatName = document.createElement("p");
                            chatName.innerHTML = "(P) " + response2.username;
                            chatItem.appendChild(chatName);

                            const chatBtn = document.createElement("button");
                            chatBtn.setAttribute("class", "google-icon");
                            chatBtn.innerHTML = "more_horiz";
                            chatItem.appendChild(chatBtn);
                        },
                        error: function (error) {
                            console.log("post error");
                            console.log(error);
                        }
                    });

                } else if (element.type == "group") {

                    const chatItem = document.createElement("div");
                    chatItem.setAttribute("data-id", element.id);
                    chatItem.setAttribute("class", "chat list-item");
                    if (element.id == window.chat) {
                        chatItem.classList.add("selected");
                    }
                    listChats.appendChild(chatItem);

                    const chatImg = document.createElement("img");
                    chatImg.setAttribute("src", element.icon);
                    chatItem.appendChild(chatImg);

                    const chatName = document.createElement("p");
                    chatName.innerHTML = element.name;
                    chatItem.appendChild(chatName);

                    const chatBtn = document.createElement("button");
                    chatBtn.setAttribute("class", "google-icon");
                    chatBtn.innerHTML = "more_horiz";
                    chatItem.appendChild(chatBtn);
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

    $.ajax({
        url: "dbquery",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            UpdateNotifications();
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
            UpdateNotifications();
        }
    });

    $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
    $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'cancelFriendRequest(' + '"' + $("#user-profile").attr('data-id') + '"' + ')');
    $("#user-profile div:nth-child(4) button:nth-child(1)").text("Cancel friend request");
}
function acceptFriendRequest(userid) {
    let queryString = 'action=acceptFriendRequest' + '&userid=' + userid;

    $.ajax({
        url: "dbquery",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            UpdateNotifications();
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}
function declineFriendRequest(userid) {
    let queryString = 'action=declineFriendRequest' + '&userid=' + userid;

    $.ajax({
        url: "dbquery",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            UpdateNotifications();

            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'sendFriendRequest(' + '"' + $("#user-profile").attr('data-id') + '"' + ')');
            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Send friend request");
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}
function cancelFriendRequest(userid) {
    let queryString = 'action=cancelFriendRequest' + '&userid=' + userid;

    $.ajax({
        url: "dbquery",
        data: queryString,
        type: "POST",
        dataType: "json",
        success: function (response) {
            UpdateNotifications();

            $("#user-profile div:nth-child(4) button:nth-child(1)").attr("disabled", false);
            $("#user-profile div:nth-child(4) button:nth-child(1)").attr('onclick', 'sendFriendRequest(' + '"' + $("#user-profile").attr('data-id') + '"' + ')');
            $("#user-profile div:nth-child(4) button:nth-child(1)").text("Send friend request");
        },
        error: function (error) {
            console.log("post error");
            console.log(error);
        }
    });
}



$(window).on('load', function () {
    // $("#loader-wrapper").fadeOut(700);

    // if (window.innerWidth <= 800) {
    //   console.log("hier a");
    //   Small();
    // } else if (window.outerWidth >= 1800) {
    //   console.log("hier c");
    //   Large();
    // } else if (window.innerWidth >= 800 && window.innerWidth <= 1800) {
    //   console.log("hier b");
    //   Medium();
    // } else {
    //   console.log("welp");
    // }

    // when page first opened, check windows width:
    if (window.innerWidth <= 800) {
        Small();
    } else if (window.outerWidth >= 1200) {
        Large();
    } else if (window.innerWidth >= 800 && window.innerWidth <= 1200) {
        Medium();
        console.log("dsad");
    } else {
        console.log("welp");
    }

    // same as above but everytime:
    mqSmall.addEventListener('change', function (e) {
        if (e.matches) {
            Small();
        }
    });
    mqMedium.addEventListener('change', function (e) {
        if (e.matches) {
            Medium();
            console.log("dsa")
        }
    });
    mqLarge.addEventListener('change', function (e) {
        if (e.matches) {
            Large();
        }
    });
});

  // let intervalUpdateMessages = setInterval(function() {
  //   UpdateMessages(lastLoadedX, window.chat);
  // }, 1000);