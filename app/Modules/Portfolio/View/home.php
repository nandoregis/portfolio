<section id="home" class="home bg-style">

    <div class="my">

        <div class="my--wraper tracking">

            <div class="my--picture-box effect-shadow">
                <img src="assets/img/my.png" alt="">
            </div>
            
            <div class="my--text">
                <h1>Olá, eu sou <span>Luís</span></h1>
                <h2>DESENVOLVEDOR <span id="typing"></span></h2>
            </div>
    
            <div class="my--button">
                <a href="#skills" id="ver-mais" class="ver-mais">Veja mais</a>
                <a href="assets/cv/cv.pdf" download="CV-Luís-Fernando.pdf" class="baixar-cv">Baixar CV</a>
            </div>
    
            <p class="my--declariation">Construo interfaces e sistemas com atenção aos detalhes, foco em performance e prezo pela boa experiência do usuário.</p>

        </div><!--my-wraper-->

    </div>

    <script>
        const btnVermais = document.getElementById('ver-mais');

        btnVermais.addEventListener('click', (e)=>{
            e.preventDefault();
            
            let positionTop = btnVermais.getAttribute('href');
            let scrollTop = document.querySelector(positionTop).offsetTop;

            window.scrollTo({
                top: scrollTop,
                behavior: "smooth",
            });

        });

       
        const effectAnimationText = () => {

         const typing = document.getElementById('typing');
            const techs = [
                'JAVASCRIPT',
                'PHP',
                'NODE.JS',
                'FRONT-END',
                'BACK-END',
                'FULL STACK'
            ];
            
            let indexArr = 0;
            let indexText = 0;
            let text = techs[indexArr];

            const interval = setInterval(() => {

                if(indexText < text.length) {

                    typing.textContent += text.charAt(indexText);
                    indexText++;

                }else {
                    indexText = 0
                    indexArr++;
                    if(indexArr > techs.length - 1) indexArr = 0;
                    text = techs[indexArr];
                    typing.textContent = "";
                
                }

                
            }, 500);

        }

        effectAnimationText();

    </script>

</section>



