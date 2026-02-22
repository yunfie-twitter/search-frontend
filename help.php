<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>ヘルプ - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* ヘルプページ専用スタイル */
.help-hero {
    min-height: 40vh;
    padding-top: 120px;
    padding-bottom: 60px;
}

.help-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.1s forwards;
}

.help-hero .hero-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.2s forwards;
}

.help-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 640px;
    line-height: 1.8;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.3s forwards;
}

.help-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.help-section {
    margin-bottom: 56px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
}

.help-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.help-section h2 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    position: relative;
    padding-left: 16px;
}

.help-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 4px;
    width: 4px;
    height: 26px;
    background: var(--primary);
    border-radius: 2px;
}

.help-section h3 {
    font-size: 20px;
    font-weight: 600;
    margin-bottom: 16px;
    margin-top: 32px;
    color: var(--text-main);
}

.help-section p {
    font-size: 15px;
    line-height: 1.85;
    color: var(--text-main);
    margin-bottom: 16px;
}

.help-section ul {
    list-style: none;
    padding-left: 0;
    margin-bottom: 20px;
}

.help-section ul li {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    padding-left: 28px;
    margin-bottom: 12px;
    position: relative;
}

.help-section ul li::before {
    content: '•';
    position: absolute;
    left: 10px;
    color: var(--primary);
    font-weight: bold;
    font-size: 18px;
}

/* FAQ アイテム */
.faq-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 24px 28px;
    margin-bottom: 16px;
    transition: box-shadow 0.2s, border-color 0.2s;
}

.faq-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
    border-color: var(--border);
}

.faq-question {
    font-size: 17px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 12px;
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.faq-question::before {
    content: 'Q';
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    font-size: 14px;
    font-weight: 700;
    flex-shrink: 0;
}

.faq-answer {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    padding-left: 40px;
}

/* 検索タブの説明 */
.tab-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 24px;
}

.tab-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 24px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.tab-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
}

.tab-icon {
    width: 40px;
    height: 40px;
    background: rgba(26, 115, 232, 0.1);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
    font-size: 20px;
}

.tab-name {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 8px;
}

.tab-desc {
    font-size: 14px;
    line-height: 1.7;
    color: var(--text-sub);
}

/* ヒント・注意書き */
.help-tip {
    background: rgba(26, 115, 232, 0.08);
    border-left: 3px solid var(--primary);
    padding: 20px 24px;
    border-radius: 8px;
    margin: 24px 0;
}

.help-tip p {
    margin-bottom: 0;
    font-size: 14px;
    line-height: 1.8;
}

.help-tip strong {
    color: var(--primary);
}

/* キーボードショートカット */
.shortcut-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 16px;
    margin-top: 20px;
}

.shortcut-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 12px 16px;
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 8px;
}

.shortcut-key {
    font-family: 'Courier New', monospace;
    font-size: 13px;
    font-weight: 600;
    background: var(--bg-base);
    padding: 4px 10px;
    border-radius: 4px;
    border: 1px solid var(--border);
    color: var(--text-main);
}

.shortcut-desc {
    font-size: 14px;
    color: var(--text-sub);
}

@media (max-width: 600px) {
    .help-hero .hero-title {
        font-size: 36px;
    }
    
    .help-section h2 {
        font-size: 22px;
    }
    
    .tab-grid {
        grid-template-columns: 1fr;
    }
    
    .shortcut-list {
        grid-template-columns: 1fr;
    }
    
    .faq-answer {
        padding-left: 0;
        margin-top: 8px;
    }
}

