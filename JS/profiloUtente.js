const photoInput = document.getElementById("photoInput");
const profileImg = document.getElementById("profileImg");

photoInput.onchange = () => {
    const file = photoInput.files[0];
    if (file) {
        profileImg.src = URL.createObjectURL(file);
    }
};
