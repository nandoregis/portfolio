<div id="projetos" class="projetos bg-style">
    <div class="my-projetos">
        <h2>Projetos</h2>
        <p>Minha coleção de projetos</p>

        <div class="my-projetos--gp">

           {@cards}

        </div>
    </div>
</div>

<script>
    const githubLink = document.querySelectorAll('#projeto-github-link a');
    const demoLink = document.querySelectorAll('#projeto-demo-link a');

    for (let i = 0; i < githubLink.length; i++) 
    {
        if(githubLink[i].getAttribute('href') == '#') githubLink[i].parentElement.remove();
        if(demoLink[i].getAttribute('href') == '#') demoLink[i].parentElement.remove();
    }


</script>
  