<header class="header-principal">
    <div class="logo flex">
        
       <img id="img-logo-header" src="/assets/img/favicon.png" alt="">

       <div id="btn-mobile" class="btn-menu-mobile flex-center">

            <svg class="open" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 46 36" fill="none">
                <path d="M3 3H43M3 18H28M3 33H15.5" stroke="#bebebe" stroke-width="5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>

        </div>


    </div>

    <div class="header-principal--user">

        <p class="menu__user-nome">{@username}</p>

        <img id="img-user" src="https://ui-avatars.com/api/?name=Nellure" alt="">

        <div id="submenu-user" class="header-principal--user__submenu">

            <ul>
                <li id="loggout" class="menu__loggout">
                    <a href="/auth/logout" class="flex-center">
                        <svg width="15" height="15" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7.8877 13.984L9.4385 15.5615L15 10L9.4385 4.4385L7.8877 6.01604L10.7487 8.87701H0V11.123H10.7487L7.8877 13.984ZM17.7807 0H2.21925C1.59537 0 1.06952 0.21836 0.641711 0.65508C0.213904 1.0918 0 1.61319 0 2.21925V6.65775H2.21925V2.21925H17.7807V17.7807H2.21925V13.3422H0V17.7807C0 18.4046 0.213904 18.9305 0.641711 19.3583C1.06952 19.7861 1.59537 20 2.21925 20H17.7807C18.4046 20 18.9305 19.7861 19.3583 19.3583C19.7861 18.9305 20 18.4046 20 17.7807V2.21925C20 1.61319 19.7816 1.0918 19.3449 0.65508C18.9082 0.21836 18.3868 0 17.7807 0Z" fill="#DEE4EC"/>
                        </svg>
                        <p>Sair</p>
                    </a>
                </li>

            </ul>
          

        </div>

    </div><!-- parte do menu o usuario -->

    <script>
        const imgUser = document.getElementById('img-user');
        const subMenuUser = document.getElementById('submenu-user');
        const btnMob = document.getElementById('btn-mobile');

        imgUser.addEventListener('click', () => {
            subMenuUser.classList.toggle('show');
        });

        btnMob.addEventListener('click', () => {
            document.getElementById('menu').classList.toggle('show');
        })

    </script>

</header>
