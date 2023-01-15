function readMore() {
    let descInfo = document.querySelector(".desc__info");

    btn.onclick = () => {
        if (btn.classList.contains("hide")) {
            window.scrollTo({
                top: 0,
                left: 0,
                behavior: 'smooth'
            });

            descInfo.style.maxHeight = "15rem";
            descInfo.style.overflow = "hidden";
            btn.innerText = "Читать дплее";
            btn.classList.remove("hide");


        } else {
            descInfo.style.maxHeight = "100%";
            descInfo.style.overflow = "none";
            btn.innerText = "Скрыть";
            btn.classList.add("hide");
        }
    }
}