const reportBtn = document.getElementById("reportBtn");

reportBtn.style.background = "grey";
reportBtn.style.pointerEvents = "none";

let postName = document.getElementById("postName").innerHTML;
let postEmail = document.getElementById("postEmail").value;
let postType = document.getElementById("postType").value;
let postContent = document.getElementById("postContent").value;

document.body.addEventListener("keydown", checkIfEmpty);
document.body.addEventListener("keyup", checkIfEmpty);

function checkIfEmpty(){
    postName = document.getElementById("postName").value;
    postEmail = document.getElementById("postEmail").value;
    postType = document.getElementById("postType").value;
    postContent = document.getElementById("postContent").value;

    if(postName != "" && postEmail != "" && postType != "" && postContent != ""){
        reportBtn.style.background = "#4E9F3D";
        reportBtn.style.pointerEvents = "auto";
    }else{
        reportBtn.style.background = "grey";
        reportBtn.style.pointerEvents = "none";
    }
}