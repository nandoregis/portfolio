<div class="menu">
    <nav>
        <ul>
            <li><a href="#home"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="#skills"><i class="fas fa-graduation-cap"></i></a></li>
            <li><a href="#projetos"><i class="fa-solid fa-chart-line"></i></a></li>
            <li><a href="#sobre"><i class="fa-solid fa-user"></i></a></li>
        </ul>
    </nav>

    <script>
        const buttons = document.querySelectorAll('.menu nav a');
        
        buttons.forEach(btn => {

            btn.addEventListener('click', (e) => {
                e.preventDefault();

                const id = btn.getAttribute('href');
                const element = document.querySelector(id);

                const offset = element.offsetTop;

                window.scrollTo({
                    top: offset,
                    behavior: "smooth"
                });

            });

        });
        


    </script>
</div>