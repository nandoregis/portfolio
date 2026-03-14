
/* ── helpers ── */
const $  = id => document.getElementById(id);
const fields = ['f-title','f-tech','f-img','f-desc','f-gh','f-demo'];
const baseUrl = 'http://app-portfolio.localhost';


/* ── modal ── */
function openModal() {
    $('modal-overlay').classList.add('modal-overlay--active');
    document.body.style.overflow = 'hidden';
    setTimeout(() => $('f-title').focus(), 320);
}

function closeModal() {
    $('modal-overlay').classList.remove('modal-overlay--active');
    document.body.style.overflow = '';
}

$('btn-open-modal').addEventListener('click', openModal);
$('btn-close-modal').addEventListener('click', closeModal);
$('btn-cancel').addEventListener('click', closeModal);
$('modal-overlay').addEventListener('click', e => { if (e.target === $('modal-overlay')) closeModal(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

/* ── filters ── */
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', () => {
    document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('filter-btn--active'));
    btn.classList.add('filter-btn--active');
    });
});

/**
 * 
 * @param {*} title 
 * @param {*} tech 
 * @returns 
 */
const buildInitialPlusRandomGradient = ( title, tech ) => {

    /* build initials + random gradient */
    const initials = title.split(' ').slice(0,2).map(w => w[0]).join('').toUpperCase();
    const grads = [
        '#1a3a4a,#2B6F8D','#1c2a1a,#2e6b28',
        '#20182e,#5a2e8d','#2a1a1a,#8d3a2e','#18242e,#1e6b6b'
    ];
    const [a, b] = grads[Math.floor(Math.random() * grads.length)].split(',');
    const tags = tech
        ? tech.split(',').slice(0,3).map(t => `<span class="tech-tag">${t.trim()}</span>`).join('')
        : '';

    return {
        initials,
        a,
        b,
        tags
    }
}


/**
 * 
 * @param {*} title 
 * @param {*} tech 
 * @returns 
 */
const createProjectComponentList = (title, tech, uuid = "") => {

    const { initials, a, b, tags } = buildInitialPlusRandomGradient(title, tech);

    const li = document.createElement('li');
    li.setAttribute('data-uuid', uuid);
    li.className = 'proj-row proj-row--enter';
    li.innerHTML = `
        <div class="proj-row__proj">
        <div class="proj-thumb" style="--thumb-a:${a};--thumb-b:${b}">${initials}</div>
        <div class="proj-row__info">
            <p class="proj-row__name">${title}</p>
            <p class="proj-row__url">recém adicionado</p>
        </div>
        </div>
        <div class="proj-row__tech">${tags}</div>
        <div class="proj-row__status"><span class="badge badge--live">Publicado</span></div>
        <div class="proj-row__actions">
        <button class="icon-btn" title="Editar">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
            <path d="M9.5 1.5L11.5 3.5L4.5 10.5H2.5V8.5L9.5 1.5Z" stroke="currentColor" stroke-width="1.2" stroke-linejoin="round"/>
            </svg>
        </button>
        <button class="icon-btn icon-btn--danger" title="Excluir">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
            <path d="M2 3.5H11M4.5 3.5V2H8.5V3.5M5 6V9.5M8 6V9.5M2.5 3.5L3.3 11H9.7L10.5 3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </button>
        </div>`;
    
    return li;
}

const listItem = async () => {

    const response = await fetch(`${baseUrl}/admin/v1/api/projetos`);
    const data = await response.json();

    data.forEach( item => {
        const li = createProjectComponentList(item.titulo, item.tecnologias);
        $('proj-list').appendChild(li);
        li.classList.add('proj-row--visible');
    });
}

listItem();

/* ── submit ── */
$('btn-submit').addEventListener('click', () => {

    const inputs = fields.map(id => $(id));
    var btnEventLoading = true;
    const title = $('f-title').value.trim();
    const tech = $('f-tech').value.trim();
    const desc = $('f-desc').value.trim();
    const img = $('f-img').value.trim();
    const gh = $('f-gh').value.trim();
    const demo = $('f-demo').value.trim();

    // validate

    inputs.forEach( input => {
    
        if ( !input.value.trim() ) 
        {
            const inp = $(input.getAttribute('id'));
            inp.classList.add('field__input--error');
            inp.focus();
            setTimeout(() => inp.classList.remove('field__input--error'), 2200);


            /* toast */
            const t = $('toast');
            t.textContent = "Campos com * são obrigatórios";
            t.classList.add('toast--show');
            setTimeout(() => t.classList.remove('toast--show'), 3200);
            
            btnEventLoading = false;
            return;

        }
    
    });

    if(!btnEventLoading) return;

    const btn = $('btn-submit');
    btn.classList.add('btn-primary--loading');

    setTimeout( async () => {
   
        $('proj-list').appendChild( createProjectComponentList(title, tech) );
        requestAnimationFrame(() => li.classList.add('proj-row--visible'));

        /* update count */
        const total = $('stat-total');
        total.textContent = parseInt(total.textContent) + 1;

        /* clear */
        fields.forEach(id => $(id).value = '');
        btn.classList.remove('btn-primary--loading');
        closeModal();

        // enviar para API [ post ]
        const form = new FormData();

        form.append("titulo", title);
        form.append("descricao", desc);
        form.append("tecnologias", tech);
        form.append("img_url", img);
        form.append("github_url", gh);
        form.append("demo_url", demo);

        const post = await fetch(`${baseUrl}/admin/v1/api/projetos/c/create`, {
            method: "POST",
            body: form
        });

        const response = await post.json();

        /* toast */
        const t = $('toast');
        t.classList.add('toast--show');
        t.textContent = response.message;
        setTimeout(() => t.classList.remove('toast--show'), 3200);

    }, 800);


});

/* ── delete rows ── */
document.addEventListener('click', e => {
    const del = e.target.closest('.icon-btn--danger');
    if (!del) return;
    const row = del.closest('.proj-row');
    if (!row) return;
    row.classList.add('proj-row--exit');
    setTimeout(() => {
    row.remove();
    const total = $('stat-total');
    const newCount = Math.max(0, parseInt(total.textContent) - 1);
    total.textContent = newCount;
    if (!$('proj-list').children.length) $('proj-empty').hidden = false;
    }, 320);
});
