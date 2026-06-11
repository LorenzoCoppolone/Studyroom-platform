window.addEventListener("DOMContentLoaded", () => {
    const popup = document.getElementById("popup-preferiti");
    if (!popup) return;

    popup.classList.add("show");

    setTimeout(() => {
        popup.classList.remove("show");
    }, 2500);
});
