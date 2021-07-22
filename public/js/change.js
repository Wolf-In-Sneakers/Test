document.addEventListener("click", (event) => {
    if (event.target.closest(".change_link")) {
        document.querySelector("#floatingModalIdChange").value = event.target.closest(".change_link").dataset.id;
        document.querySelector("#floatingModalSignatureChange").value = event.target.closest(".change_link").dataset.name;
        document.querySelector("#floatingModalLinkChange").value = event.target.closest(".change_link").dataset.link;
    }
});