"use strict";

const moreOptionsBtn = document.getElementById("showMoreOptions");
const labelMoreOptions = document.getElementById("labelMoreOptions");
const moreOptionsWindow = document.getElementById("moreOptionsWindow");

moreOptionsBtn.addEventListener("click", () => {
    labelMoreOptions.classList.add("showMeMoreOptions");
    moreOptionsWindow.classList.add("showMeMoreOptions");
    
    labelMoreOptions.classList.remove("showMeMoreOptionsOff");
    moreOptionsWindow.classList.remove("showMeMoreOptionsOff");
})

labelMoreOptions.addEventListener("click", () => {
    labelMoreOptions.classList.remove("showMeMoreOptions");
    moreOptionsWindow.classList.remove("showMeMoreOptions");

    labelMoreOptions.classList.add("showMeMoreOptionsOff");
    moreOptionsWindow.classList.add("showMeMoreOptionsOff");

    setTimeout(() => {
        labelMoreOptions.classList.remove("showMeMoreOptionsOff");
        moreOptionsWindow.classList.remove("showMeMoreOptionsOff");
    }, 300);
})