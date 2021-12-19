"use strict";

const counter = document.getElementById("counter").innerHTML;

let posts = [];
for(let i = 0; i < counter; i++){
    posts.push("post" + (i + 1));
    // console.log(posts[i]);
}
let postsId = [];
for(let i = 0; i < counter; i++){
    postsId.push("postId" + (i + 1));
    // console.log(postsId[i]);
}

let btns = [];
for(let i = 0; i < counter; i++){
    btns.push("btn" + (i + 1));
    // console.log(btns[i]);
}

function startSliding(postCounter){
    if(postCounter == counter){
        let url = "http://abra.martinzach.cz/?pageType=all";

        window.location.href = url;
    }else{
        let currentBtnName = btns[postCounter - 1];
        const currentBtn = document.getElementById(currentBtnName);
        
        let postNowName = posts[(postCounter - 1)];
        const postNow = document.getElementById(postNowName);
    
        let nextPageName = posts[postCounter];
        const nextPage = document.getElementById(nextPageName);
        
        postNow.classList.add("hide");
        console.log("add hide");
        setTimeout(() => {
            postNow.classList.add("hidden");

            nextPage.classList.add("show");
            setTimeout(() => {
                nextPage.classList.remove("hidden");
            }, 500);

        }, 500);
    }
}

// function chengeLastButton(counter){

//     let lastBtnName = btns[counter];
//     const lastBtn = document.getElementById(lastBtnName);

//     lastBtn.innerHTML = "Ukončit čtení";
// }