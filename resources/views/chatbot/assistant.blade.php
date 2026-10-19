{{--
    Widget flotante de SOFIA.
    Se incluye desde layouts/app.blade.php con @auth @include('chatbot.assistant') @endauth
    Este archivo NO debe usar @extends: es solo un fragmento.

    Avatar animado: guarda la imagen de Sofia en public/images/sofia.png
    (también se acepta .webp, .jpg o .jpeg). Sin imagen se muestra el ícono de chat.
--}}

<div id="sofia-widget"
     class="sofia-widget"
     data-endpoint="{{ route('chatbot.message') }}"
     data-reset="{{ route('chatbot.reset') }}"
     data-csrf="{{ csrf_token() }}">

    {{-- Globo de invitación (decorativo; el botón ya es accesible) --}}
    <div id="sofia-teaser" class="sofia-teaser" aria-hidden="true"></div>

    <button type="button"
            id="sofia-toggle"
            class="sofia-toggle"
            aria-label="Abrir chat con SOFIA"
            aria-expanded="false"
            aria-controls="sofia-panel">
        <span id="sofia-follow" class="sofia-follow">
            <span class="sofia-idle">
                <img id="sofia-avatar"
                     class="sofia-avatar"
                     data-base="{{ asset('images') }}"
                     alt=""
                     draggable="false">
                <span class="sofia-lamp" aria-hidden="true"></span>
            </span>
        </span>
        <i class="fa-solid fa-comments sofia-fallback-icon"></i>
    </button>

    <section id="sofia-panel" class="sofia-panel" aria-label="Chat con SOFIA" hidden>

        <header class="sofia-header">
            <div class="sofia-header__info">
                <span class="sofia-face sofia-face--header" aria-hidden="true">
                    <i class="fa-solid fa-helmet-safety"></i>
                    <span class="sofia-face__status"></span>
                </span>
                <div class="sofia-header__text">
                    <strong>SOFIA</strong>
                    <small><span class="sofia-online"></span>En línea · Asistente de MINERSCAN</small>
                </div>
            </div>

            <div class="sofia-header__actions">
                <button type="button" id="sofia-clear" title="Nueva conversación" aria-label="Nueva conversación">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
                <button type="button" id="sofia-close" title="Cerrar" aria-label="Cerrar chat">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        </header>

        <div id="sofia-messages" class="sofia-messages" aria-live="polite"></div>

        {{-- Preguntas sugeridas: solo se ven al inicio de la conversación --}}
        <div id="sofia-chips" class="sofia-chips">
            <button type="button" class="sofia-chip">¿Qué es MINERSCAN?</button>
            <button type="button" class="sofia-chip">¿Cómo funciona la asistencia biométrica?</button>
            <button type="button" class="sofia-chip">¿Cómo funciona la geolocalización?</button>
        </div>

        <form id="sofia-form" class="sofia-form" autocomplete="off">
            <input type="text"
                   id="sofia-input"
                   maxlength="1000"
                   placeholder="Escribe tu pregunta... / Ask a question..."
                   aria-label="Mensaje para SOFIA"
                   required>
            <button type="submit" id="sofia-send" aria-label="Enviar">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </form>

    </section>
</div>

