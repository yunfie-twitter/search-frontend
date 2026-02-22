const API_ENDPOINT = 'https://api.p2pear.asia/search';

const app = {
    refs: {
        input: document.getElementById('searchInput'),
        boxWrap: document.getElementById('searchBoxWrap'),
        suggestList: document.getElementById('suggestList'),
        micBtn: document.getElementById('micBtn'),
        clearBtn: document.getElementById('clearBtn'),
        backBtn: document.getElementById('mobileBackBtn'),
        container: document.querySelector('.search-container')
    },
    delayTimer: null,
    activeIndex: -1,
    suggestions: [],

    init() {
        this.setupEvents();
        this.setupVoiceInput();
    },

    setupEvents() {
        const { input, boxWrap, backBtn, clearBtn } = this.refs;
        if (!input) return;

        input.addEventListener('input', (e) => {
            this.toggleClearBtn();
            clearTimeout(this.delayTimer);
            const val = e.target.value.trim();
            this.delayTimer = setTimeout(() => this.fetchSuggestions(val), 150);
        });

        // フォーカス時
        input.addEventListener('focus', () => {
            boxWrap.classList.add('active');
            
            if (window.matchMedia("(max-width: 600px)").matches) {
                document.body.classList.add('mobile-search-active');
            }

            const val = input.value.trim();
            if (val) {
                this.fetchSuggestions(val);
            } else {
                boxWrap.classList.remove('has-suggestions');
                this.refs.suggestList.innerHTML = '';
            }
        });

        input.addEventListener('keydown', (e) => {
            const len = this.suggestions.length;
            if (len === 0) return;

            if (e.key === 'ArrowDown') {
                e.preventDefault();
                this.activeIndex = (this.activeIndex + 1) % len;
                this.updateActiveHighlight();
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                this.activeIndex = (this.activeIndex - 1 + len) % len;
                this.updateActiveHighlight();
            } else if (e.key === 'Enter') {
                e.preventDefault();
                const val = this.activeIndex >= 0 ? this.suggestions[this.activeIndex].text : input.value.trim();
                if (val) this.performSearch(val);
            }
        });

        if (clearBtn) clearBtn.addEventListener('click', () => {
            input.value = '';
            this.toggleClearBtn();
            input.focus();
            this.renderSuggestions([]);
        });

        if (backBtn) backBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            this.closeSearch();
        });

        document.addEventListener('click', (e) => {
            const isMobile = document.body.classList.contains('mobile-search-active');
            if (!this.refs.container.contains(e.target) && !isMobile) {
                this.closeSearch();
            }
        });
    },

    closeSearch() {
        document.body.classList.remove('mobile-search-active');
        this.refs.boxWrap.classList.remove('active');
        this.refs.boxWrap.classList.remove('has-suggestions');
        this.activeIndex = -1;
    },

    performSearch(query) {
        if(!query) return;
        location.href = `search?q=${encodeURIComponent(query)}`;
    },

    toggleClearBtn() {
        this.refs.boxWrap.classList.toggle('has-value', this.refs.input.value.length > 0);
    },

    setupVoiceInput() {
        const { micBtn, input } = this.refs;
        if (!micBtn) return;
        
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) { micBtn.style.display = 'none'; return; }

        const recognition = new SpeechRecognition();
        recognition.lang = 'ja-JP';
        recognition.interimResults = false;

        recognition.onstart = () => { micBtn.style.color = '#1a73e8'; input.placeholder = "お話しください..."; };
        recognition.onend = () => { micBtn.style.color = ''; input.placeholder = "検索または URL を入力"; };
        recognition.onresult = (e) => {
            const t = e.results[0][0].transcript;
            if (t) {
                input.value = t;
                this.toggleClearBtn();
                this.fetchSuggestions(t);
                input.focus();
            }
        };

        micBtn.addEventListener('click', () => {
            try { recognition.start(); } catch(e) { recognition.stop(); }
        });
    },

    async fetchSuggestions(q) {
        if (!q) { 
            this.suggestions = []; 
            this.renderSuggestions([]); 
            return; 
        }

        try {
            const res = await fetch(`${API_ENDPOINT}?q=${encodeURIComponent(q)}&type=suggest`);
            const data = await res.json();
            let list = data.suggestions || data.results || [];
            
            this.suggestions = list.slice(0, 10).map(item => ({
                text: typeof item === 'string' ? item : (item.term || item.title || item.value || JSON.stringify(item))
            }));

            this.activeIndex = -1;
            this.renderSuggestions(this.suggestions, q);
        } catch (err) {
            console.error(err);
            this.suggestions = [];
            this.renderSuggestions([]);
        }
    },

    renderSuggestions(list, highlight = '') {
        const { suggestList, boxWrap } = this.refs;
        if (!suggestList) return;

        if (!list.length) {
            suggestList.innerHTML = '';
            boxWrap.classList.remove('has-suggestions');
            return;
        }

        boxWrap.classList.add('has-suggestions');

        const escapeReg = (s) => s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        const searchIconSvg = `
        <svg viewBox="0 0 24 24">
            <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
        </svg>`;

        const html = list.map((item, i) => {
            let text = item.text;
            if (highlight) {
                const reg = new RegExp(`(${escapeReg(highlight)})`, 'gi');
                text = text.replace(reg, '<strong>$1</strong>');
            }
            
            return `
            <div class="suggest-item" data-index="${i}">
                ${searchIconSvg}
                <span>${text}</span>
            </div>`;
        }).join('');

        suggestList.innerHTML = html;

        suggestList.querySelectorAll('.suggest-item').forEach(el => {
            el.addEventListener('click', () => {
                const idx = el.getAttribute('data-index');
                const val = this.suggestions[idx].text;
                this.performSearch(val);
            });
            el.addEventListener('mouseenter', () => {
                this.activeIndex = parseInt(el.getAttribute('data-index'));
                this.updateActiveHighlight();
            });
        });
    },

    updateActiveHighlight() {
        const items = this.refs.suggestList.querySelectorAll('.suggest-item');
        items.forEach((el, i) => {
            if (i === this.activeIndex) el.classList.add('active');
            else el.classList.remove('active');
        });
    }
};

document.addEventListener('DOMContentLoaded', () => app.init());