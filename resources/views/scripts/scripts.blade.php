<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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

    setTimeout(function () {
        document.querySelectorAll('.alert').forEach(function (element) {
            element.style.display = 'none';
        });
    }, 3500);

    setTimeout(function () {
        document.querySelectorAll('.success').forEach(function (element) {
            element.style.display = 'none';
        });
    }, 3500);

    $(document).ready(function () {
        $('.task-link').click(function (e) {
            e.preventDefault();

            var taskId = $(this).data('id');
            var taskShowUrl = $(this).hasClass('project-task-link') ? '/projects/' + taskId + '/preview' : '/tasks/' + taskId + '/preview';

            $.get(taskShowUrl, function (data) {
                $('#task-details').html(data);
            });
        });
    });

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    window.onclick = function (event) {
        if (!event.target.matches('.dropbtn')) {
            closeDropdowns();
        }
    }

    document.onscroll = function () {
        closeDropdowns();
    }

    function closeDropdowns() {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
</script>

@yield('scripts')
