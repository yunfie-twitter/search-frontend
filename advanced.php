<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>高度な検索 - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* Advanced Search Specific Styles */
.advanced-form {
    max-width: 600px;
    margin: 0 auto;
}

.form-group {
    margin-bottom: 32px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) forwards;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group:nth-child(5) { animation-delay: 0.5s; }
.form-group:nth-child(6) { animation-delay: 0.6s; }
.form-group:nth-child(7) { animation-delay: 0.7s; }

.form-label {
    display: block;
    font-size: 14px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 8px;
}

.form-hint {
    display: block;
    font-size: 12px;
    color: var(--text-sub);
    margin-top: 4px;
}

.form-input {
    width: 100%;
    height: 48px;
    padding: 0 16px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--bg-surface);
    color: var(--text-main);
    font-size: 15px;
    font-family: inherit;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
}

.form-select {
    width: 100%;
    height: 48px;
    padding: 0 16px;
    border: 1px solid var(--border);
    border-radius: 12px;
    background: var(--bg-surface);
    color: var(--text-main);
    font-size: 15px;
    font-family: inherit;
    cursor: pointer;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.form-select:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.1);
}

.form-actions {
    display: flex;
    gap: 16px;
    margin-top: 48px;
}

.btn-primary {
    flex: 1;
    height: 48px;
    padding: 0 32px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: transform 0.2s, opacity 0.2s;
}

.btn-primary:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.btn-secondary {
    height: 48px;
    padding: 0 24px;
    background: transparent;
    color: var(--text-main);
    border: 1px solid var(--border);
    border-radius: 12px;
    font-size: 15px;
    font-weight: 600;
    font-family: inherit;
    cursor: pointer;
    transition: background 0.2s;
}

.btn-secondary:hover {
    background: var(--bg-hover);
}

.examples-section {
    margin-top: 60px;
    padding: 32px;
    background: var(--bg-cta);
    border-radius: 16px;
}

.examples-title {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 16px;
    color: var(--text-main);
}

.example-item {
    margin-bottom: 12px;
    padding: 12px;
    background: var(--bg-surface);
    border-radius: 8px;
    font-size: 13px;
    color: var(--text-sub);
}

.example-operator {
    font-family: monospace;
    color: var(--primary);
    font-weight: 600;
}

@media (max-width: 600px) {
    .form-actions {
        flex-direction: column;
    }
    
    .btn-primary, .btn-secondary {
        width: 100%;
    }
}
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
    <span class="hero-sub">Advanced Search</span>
    
    <h1 class="hero-title scroll-fade">
        <span class="hero-line-1">より詳細に</span>
        <span class="hero-line-2">高度な検索</span>
    </h1>
    
    <p class="hero-desc">
        検索条件を細かく指定して、<br>
        あなたが探している情報を正確に見つけましょう。
    </p>
</section>

<!-- Advanced Search Form -->
<section class="promise">
    <div class="promise-head">
        <span class="section-label">Search Filters</span>
    </div>

    <form class="advanced-form" id="advancedForm" method="get" action="search">
        <div class="form-group">
            <label class="form-label" for="allWords">すべてのキーワードを含む</label>
            <input type="text" id="allWords" name="all" class="form-input" placeholder="例: 機械学習 Python">
            <span class="form-hint">入力したすべての単語を含む結果を表示</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="exactPhrase">完全一致フレーズ</label>
            <input type="text" id="exactPhrase" name="exact" class="form-input" placeholder="例: 深層学習入門">
            <span class="form-hint">このフレーズと完全に一致するページを検索</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="anyWords">いずれかのキーワードを含む</label>
            <input type="text" id="anyWords" name="any" class="form-input" placeholder="例: TensorFlow PyTorch Keras">
            <span class="form-hint">入力した単語のいずれかを含む結果を表示</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="excludeWords">除外するキーワード</label>
            <input type="text" id="excludeWords" name="exclude" class="form-input" placeholder="例: 広告 有料">
            <span class="form-hint">これらの単語を含むページを除外</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="site">サイトまたはドメイン</label>
            <input type="text" id="site" name="site" class="form-input" placeholder="例: github.com">
            <span class="form-hint">特定のウェブサイトやドメイン内を検索</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="fileType">ファイルタイプ</label>
            <select id="fileType" name="filetype" class="form-select">
                <option value="">すべてのファイル</option>
                <option value="pdf">PDF (.pdf)</option>
                <option value="doc">Word (.doc, .docx)</option>
                <option value="xls">Excel (.xls, .xlsx)</option>
                <option value="ppt">PowerPoint (.ppt, .pptx)</option>
                <option value="txt">テキスト (.txt)</option>
            </select>
            <span class="form-hint">特定のファイル形式に絞り込み</span>
        </div>

        <div class="form-group">
            <label class="form-label" for="language">言語</label>
            <select id="language" name="lang" class="form-select">
                <option value="">すべての言語</option>
                <option value="ja" selected>日本語</option>
                <option value="en">英語</option>
                <option value="zh">中国語</option>
                <option value="ko">韓国語</option>
                <option value="fr">フランス語</option>
                <option value="de">ドイツ語</option>
                <option value="es">スペイン語</option>
            </select>
            <span class="form-hint">表示言語を指定</span>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">検索</button>
            <button type="button" class="btn-secondary" onclick="document.getElementById('advancedForm').reset();">リセット</button>
        </div>
    </form>

    <!-- Search Operators Examples -->
    <div class="examples-section">
        <h3 class="examples-title">検索演算子の使い方</h3>
        <div class="example-item">
            <span class="example-operator">"完全一致"</span> - ダブルクォートで囲むと完全一致検索
        </div>
        <div class="example-item">
            <span class="example-operator">-除外</span> - マイナスをつけると除外
        </div>
        <div class="example-item">
            <span class="example-operator">site:example.com</span> - 特定サイト内を検索
        </div>
        <div class="example-item">
            <span class="example-operator">filetype:pdf</span> - PDFファイルのみ検索
        </div>
        <div class="example-item">
            <span class="example-operator">OR</span> - いずれかのキーワードで検索(大文字で記述)
        </div>
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

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// --- Form Handling ---
const form = document.getElementById('advancedForm');
form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const allWords = document.getElementById('allWords').value.trim();
    const exactPhrase = document.getElementById('exactPhrase').value.trim();
    const anyWords = document.getElementById('anyWords').value.trim();
    const excludeWords = document.getElementById('excludeWords').value.trim();
    const site = document.getElementById('site').value.trim();
    const fileType = document.getElementById('fileType').value;
    const language = document.getElementById('language').value;
    
    // Build search query
    let query = [];
    
    if (allWords) {
        query.push(allWords);
    }
    
    if (exactPhrase) {
        query.push('"' + exactPhrase + '"');
    }
    
    if (anyWords) {
        const words = anyWords.split(' ').filter(w => w.length > 0);
        if (words.length > 0) {
            query.push('(' + words.join(' OR ') + ')');
        }
    }
    
    if (excludeWords) {
        const words = excludeWords.split(' ').filter(w => w.length > 0);
        words.forEach(word => {
            query.push('-' + word);
        });
    }
    
    if (site) {
        query.push('site:' + site);
    }
    
    if (fileType) {
        query.push('filetype:' + fileType);
    }
    
    const searchQuery = query.join(' ');
    
    if (!searchQuery.trim()) {
        alert('検索条件を入力してください');
        return;
    }
    
    // Build URL with parameters
    let url = 'search?q=' + encodeURIComponent(searchQuery);
    if (language) {
        url += '&lang=' + encodeURIComponent(language);
    }
    
    window.location.href = url;
});
</script>

</body>
</html>