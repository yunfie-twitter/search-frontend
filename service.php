<?php
// service.php
?><!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Services | wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & SplitType & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* Page-specific small additions (keeps about.css as-is) */
.service-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;margin-top:18px}
@media (max-width: 860px){.service-grid{grid-template-columns:1fr}}
.service-card{border:1px solid rgba(255,255,255,.10);background:rgba(255,255,255,.04);backdrop-filter:blur(8px);border-radius:16px;padding:18px;transition:transform .2s ease,border-color .2s ease,background .2s ease}
.service-card:hover{transform:translateY(-2px);border-color:rgba(26,115,232,.35);background:rgba(26,115,232,.06)}
.service-head{display:flex;align-items:center;justify-content:space-between;gap:12px}
.service-title{font-size:1.05rem;letter-spacing:.02em;margin:0}
.service-badge{font-size:.78rem;color:rgba(255,255,255,.7);border:1px solid rgba(255,255,255,.14);padding:4px 10px;border-radius:999px;white-space:nowrap}
.service-desc{margin:10px 0 0;color:rgba(255,255,255,.78);line-height:1.75}
.service-link{display:inline-flex;align-items:center;gap:8px;margin-top:14px;text-decoration:none}
.service-link svg{width:18px;height:18px;fill:currentColor;opacity:.9}
.section-note{margin-top:10px;color:rgba(255,255,255,.65);line-height:1.8}
</style>
</head>
<body>

<!-- Very subtle ambient light -->
<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(26,115,232,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="https://wholphin.net/" class="brand-logo">wholphin</a>
    <a href="/" class="back-btn">検索を始める</a>
</nav>

<!-- Hero -->
<section class="hero">
    <span class="hero-sub">Services</span>

    <h1 class="hero-title scroll-fade">
        <span class="hero-line-1">提供サービス</span>
        <span class="hero-line-2">一覧</span>
    </h1>

    <p class="hero-desc">
        wholphin が提供しているサービスと、提携サービスのリンクです。<br>
        クリックすると各サービスへ移動します。
    </p>

    <div class="hero-search-area">
        <div class="search-wrapper">
            <div class="search-box-wrap" id="searchBoxWrap">
                <svg class="search-icon-left" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                <input type="text" id="searchInput" class="search-input" placeholder="検索または URL を入力" autocomplete="off">
                <div class="action-btn-area">
                    <div id="micBtn" class="icon-btn mic-btn" title="音声検索">
                        <svg viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
                    </div>
                    <div id="clearBtn" class="icon-btn clear-btn" tabindex="-1">
                        <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                    </div>
                </div>
                <div class="suggest-list" id="suggestList"></div>
            </div>
        </div>
    </div>
</section>

<!-- Services -->
<section class="promise">
    <div class="promise-head">
        <span class="section-label">wholphin Services</span>
        <div class="section-note">検索 / フロントエンド / 関連プロジェクトの入口をまとめています。</div>
    </div>

    <div class="service-grid">
        <article class="service-card">
            <div class="service-head">
                <h3 class="service-title">wholphin 検索</h3>
                <span class="service-badge">Search</span>
            </div>
            <p class="service-desc">ノイズのない検索体験を提供する、wholphin の検索サービスです。</p>
            <a class="footer-link service-link" href="https://wholphin.net/" target="_blank" rel="noopener noreferrer">開く
                <svg viewBox="0 0 24 24"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h6V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-6h-2v6H5V5z"/></svg>
            </a>
        </article>

        <article class="service-card">
            <div class="service-head">
                <h3 class="service-title">PixivFE (Fork)</h3>
                <span class="service-badge">Frontend</span>
            </div>
            <p class="service-desc">Pixiv を快適に閲覧するためのフロントエンド (Fork) です。</p>
            <a class="footer-link service-link" href="https://pixiv.wholphin.net/" target="_blank" rel="noopener noreferrer">開く
                <svg viewBox="0 0 24 24"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h6V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-6h-2v6H5V5z"/></svg>
            </a>
        </article>
    </div>
</section>

<section class="promise">
    <div class="promise-head">
        <span class="section-label">Partner Services</span>
        <div class="section-note">提携サービス (外部サイト) です。</div>
    </div>

    <div class="service-grid">
        <article class="service-card">
            <div class="service-head">
                <h3 class="service-title">NovaFeed</h3>
                <span class="service-badge">Partner</span>
            </div>
            <p class="service-desc">提携サービス: NovaFeed</p>
            <a class="footer-link service-link" href="https://p2pear.asia" target="_blank" rel="noopener noreferrer">開く
                <svg viewBox="0 0 24 24"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h6V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-6h-2v6H5V5z"/></svg>
            </a>
        </article>

        <article class="service-card">
            <div class="service-head">
                <h3 class="service-title">Voclis Social</h3>
                <span class="service-badge">Partner</span>
            </div>
            <p class="service-desc">提携サービス: Voclis Social</p>
            <a class="footer-link service-link" href="https://pjsekai.world" target="_blank" rel="noopener noreferrer">開く
                <svg viewBox="0 0 24 24"><path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"/><path d="M5 5h6V3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2v-6h-2v6H5V5z"/></svg>
            </a>
        </article>

        <article class="service-card">
            <div class="service-head">
                <h3 class="service-title">Noctella Network</h3>
                <span class="service-badge">Partner</span>
            </div>
            <p class="service-desc">提携サービス: Noctella Network</p>
            <span class="service-badge" style="opacity:.7">URL 未設定</span>
        </article>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="cta-box">
        <div class="cta-content">
            <h2 class="cta-head">Ready to Dive?</h2>
            <p class="cta-sub">ノイズのない世界へ。</p>
        </div>
        <a href="index.php" class="cta-btn">検索を始める</a>
    </div>
</section>

<footer class="app-footer">
    <div class="footer-inner">
        <div class="footer-links">
            <a href="/help" class="footer-link">ヘルプ</a>
            <a href="/privacy" class="footer-link">プライバシー</a>
            <a href="/terms" class="footer-link">利用規約</a>
        </div>
        <div class="copyright">© 2026 wholphin</div>
    </div>
</footer>

<script>
gsap.registerPlugin(ScrollTrigger);

// --- Lenis Setup (GSAP ticker sync) ---
const lenis = new Lenis({
  smooth: true,
  lerp: 0.08
});
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

// --- Deep Dive (ScrollTrigger) ---
gsap.to(".hero-line-1", {
  opacity: 0.15,
  y: 20,
  filter: "blur(4px)",
  ease: "none",
  scrollTrigger: {
    trigger: ".hero",
    start: "top top",
    end: "bottom top",
    scrub: true
  }
});

gsap.to(".hero-line-2", {
  opacity: 0.15,
  y: 40,
  filter: "blur(6px)",
  ease: "none",
  scrollTrigger: {
    trigger: ".hero",
    start: "top top",
    end: "bottom top",
    scrub: true
  }
});

// --- Simple Promise Reveal ---
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.2 });

