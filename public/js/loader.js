let LoadTarget = document.querySelector(".loading")

function show_loading(){
    LoadTarget.style.display = "block";   
}
function loadingPage(){
    // LoadTarget.style.display = "none";
    let LoadEffect = setInterval(() => {
        if (!LoadTarget.style.opacity) {
            LoadTarget.style.opacity = 1;
        }
        if (LoadTarget.style.opacity > 0) {
            LoadTarget.style.opacity -= 0.1;
        } else {
            clearInterval(LoadEffect)
            LoadTarget.style.display = "none"
        }
    }, 10)
}