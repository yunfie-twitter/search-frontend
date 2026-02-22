<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>About wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & SplitType & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/split-type"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

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
    <span class="hero-sub">Concept</span>
    
    <h1 class="hero-title scroll-fade">
        <span class="hero-line-1">深く　静かに</span>
        <span class="hero-line-2">透明な検索</span>
    </h1>
    
    <p class="hero-desc">
        ノイズのない純粋な情報を、あるがままに。<br>
        wholphinは、あなたの思考を妨げない検索エンジンです。
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

<!-- Promises -->
<section class="promise">
    <div class="promise-head">
        <span class="section-label">Features</span>
    </div>

    <div class="promise-list">
        <div class="promise-item visible" style="animation-delay: 0s;">
            <div class="promise-icon">
                <svg viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/></svg>
            </div>
            <div class="promise-content">
                <h3 class="promise-title">透明性</h3>
                <p class="promise-text">広告による順位操作は一切ありません。アルゴリズムが導き出した情報源を、そのまま表示します。</p>
            </div>
        </div>
        <div class="promise-item visible" style="animation-delay: 0.1s;">
            <div class="promise-icon">
                <svg viewBox="0 0 24 24"><path d="M15 4v7H5.17l-.59.59-.58.58V4h11m1-2H3c-.55 0-1 .45-1 1v14l4-4h10c.55 0 1-.45 1-1V3c0-.55-.45-1-1-1zm5 4h-2v9H6v2c0 .55.45 1 1 1h11l4 4V7c0-.55-.45-1-1-1z"/></svg>
            </div>
            <div class="promise-content">
                <h3 class="promise-title">文脈理解</h3>
                <p class="promise-text">キーワードの一致だけでなく、クエリの意図を解析。あなたが本当に探している答えに近づきます。</p>
            </div>
        </div>
        <div class="promise-item visible" style="animation-delay: 0.2s;">
            <div class="promise-icon">
                <svg viewBox="0 0 24 24"><path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
            </div>
            <div class="promise-content">
                <h3 class="promise-title">非追跡</h3>
                <p class="promise-text">検索履歴を保存せず、あなたを追跡しません。ブラウザを閉じれば、すべては波に消えます。</p>
            </div>
        </div>
    </div>
</section>

<!-- Philosophy (GSAP Trigger) -->
<section class="philosophy">
    <div class="philo-text">
        音のない深海のように。<br>
        検索体験を、もっと美しく。
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

// --- Philosophy (SplitType + ScrollTrigger) ---
const text = new SplitType('.philo-text', { types: 'lines' });

gsap.from(text.lines, {
  opacity: 0,
  y: 16,
  filter: "blur(2px)",
  stagger: 0.25,
  ease: "power2.out",
  scrollTrigger: {
    trigger: '.philosophy',
    start: 'top 80%'
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

document.querySelectorAll('.promise-item').forEach(el => observer.observe(el));

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