document.querySelectorAll('.promise-item, .service-card').forEach(el => observer.observe(el));

// --- Search Logic (Standard) ---
const API_ENDPOINT = 'https://api.p2pear.asia/search';
const app = {
    state: { suggestions: [], suggestIndex: -1, isListening: false },
    refs: {
        input: document.getElementById('searchInput'),
        boxWrap: document.getElementById('searchBoxWrap'),
        suggestList: document.getElementById('suggestList'),
        micBtn: document.getElementById('micBtn'),
        clearBtn: document.getElementById('clearBtn')
    },
    init() {
        if(!this.refs.input) return;
        this.setupEvents();
        this.setupVoice();
    },
    setupEvents() {
        this.refs.input.addEventListener('input', (e) => {
            this.toggleClearBtn();
            this.handleInput(e);
        });
        // FIX: Focus時にも値があればサジェストを表示
        this.refs.input.addEventListener('focus', () => {
            this.refs.boxWrap.classList.add('active');
            const val = this.refs.input.value.trim();
            if (val) {
                this.fetchSuggestions(val);
            }
        });
        this.refs.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (this.state.suggestIndex >= 0 && this.state.suggestions[this.state.suggestIndex]) {
                    this.selectSuggest(this.state.suggestIndex);
                } else if (this.isUrlLike(this.refs.input.value)) {
                    this.goUrl(this.normalizeUrl(this.refs.input.value));
                } else {
                    this.goSearch(this.refs.input.value);
                }
            } else if (e.key === 'ArrowDown') {
                e.preventDefault(); this.navigateSuggest(1);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault(); this.navigateSuggest(-1);
            }
        });
        this.refs.clearBtn.addEventListener('click', () => {
            this.refs.input.value = ''; this.refs.input.focus();
            this.toggleClearBtn(); this.closeSuggest();
        });
        document.addEventListener('click', (e) => {
            if (this.refs.boxWrap && !this.refs.boxWrap.contains(e.target)) {
                this.closeSuggest();
            }
        });
        this.refs.input.addEventListener('blur', () => {
            setTimeout(() => { if(!this.refs.suggestList.innerHTML) this.refs.boxWrap.classList.remove('active'); }, 200);
        });
    },
    setupVoice() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) { if(this.refs.micBtn) this.refs.micBtn.style.display = 'none'; return; }
        const recognition = new SpeechRecognition();
        recognition.lang = 'ja-JP'; recognition.interimResults = false;
        recognition.onstart = () => { this.state.isListening = true; this.refs.micBtn.classList.add('listening'); this.refs.input.placeholder = "お話しください..."; };
        recognition.onend = () => { this.state.isListening = false; this.refs.micBtn.classList.remove('listening'); this.refs.input.placeholder = "検索または URL を入力"; };
        recognition.onresult = (e) => { const text = e.results[0][0].transcript; if (text) { this.refs.input.value = text; this.goSearch(text); } };
        this.refs.micBtn.addEventListener('click', () => { if (this.state.isListening) recognition.stop(); else recognition.start(); });
    },
    toggleClearBtn() { const hasVal = this.refs.input.value.length > 0; this.refs.boxWrap.classList.toggle('has-value', hasVal); },
    isUrlLike(str) { if (!str) return false; const s = str.trim(); const hasProtocol = /^https?:\/\//i.test(s); const hasDomain = /^[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}(\/.*)?$/.test(s); return (hasProtocol || hasDomain) && !s.includes(' '); },
    normalizeUrl(str) { let url = str.trim(); if (!/^https?:\/\//i.test(url)) { url = 'http://' + url; } return url; },
    handleInput(e) { const val = e.target.value.trim(); if (!val) { this.closeSuggest(); return; } clearTimeout(this.suggestTimer); this.suggestTimer = setTimeout(() => this.fetchSuggestions(val), 200); },
    async fetchSuggestions(q) {
        try {
            const res = await fetch(`${API_ENDPOINT}?q=${encodeURIComponent(q)}&type=suggest`);
            const data = await res.json();
            let apiList = [];
            if (Array.isArray(data.results)) apiList = data.results;
            else if (Array.isArray(data)) apiList = data;
            else if (data.suggestions) apiList = data.suggestions;
            else if (typeof data === 'object') { for (const k in data) { if (Array.isArray(data[k])) { apiList = data[k]; break; } } }
            let finalList = [];
            if (this.isUrlLike(q)) { finalList.push({ type: 'url', value: this.normalizeUrl(q), display: q }); }
            finalList = finalList.concat(apiList);
            this.state.suggestions = finalList; this.renderSuggestions(finalList);
        } catch (e) { console.error(e); }
    },
    renderSuggestions(list) {
        if (!list || list.length === 0) { this.closeSuggest(); return; }
        const html = list.map((item, i) => {
            if (typeof item === 'object' && item.type === 'url') {
                return `<div class="suggest-item is-url" data-idx="${i}" onclick="app.selectSuggest(${i})"><svg class="suggest-icon" viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg><span class="suggest-text">${item.display} に移動</span></div>`;
            }
            const text = typeof item === 'string' ? item : (item.title || item.term || Object.values(item)[0]);
            return `<div class="suggest-item" data-idx="${i}" onclick="app.selectSuggest(${i})"><svg class="suggest-icon" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg><span class="suggest-text">${text}</span></div>`;
        }).join('');
        this.refs.suggestList.innerHTML = html; this.refs.boxWrap.classList.add('active'); this.state.suggestIndex = -1;
    },
    navigateSuggest(dir) {
        const items = document.querySelectorAll('.suggest-item'); if (items.length === 0) return;
        this.state.suggestIndex += dir;
        if (this.state.suggestIndex < -1) this.state.suggestIndex = items.length - 1;
        if (this.state.suggestIndex >= items.length) this.state.suggestIndex = -1;
        items.forEach(el => el.classList.remove('selected'));
        if (this.state.suggestIndex >= 0) {
            const el = items[this.state.suggestIndex]; el.classList.add('selected');
            const item = this.state.suggestions[this.state.suggestIndex];
            if (typeof item === 'object' && item.type === 'url') { this.refs.input.value = item.display; } else { this.refs.input.value = el.querySelector('.suggest-text').textContent; }
        }
    },
    selectSuggest(idx) {
        const item = this.state.suggestions[idx];
        if (typeof item === 'object' && item.type === 'url') { this.goUrl(item.value); } else { const text = typeof item === 'string' ? item : (item.title || item.term || Object.values(item)[0]); this.goSearch(text); }
    },
    closeSuggest() { this.refs.boxWrap.classList.remove('active'); this.refs.suggestList.innerHTML = ''; this.state.suggestIndex = -1; },
    goUrl(url) { window.location.href = url; },
    goSearch(query) { if (!query.trim()) return; window.location.href = `search?q=${encodeURIComponent(query)}`; }
};
app.init();

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});
</script>

</body>
</html>
