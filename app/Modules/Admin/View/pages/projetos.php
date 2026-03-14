

  <!-- ══════════════════════════════════
       MAIN
  ══════════════════════════════════ -->
  <main class="main">

    <!-- BG decorations -->
    <div class="main__orb main__orb--1"></div>
    <div class="main__orb main__orb--2"></div>

    <!-- ── HEADER ── -->
    <header class="page-header">
      <div class="page-header__left">
        <p class="page-header__eyebrow">Gerenciamento</p>
        <h1 class="page-header__title">Projetos</h1>
      </div>
      <button class="btn-primary" id="btn-open-modal">
        <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
          <path d="M6.5 1V12M1 6.5H12" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
        </svg>
        Novo Projeto
      </button>
    </header>

    <!-- ── STATS ── -->
    <div class="stats-row">
      <div class="stat">
        <span class="stat__num" id="stat-total">0</span>
        <span class="stat__label">Total</span>
      </div>
      <div class="stat-divider"></div>
      <div class="stat">
        <span class="stat__num" id="stat-public">0</span>
        <span class="stat__label">Publicados</span>
      </div><div class="stat-divider"></div>
      <div class="stat">
        <span class="stat__num">#</span>
        <span class="stat__label">Em processo</span>
      </div>
    </div>

    <!-- ── LIST ── -->
    <section class="proj-section">

      <div class="proj-section__header">
        <p class="proj-section__label">Lista de projetos</p>
        <div class="proj-section__filters">
          <button class="filter-btn filter-btn--active">Todos</button>
          <button class="filter-btn">Publicados</button>
          <button class="filter-btn">Em progresso</button>
        </div>
      </div>

      <!-- table head -->
      <div class="proj-thead">
        <span class="proj-thead__col proj-thead__col--proj">Projeto</span>
        <span class="proj-thead__col proj-thead__col--tech">Tecnologias</span>
        <span class="proj-thead__col proj-thead__col--status">Status</span>
        <span class="proj-thead__col proj-thead__col--actions"></span>
      </div>

      <!-- rows -->
      <ul class="proj-list" id="proj-list">

      </ul>

    
    </section>

  </main>

  <!-- ══════════════════════════════════
       MODAL
  ══════════════════════════════════ -->
  <div class="modal-overlay" id="modal-overlay">
    <div class="modal" id="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">

      <div class="modal__line"></div>

      <div class="modal__header">
        <div>
          <span class="modal__eyebrow">Cadastrar</span>
          <h2 class="modal__title" id="modal-title">Novo Projeto</h2>
        </div>
        <button class="icon-btn" id="btn-close-modal" aria-label="Fechar">
          <svg width="14" height="14" viewBox="0 0 14 14" fill="none">
            <path d="M2.5 2.5L11.5 11.5M11.5 2.5L2.5 11.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round"/>
          </svg>
        </button>
      </div>

      <div class="modal__sep"></div>

      <div class="modal__body">

        <div class="fields-grid">
          <div class="field">
            <label class="field__label" for="f-title">Título <span class="field__req">*</span></label>
            <input class="field__input" type="text" id="f-title" placeholder="Nome do projeto" autocomplete="off"/>
          </div>
          <div class="field">
            <label class="field__label" for="f-tech">Tecnologias<span class="field__req">*</span></label>
            <input class="field__input" type="text" id="f-tech" placeholder="React, Node..." autocomplete="off"/>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="f-img">Imagem de capa<span class="field__req">*</span></label>
          <div class="field__icon-wrap">
            <svg class="field__ico" width="13" height="13" viewBox="0 0 13 13" fill="none">
              <rect x="1" y="2" width="11" height="9" rx="1.5" stroke="currentColor" stroke-width="1.2"/>
              <circle cx="4" cy="5" r="1" stroke="currentColor" stroke-width="1.1"/>
              <path d="M1 9L3.5 6.5L6 9L8.5 7L12 10" stroke="currentColor" stroke-width="1.1" stroke-linejoin="round"/>
            </svg>
            <input class="field__input field__input--ico" type="text" id="f-img" placeholder="https://..." autocomplete="off"/>
          </div>
        </div>

        <div class="field">
          <label class="field__label" for="f-desc">Descrição<span class="field__req">*</span></label>
          <textarea class="field__textarea" id="f-desc" placeholder="Descreva brevemente o projeto..." rows="3"></textarea>
        </div>

        <div class="fields-grid">
          <div class="field">
            <label class="field__label" for="f-gh">GitHub<span class="field__req">*</span></label>
            <div class="field__icon-wrap">
              <svg class="field__ico" width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M6.5 1C3.46 1 1 3.46 1 6.5c0 2.43 1.57 4.49 3.75 5.22.27.05.37-.12.37-.27v-.93c-1.52.33-1.84-.74-1.84-.74-.25-.63-.61-.8-.61-.8-.5-.34.04-.33.04-.33.55.04.84.57.84.57.49.84 1.28.6 1.6.46.05-.36.19-.6.35-.74-1.22-.14-2.5-.61-2.5-2.72 0-.6.22-1.09.57-1.47-.06-.14-.25-.7.05-1.47 0 0 .46-.15 1.51.57.44-.12.91-.18 1.37-.18s.93.06 1.37.18c1.05-.72 1.51-.57 1.51-.57.3.77.11 1.33.05 1.47.36.38.57.87.57 1.47 0 2.12-1.29 2.58-2.52 2.72.2.17.38.51.38 1.03v1.53c0 .15.1.32.38.27C10.43 10.99 12 8.93 12 6.5 12 3.46 9.54 1 6.5 1z" fill="currentColor"/>
              </svg>
              <input class="field__input field__input--ico" type="text" id="f-gh" placeholder="github.com/user/repo" autocomplete="off"/>
            </div>
          </div>
          <div class="field">
            <label class="field__label" for="f-demo">Demo<span class="field__req">*</span></label>
            <div class="field__icon-wrap">
              <svg class="field__ico" width="13" height="13" viewBox="0 0 13 13" fill="none">
                <path d="M5 2.5H3C2.2 2.5 1.5 3.2 1.5 4V10C1.5 10.8 2.2 11.5 3 11.5H9C9.8 11.5 10.5 10.8 10.5 10V8M7.5 1.5H11.5M11.5 1.5V5.5M11.5 1.5L6 7" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
              </svg>
              <input class="field__input field__input--ico" type="text" id="f-demo" placeholder="https://demo.vercel.app" autocomplete="off"/>
            </div>
          </div>
        </div>

      </div>

      <div class="modal__sep"></div>

      <div class="modal__footer">
        <span class="modal__hint">
          <svg width="11" height="11" viewBox="0 0 11 11" fill="none">
            <circle cx="5.5" cy="5.5" r="4.5" stroke="currentColor" stroke-width="1.1"/>
            <path d="M5.5 5V8M5.5 3.5V3" stroke="currentColor" stroke-width="1.1" stroke-linecap="round"/>
          </svg>
          Campos com <span class="field__req">*</span> são obrigatórios
        </span>
        <div class="modal__footer-actions">
          <button class="btn-ghost" id="btn-cancel">Cancelar</button>
          <button class="btn-primary" id="btn-submit" action="new">
            <span class="btn-primary__label">Salvar projeto</span>
            <span class="btn-primary__spinner" aria-hidden="true"></span>
          </button>
        </div>
      </div>

    </div>
  </div>

  <!-- TOAST -->
  <div class="toast" id="toast" role="status">
    <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
      <circle cx="6.5" cy="6.5" r="5.5" stroke="currentColor" stroke-width="1.2"/>
      <path d="M4 6.5L5.8 8.3L9 5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Projeto salvo com sucesso
  </div>

 <script src="assets/js/admin/projetos.js"></script>
