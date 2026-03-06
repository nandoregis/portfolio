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
        const scrollGump = 25;
        var scrollTop = window.scrollY;
        var contadorScroll = 0;
        

        buttons.forEach( i => {
            i.addEventListener('click', (e) => {
                e.preventDefault();
                
                const id = i.getAttribute('href');
                const offset = document.querySelector(id).offsetTop;
                scrollTop = offset;
                
                const interval = setInterval(() => {

                    if(scrollTop == 0) {

                        contadorScroll = window.scrollY - scrollGump;

                    } else contadorScroll = contadorScroll + scrollGump; 
                   
                    window.scrollTo(0, contadorScroll);

                    if( ( scrollTop > 0 && contadorScroll >= scrollTop ) || contadorScroll < 0 ) 
                    {
                        contadorScroll = scrollTop;
                        clearInterval(interval);
                    }
                    
                    
                }, 10);
               
            });
        });


    </script>
</div>