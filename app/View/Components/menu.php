<div id="menu" class="menu">
    
    <nav class="menu__nav">
        <ul>
            {@li}
        </ul>
    </nav><!-- navegação do menu -->
    
</div>



<script>
    const menu = document.getElementById('menu');
    const li = document.querySelectorAll('.menu--nav-primary');
    const nav = document.querySelectorAll('.menu--nav-primary a.sub-menu');
    

    nav.forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();

            el.parentElement.children[1].classList.toggle('show');
        })
    });

</script>