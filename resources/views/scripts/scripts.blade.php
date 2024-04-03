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

    function openModal() {
        document.getElementById("myModal").style.display = "flex";
    }

    function closeModal() {
        document.getElementById("myModal").style.display = "none";
    }

    const menu = document.querySelector(".menu");
    const menuContent = document.querySelector(".menuContent");
    const closeBtn = document.querySelector(".closeBtn");

    menu.addEventListener('click', () => {
        menuContent.classList.add('active')
    })

    closeBtn.addEventListener('click', () => {
        menuContent.classList.remove('active')
    })
</script>
