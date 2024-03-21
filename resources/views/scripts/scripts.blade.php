<script>
    const dialog = document.querySelector("dialog");
    const showButton = document.querySelector("dialog + button");
    const closeButton = document.querySelector("dialog button");

    showButton.addEventListener("click", () => {
        dialog.showModal();
    });

    closeButton.addEventListener("click", () => {
        dialog.close();
    });

    const box = document.querySelector(".boxTaskInvisible");
    const buttons = document.querySelectorAll(".taskCard");

    buttons.forEach((button, index) => {
        button.addEventListener("click", () => {
            buttons.forEach((otherButton, otherIndex) => {
                if (otherIndex !== index) {
                    box.classList.remove('active');
                }
            });

            box.classList.toggle('active');
        });
    });
</script>