@media (prefers-color-scheme: dark) {
    .faq-item:hover,
    .tab-card:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
    }
    
    .help-tip {
        background: rgba(138, 180, 248, 0.08);
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(26,115,232,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="index.php" class="brand-logo">wholphin</a>
    <a href="index.php" class="back-btn">検索を始める</a>
</nav>

<!-- Hero -->
<section class="hero help-hero">
    <span class="hero-sub">Help & FAQ</span>
    
    <h1 class="hero-title">ヘルプ</h1>
    
    <p class="hero-desc">
        wholphin の使い方や、よくある質問への回答をまとめています。<br>
        不明な点がございましたら、お気軽にお問い合わせください。
    </p>
</section>

<!-- Help Content -->
<div class="help-content">
    <div class="help-section">
        <h2>基本的な使い方</h2>
        
        <h3>検索の実行</h3>
        <p>検索ボックスにキーワードを入力して Enter キーを押すか、検索ボタンをクリックしてください。複数のキーワードをスペースで区切ることで、より精密な検索が可能です。</p>
        
        <h3>URL の直接入力</h3>
        <p>検索ボックスに URL を入力すると、そのサイトへ直接移動できます。「http://」や「https://」は省略可能です。</p>
        
        <h3>音声検索</h3>
        <p>マイクアイコンをクリックすると、音声で検索キーワードを入力できます。（ブラウザが対応している場合のみ）</p>
        
        <div class="help-tip">
            <p><strong>ヒント：</strong> 検索候補（サジェスト）は矢印キー（↑↓）で選択し、Enter で確定できます。</p>
        </div>
    </div>

    <div class="help-section">
        <h2>検索タブの種類</h2>
        <p>wholphin では、以下の検索タブを提供しています。</p>
        
        <div class="tab-grid">
            <div class="tab-card">
                <div class="tab-icon">🌐</div>
                <div class="tab-name">すべて</div>
                <div class="tab-desc">ウェブ全体から総合的に検索します。最も幅広い結果が得られます。</div>
            </div>
            
            <div class="tab-card">
                <div class="tab-icon">📰</div>
                <div class="tab-name">ニュース</div>
                <div class="tab-desc">最新のニュース記事を検索します。時事情報をお探しの際に便利です。</div>
            </div>
            
            <div class="tab-card">
                <div class="tab-icon">🎬</div>
                <div class="tab-name">動画</div>
                <div class="tab-desc">YouTube などの動画コンテンツを検索します。埋め込みプレビューも可能です。</div>
            </div>
            
            <div class="tab-card">
                <div class="tab-icon">🖼️</div>
                <div class="tab-name">画像</div>
                <div class="tab-desc">画像検索に特化したタブです。ビジュアル情報を探す際に最適です。</div>
            </div>
            
            <div class="tab-card">
                <div class="tab-icon">💬</div>
                <div class="tab-name">ソーシャル</div>
                <div class="tab-desc">Fediverse（分散型SNS）の投稿を検索します。Mastodon、Misskey などの投稿が対象です。</div>
            </div>
        </div>
    </div>

    <div class="help-section">
        <h2>検索のコツ</h2>
        <ul>
            <li><strong>複数キーワード：</strong> スペースで区切ることで、より詳細な検索ができます（例：「東京 カフェ おすすめ」）</li>
            <li><strong>完全一致：</strong> 引用符で囲むと、フレーズ全体での検索になります（例：「"プライバシー保護"」）</li>
            <li><strong>除外キーワード：</strong> マイナス記号で特定のキーワードを除外できます（例：「レシピ -広告」）</li>
            <li><strong>サイト指定：</strong> 「site:」を使って特定サイト内を検索できます（例：「site:example.com キーワード」）</li>
        </ul>
    </div>

    <div class="help-section">
        <h2>よくある質問</h2>
        
        <div class="faq-item">
            <div class="faq-question">wholphin は無料で使えますか？</div>
            <div class="faq-answer">はい、wholphin は完全無料でご利用いただけます。アカウント登録も不要です。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">検索履歴は保存されますか？</div>
            <div class="faq-answer">いいえ、wholphin はユーザーの検索履歴を保存しません。プライバシー保護を最優先に設計されています。詳しくは<a href="privacy.php" style="color: var(--primary); text-decoration: none; font-weight: 600;">プライバシーポリシー</a>をご覧ください。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">検索結果が表示されない場合は？</div>
            <div class="faq-answer">ネットワーク接続を確認し、ページを再読み込みしてください。それでも解決しない場合は、キーワードを変更するか、別のタブ（ニュース、画像など）で試してみてください。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">音声検索が使えません</div>
            <div class="faq-answer">音声検索はブラウザの機能に依存しています。Chrome、Edge、Safari の最新版をお使いください。また、マイクのアクセス許可が必要です。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">外部サイトのリンクは安全ですか？</div>
            <div class="faq-answer">検索結果には外部サイトへのリンクが含まれますが、リンク先の内容について wholphin は保証しません。リンクをクリックする際は、各サイトの信頼性を自己責任でご判断ください。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">広告は表示されますか？</div>
            <div class="faq-answer">wholphin は広告を一切表示しません。検索結果の順位も広告によって操作されることはありません。</div>
        </div>
        
        <div class="faq-item">
            <div class="faq-question">モバイルでも使えますか？</div>
            <div class="faq-answer">はい、wholphin はスマートフォンやタブレットにも完全対応しています。レスポンシブデザインで、どのデバイスでも快適にご利用いただけます。</div>
        </div>
    </div>

    <div class="help-section">
        <h2>キーボードショートカット</h2>
        <p>検索をより効率的に行うためのショートカットキーです。</p>
        
        <div class="shortcut-list">
            <div class="shortcut-item">
                <span class="shortcut-desc">検索ボックスにフォーカス</span>
                <span class="shortcut-key">/</span>
            </div>
            
            <div class="shortcut-item">
                <span class="shortcut-desc">候補を下に移動</span>
                <span class="shortcut-key">↓</span>
            </div>
            
            <div class="shortcut-item">
                <span class="shortcut-desc">候補を上に移動</span>
                <span class="shortcut-key">↑</span>
            </div>
            
            <div class="shortcut-item">
                <span class="shortcut-desc">検索実行 / 候補確定</span>
                <span class="shortcut-key">Enter</span>
            </div>
            
            <div class="shortcut-item">
                <span class="shortcut-desc">入力クリア</span>
                <span class="shortcut-key">Esc</span>
            </div>
        </div>
    </div>

    <div class="help-section">
        <h2>お問い合わせ</h2>
        <p>その他のご質問やフィードバックは、以下の連絡先までお気軽にお寄せください。</p>
        <p style="margin-top: 20px;">
            <strong>メールアドレス：</strong> <a href="mailto:privacy@wholphin.net" style="color: var(--primary); text-decoration: none;">privacy@wholphin.net</a><br>
            <strong>運営：</strong> wholphin 開発チーム
        </p>
        
        <div class="help-tip" style="margin-top: 28px;">
            <p><strong>関連ページ：</strong> <a href="about.php" style="color: var(--primary); text-decoration: none; font-weight: 600;">About</a> | <a href="privacy.php" style="color: var(--primary); text-decoration: none; font-weight: 600;">プライバシーポリシー</a> | <a href="terms.php" style="color: var(--primary); text-decoration: none; font-weight: 600;">利用規約</a></p>
        </div>
    </div>
</div>

<footer class="app-footer">
    <div class="footer-inner">
        <div class="footer-links">
            <a href="about.php" class="footer-link">About</a>
            <a href="help.php" class="footer-link">ヘルプ</a>
            <a href="privacy.php" class="footer-link">プライバシー</a>
            <a href="terms.php" class="footer-link">利用規約</a>
        </div>
        <div class="copyright">© 2026 wholphin</div>
    </div>
</footer>

<script>
gsap.registerPlugin(ScrollTrigger);

// --- Lenis Setup ---
const lenis = new Lenis({
  smooth: true,
  lerp: 0.08
});
lenis.on('scroll', ScrollTrigger.update);
gsap.ticker.add((time) => {
  lenis.raf(time * 1000);
});
gsap.ticker.lagSmoothing(0);

// --- Section Reveal on Scroll ---
const sections = document.querySelectorAll('.help-section');
const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

sections.forEach(section => sectionObserver.observe(section));

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
window.addEventListener('scroll', () => {
    if (window.scrollY > 20) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// --- Keyboard Shortcut: Focus Search (/) ---
document.addEventListener('keydown', (e) => {
    if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
        e.preventDefault();
        window.location.href = 'index.php';
    }
});
</script>

</body>
</html>