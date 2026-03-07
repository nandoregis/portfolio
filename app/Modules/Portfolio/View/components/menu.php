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
        
        


        const scrollSmooth = (target) => {
            
            const startScroll = window.scrollY;
            const distance = target - startScroll;
            const duration = 600;
            let startTime = null


            console.log('target : ',target);
            console.log('distance : ',distance);
            console.log('startScroll : ',startScroll);


            function animation ( currentTime ) {

                if(!startTime) startTime = currentTime;

                const elapsedTime = currentTime - startTime;
                const progress = Math.min(elapsedTime / duration, 1);

                const ease = progress < 0.5 
                ?  4 * progress * progress * progress 
                :  (progress - 1) * (2 * progress - 2) * (2 * progress - 2) + 1

                window.scrollTo(0, startScroll + distance * ease);

                console.log(startScroll + distance * ease)

                if(elapsedTime < duration ) {

                    requestAnimationFrame(animation);
                }

            }

            requestAnimationFrame(animation);
        }


        buttons.forEach(btn => {

            btn.addEventListener('click', (e)=>{

                e.preventDefault();

                const id = btn.getAttribute('href');
                const element = document.querySelector(id);

                scrollSmooth(element.offsetTop);

            });

        });

       


    </script>
</div>