@verbatim
<style>
    .sofia-widget {
        position: fixed;
        right: 24px;
        bottom: 24px;
        z-index: 1040; /* por debajo de los modales de Bootstrap (1055) */
        font-family: inherit;
    }

    /* ================= BOTÓN / AVATAR 3D ================= */

    .sofia-toggle {
        position: relative;
        display: block;
        width: 96px;
        height: 96px;
        padding: 0;
        border: 0;
        background: transparent;
        cursor: pointer;
        perspective: 500px;
        -webkit-tap-highlight-color: transparent;
    }

    .sofia-toggle:focus-visible { outline: 3px solid #ffc107; outline-offset: 4px; border-radius: 16px; }

    /* capa 1: sigue el mouse (inclinación 3D) */
    .sofia-follow {
        display: block;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transform: rotateX(var(--sofia-rx, 0deg)) rotateY(var(--sofia-ry, 0deg));
        transition: transform .18s ease-out;
    }

    /* capa 2: movimiento propio (flota, respira, mira a los lados) */
    .sofia-idle {
        position: relative;
        display: block;
        width: 100%;
        height: 100%;
        transform-style: preserve-3d;
        transform-origin: 50% 90%;
        animation: sofia-idle 7s ease-in-out infinite;
    }

    .sofia-avatar {
        display: block;
        width: 100%;
        height: 100%;
        object-fit: contain;
        user-select: none;
        pointer-events: none;
        opacity: 0;
        transition: opacity .25s ease;
    }

    /* se muestra cuando el fondo ya está limpio (evita ver el cuadro con fondo un instante) */
    .sofia-avatar--clean {
        opacity: 1;
        filter: drop-shadow(0 6px 8px rgba(0, 0, 0, .35));
    }

    /* luz de la linterna del casco (ajusta --sofia-lamp-x / --sofia-lamp-y si cambias la imagen) */
    .sofia-lamp {
        position: absolute;
        left: var(--sofia-lamp-x, 50%);
        top: var(--sofia-lamp-y, 15%);
        width: 22%;
        height: 22%;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255, 247, 190, .95) 0%, rgba(255, 226, 120, .45) 45%, transparent 70%);
        pointer-events: none;
        animation: sofia-lamp 2.2s ease-in-out infinite;
    }

    @keyframes sofia-idle {
        0%   { transform: translateY(0)    rotateY(0deg)   rotateZ(0deg)  scale(1); }
        10%  { transform: translateY(-4px) rotateY(-18deg) rotateZ(-2deg) scale(1.02); }  /* mira a la izquierda */
        27%  { transform: translateY(0)    rotateY(-18deg) rotateZ(-2deg) scale(1); }
        40%  { transform: translateY(-3px) rotateY(0deg)   rotateZ(0deg)  scale(1.03); }
        55%  { transform: translateY(-4px) rotateY(18deg)  rotateZ(2deg)  scale(1.02); }  /* mira a la derecha */
        72%  { transform: translateY(0)    rotateY(18deg)  rotateZ(2deg)  scale(1); }
        86%  { transform: translateY(-3px) rotateY(0deg)   rotateZ(0deg)  scale(1.03); }
        100% { transform: translateY(0)    rotateY(0deg)   rotateZ(0deg)  scale(1); }
    }

    @keyframes sofia-lamp {
        0%, 100% { opacity: .35; transform: translate(-50%, -50%) scale(.85); }
        50%      { opacity: 1;   transform: translate(-50%, -50%) scale(1.25); }
    }

    /* saltitos ansiosos: "¡úsame!" */
    .sofia-toggle.sofia-anxious { animation: sofia-anxious 1.7s ease-in-out; }

    @keyframes sofia-anxious {
        0%   { transform: translateY(0)     scale(1, 1)       rotate(0deg); }
        10%  { transform: translateY(0)     scale(1.08, .9)   rotate(0deg); }
        25%  { transform: translateY(-22px) scale(.95, 1.08)  rotate(0deg); }
        40%  { transform: translateY(0)     scale(1.08, .9)   rotate(0deg); }
        55%  { transform: translateY(-16px) scale(.97, 1.05)  rotate(0deg); }
        68%  { transform: translateY(0)     scale(1.05, .93)  rotate(0deg); }
        78%  { transform: translateY(-2px)  scale(1, 1)       rotate(-7deg); }
        88%  { transform: translateY(-2px)  scale(1, 1)       rotate(7deg); }
        100% { transform: translateY(0)     scale(1, 1)       rotate(0deg); }
    }

    .sofia-toggle:hover .sofia-idle { animation-duration: 3.5s; }
    .sofia-toggle:active .sofia-follow { transform: scale(.94); }

    /* con el chat abierto, Sofia se calma */
    .sofia-widget.is-open .sofia-lamp { animation: none; opacity: .8; }

    /* globo de invitación */
    .sofia-teaser {
        position: absolute;
        right: calc(100% + 8px);
        bottom: 45%;
        width: max-content;
        max-width: 230px;
        white-space: normal;
        padding: 8px 12px;
        background: #fff;
        color: #212529;
        border-radius: 14px 14px 4px 14px;
        font-size: .85rem;
        line-height: 1.3;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .22);
        opacity: 0;
        transform: translateY(6px) scale(.95);
        transition: opacity .25s ease, transform .25s ease;
        pointer-events: none;
    }

    .sofia-teaser.is-visible {
        opacity: 1;
        transform: none;
        pointer-events: auto;
        cursor: pointer;
    }

    /* respaldo si no existe la imagen: botón circular de antes */
    .sofia-fallback-icon { display: none; }

    .sofia-toggle--fallback {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #212529;
        color: #ffc107;
        font-size: 1.4rem;
        box-shadow: 0 6px 18px rgba(0, 0, 0, .3);
    }

    .sofia-toggle--fallback .sofia-follow { display: none; }
    .sofia-toggle--fallback .sofia-fallback-icon { display: inline; }

    @media (prefers-reduced-motion: reduce) {
        .sofia-idle,
        .sofia-lamp,
        .sofia-panel,
        .sofia-toggle.sofia-anxious { animation: none !important; }
        .sofia-follow { transition: none; transform: none !important; }
    }

    /* ================= CARITA DE SOFIA (encabezado y mensajes) ================= */

    .sofia-face {
        position: relative;
        flex: 0 0 auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #ffe082;
        background-repeat: no-repeat;
        background-size: 185%;
        background-position: 50% 4%;
        border: 2px solid #ffc107;
        color: #212529;
        font-size: .8rem;
        overflow: visible;
    }

    /* con la imagen cargada, se recorta la cara y se oculta el ícono de respaldo */
    .sofia-widget.has-face .sofia-face { background-image: var(--sofia-face); }
    .sofia-widget.has-face .sofia-face i { display: none; }

    .sofia-face--header {
        width: 46px;
        height: 46px;
        font-size: 1.15rem;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, .22);
    }

    .sofia-face__status {
        position: absolute;
        right: -1px;
        bottom: -1px;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #2ecc71;
        border: 2px solid #1b2438;
    }

    /* ================= PANEL DEL CHAT ================= */

    .sofia-panel {
        position: absolute;
        right: 0;
        bottom: 108px;
        width: 380px;
        max-width: calc(100vw - 32px);
        height: 540px;
        max-height: calc(100vh - 150px);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 16px 44px rgba(10, 16, 32, .35);
        transform-origin: bottom right;
        animation: sofia-pop .22s ease-out;
    }

    .sofia-panel[hidden] { display: none; }

    @keyframes sofia-pop {
        from { opacity: 0; transform: translateY(12px) scale(.94); }
        to   { opacity: 1; transform: none; }
    }

    .sofia-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 14px;
        background: linear-gradient(135deg, #161d2f 0%, #263253 100%);
        border-bottom: 3px solid #ffc107;
        color: #fff;
    }

    .sofia-header__info { display: flex; align-items: center; gap: 12px; line-height: 1.2; min-width: 0; }
    .sofia-header__text strong { display: block; font-size: 1.05rem; letter-spacing: .04em; }

    .sofia-header__text small {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: .74rem;
        opacity: .85;
    }

    .sofia-online {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #2ecc71;
        box-shadow: 0 0 0 0 rgba(46, 204, 113, .6);
        animation: sofia-online 2s infinite;
    }

    @keyframes sofia-online {
        0%   { box-shadow: 0 0 0 0 rgba(46, 204, 113, .55); }
        70%  { box-shadow: 0 0 0 6px rgba(46, 204, 113, 0); }
        100% { box-shadow: 0 0 0 0 rgba(46, 204, 113, 0); }
    }

    .sofia-header__actions { display: flex; gap: 2px; }

    .sofia-header__actions button {
        width: 32px;
        height: 32px;
        border: 0;
        border-radius: 8px;
        background: transparent;
        color: #fff;
        opacity: .75;
        cursor: pointer;
        transition: background .15s ease, opacity .15s ease;
    }

    .sofia-header__actions button:hover { opacity: 1; background: rgba(255, 255, 255, .12); }

    .sofia-messages {
        flex: 1;
        overflow-y: auto;
        padding: 16px 14px;
        background: #f2f4f8;
    }

    .sofia-msg { display: flex; align-items: flex-end; gap: 8px; margin-bottom: 12px; }
    .sofia-msg--user { justify-content: flex-end; }

    .sofia-bubble {
        max-width: 82%;
        padding: 10px 13px;
        border-radius: 16px;
        font-size: .92rem;
        line-height: 1.45;
        overflow-wrap: anywhere;
    }

    .sofia-msg--assistant .sofia-bubble {
        background: #fff;
        color: #212529;
        border-bottom-left-radius: 5px;
        box-shadow: 0 1px 3px rgba(20, 30, 55, .12);
    }

    .sofia-msg--user .sofia-bubble {
        background: linear-gradient(135deg, #1f2a44, #334370);
        color: #fff;
        border-bottom-right-radius: 5px;
    }

    .sofia-dots { display: inline-flex; gap: 4px; padding: 4px 0; }

    .sofia-dots i {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #8a949e;
        animation: sofia-bounce 1.2s infinite ease-in-out;
    }

    .sofia-dots i:nth-child(2) { animation-delay: .15s; }
    .sofia-dots i:nth-child(3) { animation-delay: .3s; }

    @keyframes sofia-bounce {
        0%, 80%, 100% { transform: translateY(0); opacity: .5; }
        40% { transform: translateY(-5px); opacity: 1; }
    }

    /* preguntas sugeridas */
    .sofia-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 0 12px 10px;
        background: #f2f4f8;
    }

    .sofia-chips[hidden] { display: none; }

    .sofia-chip {
        padding: 6px 12px;
        border: 1px solid #d5dae3;
        border-radius: 16px;
        background: #fff;
        color: #263253;
        font-size: .8rem;
        cursor: pointer;
        transition: background .15s ease, border-color .15s ease, transform .15s ease;
    }

    .sofia-chip:hover { background: #fff8e1; border-color: #ffc107; transform: translateY(-1px); }

    .sofia-form {
        display: flex;
        gap: 8px;
        padding: 10px 12px;
        background: #fff;
        border-top: 1px solid #e3e6ea;
    }

    .sofia-form input {
        flex: 1;
        min-width: 0;
        padding: 10px 14px;
        border: 1px solid #ced4da;
        border-radius: 22px;
        font-size: .92rem;
        background: #f8f9fb;
    }

    .sofia-form input:focus {
        outline: 0;
        background: #fff;
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, .25);
    }

    .sofia-form button {
        width: 42px;
        height: 42px;
        border: 0;
        border-radius: 50%;
        background: #ffc107;
        color: #212529;
        cursor: pointer;
        transition: background .15s ease, transform .15s ease;
    }

    .sofia-form button:hover { background: #ffb300; transform: scale(1.06); }
    .sofia-form button:disabled { opacity: .5; cursor: not-allowed; transform: none; }

    @media (max-width: 576px) {
        .sofia-widget { right: 12px; bottom: 12px; }
        .sofia-toggle { width: 78px; height: 78px; }
        .sofia-panel { width: calc(100vw - 24px); height: calc(100vh - 130px); bottom: 90px; }
        .sofia-teaser { max-width: 190px; }
    }
</style>

<script>
(function () {
    'use strict';

    var widget = document.getElementById('sofia-widget');
    if (!widget) { return; }

    var endpoint = widget.dataset.endpoint;
    var resetEndpoint = widget.dataset.reset;
    var csrf = widget.dataset.csrf;

    var toggleBtn = document.getElementById('sofia-toggle');
    var panel = document.getElementById('sofia-panel');
    var closeBtn = document.getElementById('sofia-close');
    var clearBtn = document.getElementById('sofia-clear');
    var list = document.getElementById('sofia-messages');
    var chips = document.getElementById('sofia-chips');
    var form = document.getElementById('sofia-form');
    var input = document.getElementById('sofia-input');
    var sendBtn = document.getElementById('sofia-send');

    var avatar = document.getElementById('sofia-avatar');
    var follow = document.getElementById('sofia-follow');
    var teaser = document.getElementById('sofia-teaser');

    var STORE_MESSAGES = 'sofia_chat_messages';
    var STORE_OPEN = 'sofia_chat_open';
    var MAX_STORED = 60;

    var WELCOME = '¡Hola! Soy <strong>SOFIA</strong>, la asistente virtual de MINERSCAN. ' +
        'Puedo responder en español, inglés y otros idiomas. ¿En qué te puedo ayudar?';

    var messages = [];
    var busy = false;
    var typingRow = null;

    /* ---------- almacenamiento de la pestaña (sessionStorage) ---------- */

    function storeGet(key) {
        try { return sessionStorage.getItem(key); } catch (e) { return null; }
    }

    function storeSet(key, value) {
        try { sessionStorage.setItem(key, value); } catch (e) { /* sin almacenamiento */ }
    }

    function storeRemove(key) {
        try { sessionStorage.removeItem(key); } catch (e) { /* sin almacenamiento */ }
    }

    /* ---------- mensajes ---------- */

    function updateChips() {
        // las sugerencias solo se ven mientras no haya mensajes del usuario
        chips.hidden = messages.length > 0;
    }

    function appendBubble(role, content, isHtml) {
        var row = document.createElement('div');
        row.className = 'sofia-msg sofia-msg--' + role;

        if (role === 'assistant') {
            var face = document.createElement('span');
            face.className = 'sofia-face';
            face.setAttribute('aria-hidden', 'true');
            face.innerHTML = '<i class="fa-solid fa-helmet-safety"></i>';
            row.appendChild(face);
        }

        var bubble = document.createElement('div');
        bubble.className = 'sofia-bubble';

        if (isHtml) {
            bubble.innerHTML = content;
        } else {
            bubble.textContent = content;
        }

        row.appendChild(bubble);
        list.appendChild(row);
        list.scrollTop = list.scrollHeight;

        return row;
    }

    function addMessage(role, content, isHtml) {
        appendBubble(role, content, isHtml);

        messages.push({ role: role, content: content, html: !!isHtml });

        if (messages.length > MAX_STORED) {
            messages = messages.slice(-MAX_STORED);
        }

        storeSet(STORE_MESSAGES, JSON.stringify(messages));
        updateChips();
    }

    function showTyping() {
        typingRow = appendBubble(
            'assistant',
            '<span class="sofia-dots"><i></i><i></i><i></i></span>',
            true
        );
    }

    function hideTyping() {
        if (typingRow) {
            typingRow.remove();
            typingRow = null;
        }
    }

    function restoreMessages() {
        var raw = storeGet(STORE_MESSAGES);

        try {
            var parsed = raw ? JSON.parse(raw) : [];
            messages = Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            messages = [];
        }

        list.innerHTML = '';

        if (messages.length === 0) {
            appendBubble('assistant', WELCOME, true);
        } else {
            messages.forEach(function (m) {
                if (m && typeof m.content === 'string' && (m.role === 'user' || m.role === 'assistant')) {
                    appendBubble(m.role, m.content, !!m.html);
                }
            });
        }

        updateChips();
    }

    /* ---------- abrir / cerrar ---------- */

    function hideTeaser() {
        teaser.classList.remove('is-visible');
    }

    function setOpen(open) {
        panel.hidden = !open;
        widget.classList.toggle('is-open', open);
        toggleBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        storeSet(STORE_OPEN, open ? '1' : '0');

        if (open) {
            hideTeaser();
            list.scrollTop = list.scrollHeight;
            input.focus();
        }
    }

    toggleBtn.addEventListener('click', function () { setOpen(panel.hidden); });
    closeBtn.addEventListener('click', function () { setOpen(false); });
    teaser.addEventListener('click', function () { setOpen(true); });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !panel.hidden) { setOpen(false); }
    });

    /* ---------- envío ---------- */

    function setBusy(value) {
        busy = value;
        sendBtn.disabled = value;
    }

    async function send(text) {
        addMessage('user', text, false);
        setBusy(true);
        showTyping();

        try {
            var res = await fetch(endpoint, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ message: text })
            });

            var data = null;
            try { data = await res.json(); } catch (e) { /* respuesta sin JSON */ }

            hideTyping();

            if (res.ok && data && typeof data.response === 'string') {
                addMessage('assistant', data.response, true);
            } else if (res.status === 419 || res.status === 401) {
                addMessage('assistant', 'Tu sesión expiró. Recarga la página e inicia sesión de nuevo.', false);
            } else if (res.status === 422) {
                addMessage('assistant', 'Tu mensaje no es válido (máximo 1000 caracteres).', false);
            } else if (res.status === 429) {
                addMessage('assistant', 'Has enviado muchas preguntas seguidas. Espera un momento e inténtalo de nuevo.', false);
            } else {
                var fallback = (data && typeof data.response === 'string')
                    ? data.response
                    : 'Lo siento, tuve un problema al procesar tu mensaje. Inténtalo nuevamente.';
                addMessage('assistant', fallback, false);
            }
        } catch (error) {
            hideTyping();
            addMessage('assistant', 'No pude conectarme con el servidor. Revisa tu conexión e inténtalo de nuevo.', false);
        } finally {
            setBusy(false);
            input.focus();
        }
    }

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var text = input.value.trim();
        if (!text || busy) { return; }

        input.value = '';
        send(text);
    });

    /* preguntas sugeridas */
    chips.addEventListener('click', function (event) {
        var chip = event.target.closest('.sofia-chip');
        if (!chip || busy) { return; }

        send(chip.textContent.trim());
    });

    /* ---------- nueva conversación ---------- */

    clearBtn.addEventListener('click', async function () {
        if (busy) { return; }

        try {
            await fetch(resetEndpoint, {
                method: 'POST',
                credentials: 'same-origin',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrf,
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
        } catch (e) { /* si falla, igual se limpia la pantalla */ }

        messages = [];
        storeRemove(STORE_MESSAGES);
        restoreMessages();
        input.focus();
    });

    /* ---------- al cerrar sesión se borra la conversación local ---------- */

    document.querySelectorAll('form[action$="/logout"]').forEach(function (logoutForm) {
        logoutForm.addEventListener('submit', function () {
            storeRemove(STORE_MESSAGES);
            storeRemove(STORE_OPEN);
        });
    });

    /* =====================================================
       AVATAR ANIMADO DE SOFIA
       ===================================================== */

    var reduceMotion = !!(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);
    var finePointer = !!(window.matchMedia && window.matchMedia('(pointer: fine)').matches);

    /* La carita del encabezado y de los mensajes usa la misma imagen, recortada */
    function setFace(url) {
        widget.style.setProperty('--sofia-face', 'url("' + url + '")');
        widget.classList.add('has-face');
    }

    /* Quita el fondo de la imagen en el navegador: blanco liso o el "cuadriculado de
       transparencia" (blanco/gris) que a veces queda pegado en las imágenes.
       Se rellena desde los bordes, así que el blanco/gris DENTRO del personaje no se toca.
       Si la imagen ya es un PNG transparente, no hace nada.
       Lo mejor sigue siendo usar un PNG sin fondo real. */
    function removeBackground(url) {
        var img = new Image();

        img.onload = function () {
            try {
                var MAX = 360;
                var scale = MAX / Math.max(img.naturalWidth, img.naturalHeight);
                var w = Math.max(1, Math.round(img.naturalWidth * scale));
                var h = Math.max(1, Math.round(img.naturalHeight * scale));

                var canvas = document.createElement('canvas');
                canvas.width = w;
                canvas.height = h;

                var ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, w, h);

                var imageData = ctx.getImageData(0, 0, w, h);
                var px = imageData.data;

                if (px[3] < 250) {                  // ya tiene transparencia real
                    avatar.src = url;
                    avatar.classList.add('sofia-avatar--clean');
                    setFace(url);
                    return;
                }

                var visited = new Uint8Array(w * h);
                var stack = [];

                // fondo = pixel claro y casi sin color (blanco o gris claro)
                function isBg(p) {
                    var i = p * 4;
                    var r = px[i], g = px[i + 1], b = px[i + 2];
                    var mx = Math.max(r, g, b), mn = Math.min(r, g, b);
                    return mn >= 185 && (mx - mn) <= 18;
                }

                function seed(p) {
                    if (!visited[p] && isBg(p)) { visited[p] = 1; stack.push(p); }
                }

                var x, y;
                for (x = 0; x < w; x++) { seed(x); seed((h - 1) * w + x); }
                for (y = 0; y < h; y++) { seed(y * w); seed(y * w + (w - 1)); }

                while (stack.length) {
                    var p = stack.pop();
                    var cx = p % w;
                    if (cx > 0) { seed(p - 1); }
                    if (cx < w - 1) { seed(p + 1); }
                    if (p >= w) { seed(p - w); }
                    if (p < w * (h - 1)) { seed(p + w); }
                }

                // pixeles del borde del personaje (vecinos del fondo): se suavizan
                var fringe = [];

                for (var q = 0; q < w * h; q++) {
                    if (visited[q]) { continue; }

                    var qx = q % w;
                    var touches = (qx > 0 && visited[q - 1]) ||
                                  (qx < w - 1 && visited[q + 1]) ||
                                  (q >= w && visited[q - w]) ||
                                  (q < w * (h - 1) && visited[q + w]);

                    if (touches) { fringe.push(q); }
                }

                for (var k = 0; k < w * h; k++) {
                    if (visited[k]) { px[k * 4 + 3] = 0; }
                }

                fringe.forEach(function (f) {
                    var i = f * 4;
                    var r = px[i], g = px[i + 1], b = px[i + 2];
                    var mn = Math.min(r, g, b), mx = Math.max(r, g, b);

                    if (mn >= 150 && (mx - mn) <= 30) {
                        px[i + 3] = Math.max(0, Math.min(255, (255 - mn) * 4));
                    }
                });

                ctx.putImageData(imageData, 0, 0);

                var clean = canvas.toDataURL('image/png');
                avatar.src = clean;
                avatar.classList.add('sofia-avatar--clean');
                setFace(clean);
            } catch (e) {
                // imagen de otro dominio u otro error: se usa tal cual
                avatar.src = url;
                avatar.classList.add('sofia-avatar--clean');
                setFace(url);
            }
        };

        img.src = url;
    }

    /* busca la imagen de Sofia: sofia.png, .webp, .jpg o .jpeg en public/images */
    var AVATAR_EXTS = ['png', 'webp', 'jpg', 'jpeg'];
    var avatarTry = 0;

    function loadAvatar() {
        if (avatarTry >= AVATAR_EXTS.length) {
            toggleBtn.classList.add('sofia-toggle--fallback'); // sin imagen: ícono de chat
            return;
        }

        var url = avatar.dataset.base + '/sofia.' + AVATAR_EXTS[avatarTry++];
        var probe = new Image();

        probe.onload = function () { removeBackground(url); };
        probe.onerror = loadAvatar;
        probe.src = url;
    }

    loadAvatar();

    /* la cabeza se inclina hacia donde está el mouse */
    if (!reduceMotion && finePointer) {
        var ticking = false;
        var lastEvent = null;

        document.addEventListener('mousemove', function (event) {
            lastEvent = event;

            if (ticking) { return; }
            ticking = true;

            window.requestAnimationFrame(function () {
                ticking = false;
                if (!lastEvent || !panel.hidden) { return; }

                var rect = toggleBtn.getBoundingClientRect();
                var cx = rect.left + rect.width / 2;
                var cy = rect.top + rect.height / 2;

                var dx = Math.max(-1, Math.min(1, (lastEvent.clientX - cx) / (window.innerWidth / 2)));
                var dy = Math.max(-1, Math.min(1, (lastEvent.clientY - cy) / (window.innerHeight / 2)));

                follow.style.setProperty('--sofia-ry', (dx * 22).toFixed(1) + 'deg');
                follow.style.setProperty('--sofia-rx', (-dy * 12).toFixed(1) + 'deg');
            });
        });

        document.addEventListener('mouseleave', function () {
            follow.style.setProperty('--sofia-ry', '0deg');
            follow.style.setProperty('--sofia-rx', '0deg');
        });
    }

    /* saltitos ansiosos + globo de invitación cada cierto tiempo */
    var TEASERS = [
        '¡Hola! Soy SOFIA 👋',
        '¿Dudas sobre MINERSCAN? ¡Pregúntame!',
        '¡Estoy lista para ayudarte! ⛏️'
    ];
    var teaserIndex = 0;
    var teaserTimer = null;

    function goAnxious() {
        if (reduceMotion || !panel.hidden || document.hidden) { return; }

        toggleBtn.classList.remove('sofia-anxious');
        void toggleBtn.offsetWidth; // reinicia la animación
        toggleBtn.classList.add('sofia-anxious');

        window.setTimeout(function () {
            toggleBtn.classList.remove('sofia-anxious');
        }, 1800);
    }

    function showTeaser() {
        if (!panel.hidden || document.hidden) { return; }

        teaser.textContent = TEASERS[teaserIndex % TEASERS.length];
        teaserIndex++;
        teaser.classList.add('is-visible');

        window.clearTimeout(teaserTimer);
        teaserTimer = window.setTimeout(hideTeaser, 5500);
    }

    function scheduleAttention(delay) {
        window.setTimeout(function () {
            goAnxious();
            showTeaser();
            scheduleAttention(22000 + Math.random() * 14000);
        }, delay);
    }

    scheduleAttention(3500);

    /* ---------- inicio ---------- */

    restoreMessages();

    if (storeGet(STORE_OPEN) === '1') {
        setOpen(true);
    }
})();
</script>
@endverbatim