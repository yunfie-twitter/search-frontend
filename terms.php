<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>利用規約 - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* 利用規約専用スタイル */
.terms-hero {
    min-height: 40vh;
    padding-top: 120px;
    padding-bottom: 60px;
}

.terms-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.1s forwards;
}

.terms-hero .hero-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.2s forwards;
}

.terms-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 680px;
    line-height: 1.8;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.3s forwards;
}

.terms-content {
    max-width: 760px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.terms-section {
    margin-bottom: 48px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
}

.terms-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.terms-section h2 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 18px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    position: relative;
    padding-left: 16px;
}

.terms-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 3px;
    width: 4px;
    height: 22px;
    background: var(--primary);
    border-radius: 2px;
}

.terms-section p {
    font-size: 15px;
    line-height: 1.85;
    color: var(--text-main);
    margin-bottom: 16px;
}

.terms-section ol {
    list-style: none;
    counter-reset: terms-counter;
    padding-left: 0;
    margin-bottom: 20px;
}

.terms-section ol li {
    font-size: 15px;
    line-height: 1.85;
    color: var(--text-main);
    padding-left: 32px;
    margin-bottom: 12px;
    position: relative;
    counter-increment: terms-counter;
}

.terms-section ol li::before {
    content: counter(terms-counter) ".";
    position: absolute;
    left: 8px;
    color: var(--primary);
    font-weight: 600;
    font-size: 14px;
}

.terms-section ul {
    list-style: none;
    padding-left: 0;
    margin-bottom: 20px;
    margin-top: 12px;
}

.terms-section ul li {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    padding-left: 28px;
    margin-bottom: 10px;
    position: relative;
}

.terms-section ul li::before {
    content: '•';
    position: absolute;
    left: 10px;
    color: var(--primary);
    font-weight: bold;
    font-size: 18px;
}

.terms-highlight {
    background: rgba(26, 115, 232, 0.08);
    border-left: 3px solid var(--primary);
    padding: 24px 28px;
    border-radius: 8px;
    margin: 28px 0;
}

.terms-highlight p {
    margin-bottom: 0;
    font-weight: 500;
    line-height: 1.8;
}

.terms-note {
    font-size: 14px;
    color: var(--text-sub);
    font-style: italic;
    margin-top: 8px;
    padding-left: 12px;
    border-left: 2px solid var(--border);
}

.terms-definition {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 8px;
    padding: 20px 24px;
    margin: 20px 0;
}

.terms-definition dt {
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 8px;
    font-size: 15px;
}

.terms-definition dd {
    margin-left: 0;
    margin-bottom: 16px;
    color: var(--text-main);
    line-height: 1.8;
    font-size: 15px;
}

.terms-definition dd:last-child {
    margin-bottom: 0;
}

.terms-date {
    font-size: 13px;
    color: var(--text-sub);
    margin-top: 60px;
    padding-top: 24px;
    border-top: 1px solid var(--border-subtle);
}

@media (max-width: 600px) {
    .terms-hero .hero-title {
        font-size: 36px;
    }
    
    .terms-section h2 {
        font-size: 20px;
    }
    
    .terms-highlight {
        padding: 20px 20px;
    }
}

@media (prefers-color-scheme: dark) {
    .terms-highlight {
        background: rgba(138, 180, 248, 0.08);
    }
    
    .terms-definition {
        background: var(--bg-surface);
        border-color: rgba(255, 255, 255, 0.08);
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(26,115,232,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="/" class="brand-logo">wholphin</a>
    <a href="/" class="back-btn">検索を始める</a>
</nav>

<!-- Hero -->
<section class="hero terms-hero">
    <span class="hero-sub">Terms of Service</span>
    
    <h1 class="hero-title">利用規約</h1>
    
    <p class="hero-desc">
        本利用規約（以下「本規約」）は、wholphin（以下「当サービス」）が提供する検索サービスおよびこれに付随するすべての機能（以下総称して「本サービス」）の利用条件を定めるものです。ユーザーは、本サービスを利用することにより、本規約の内容に同意したものとみなされます。
    </p>
</section>

<!-- Terms Content -->
<div class="terms-content">
    <div class="terms-section">
        <h2>第1条（適用）</h2>
        <ol>
            <li>本規約は、本サービスの提供条件および当サービスとユーザーとの間の権利義務関係を定めることを目的とします。</li>
            <li>当サービスが本サービス上で随時掲載するガイドライン、ポリシー、注意事項等は、本規約の一部を構成するものとします。</li>
            <li>本規約と前項の個別規定の内容が異なる場合には、当該個別規定が優先して適用されます。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第2条（用語の定義）</h2>
        <p>本規約において使用する用語の定義は、以下のとおりとします。</p>
        <dl class="terms-definition">
            <dt>「ユーザー」</dt>
            <dd>本サービスを閲覧または利用するすべての者をいいます。</dd>
            
            <dt>「外部サービス」</dt>
            <dd>当サービス以外の第三者が運営する検索エンジン、ウェブサイト、Fediverseサーバー、その他のサービスをいいます。</dd>
            
            <dt>「コンテンツ」</dt>
            <dd>検索結果、テキスト、画像、リンク、メタデータその他本サービス上で提供または表示される一切の情報をいいます。</dd>
        </dl>
    </div>

    <div class="terms-section">
        <h2>第3条（サービス内容）</h2>
        <ol>
            <li>本サービスは、外部サービスを含む第三者が提供する情報をもとに、検索結果を表示する検索サービスです。</li>
            <li>当サービスは、検索リクエストをプロキシ方式で外部検索エンジンに送信する場合があります。</li>
            <li>当サービスは、本サービスの内容について、正確性、完全性、有用性、最新性、合法性等を保証するものではありません。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第4条（利用条件）</h2>
        <ol>
            <li>ユーザーは、自己の責任において本サービスを利用するものとします。</li>
            <li>本サービスの利用にあたり、特別な登録やアカウント作成を必要としません。</li>
            <li>ユーザーは、本サービスの利用にあたり、関連するすべての法令および本規約を遵守するものとします。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第5条（禁止事項）</h2>
        <p>ユーザーは、本サービスの利用にあたり、以下の行為を行ってはなりません。</p>
        <ul>
            <li>法令または公序良俗に違反する行為</li>
            <li>当サービスまたは第三者の権利・利益を侵害する行為</li>
            <li>本サービスの運営を妨害する行為</li>
            <li>過度な負荷を与える行為（自動化された大量リクエスト等）</li>
            <li>不正アクセス、リバースエンジニアリング、解析行為</li>
            <li>本サービスを通じて取得した情報を不正な目的で利用する行為</li>
            <li>その他、当サービスが不適切と判断する行為</li>
        </ul>
    </div>

    <div class="terms-section">
        <h2>第6条（知的財産権）</h2>
        <ol>
            <li>本サービスに関する著作権、商標権その他の知的財産権は、当サービスまたは正当な権利者に帰属します。</li>
            <li>ユーザーは、私的利用の範囲を超えて本サービスのコンテンツを利用してはなりません。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第7条（外部サービスとの関係）</h2>
        <ol>
            <li>本サービスには、外部サービスへのリンクまたは外部サービスのコンテンツが含まれる場合があります。</li>
            <li>外部サービスの内容、利用条件、プライバシーポリシー等について、当サービスは一切の責任を負いません。</li>
            <li>ユーザーは、外部サービスを自己の責任において利用するものとします。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第8条（サービスの停止・変更・終了）</h2>
        <ol>
            <li>当サービスは、以下の場合、事前の通知なく本サービスの全部または一部を停止または中断することがあります。
                <ul style="margin-left: 20px; margin-top: 12px;">
                    <li>システム保守または障害対応</li>
                    <li>外部サービスの仕様変更・停止</li>
                    <li>天災地変その他不可抗力</li>
                    <li>その他、当サービスが必要と判断した場合</li>
                </ul>
            </li>
            <li>当サービスは、本サービスの内容を予告なく変更または終了することがあります。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第9条（免責事項）</h2>
        <ol>
            <li>当サービスは、本サービスの利用または利用不能によりユーザーに生じた損害について、当サービスの故意または重過失による場合を除き、一切の責任を負いません。</li>
            <li>検索結果や外部コンテンツに起因してユーザーに生じた損害について、当サービスは責任を負いません。</li>
            <li>本サービスは、事実上または法律上の瑙疵（安全性、信頼性、正確性、完全性等）を含まないことを保証するものではありません。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第10条（損害賠償責任の制限）</h2>
        <ol>
            <li>当サービスが損害賠償責任を負う場合であっても、その範囲は、当サービスの故意または重過失により直接生じた通常損害に限られます。</li>
            <li>前項の場合における損害賠償額の上限は、当該損害が発生した利用期間中にユーザーが当サービスに対して支払った対価の総額（無償サービスの場合は1万円）とします。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第11条（個人情報の取扱い）</h2>
        <p>当サービスにおけるユーザー情報の取扱いについては、別途定める<a href="privacy.php" style="color: var(--primary); text-decoration: none; font-weight: 600;">「プライバシーポリシー」</a>に従うものとします。</p>
    </div>

    <div class="terms-section">
        <h2>第12条（規約の変更）</h2>
        <ol>
            <li>当サービスは、必要に応じて本規約を変更することがあります。</li>
            <li>本規約の変更後にユーザーが本サービスを利用した場合、変更後の規約に同意したものとみなされます。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第13条（準拠法および管轄裁判所）</h2>
        <ol>
            <li>本規約の解釈および適用については、日本法を準拠法とします。</li>
            <li>本サービスに関連して生じた紛争については、日本の裁判所を第一審の専属的合意管轄裁判所とします。</li>
        </ol>
    </div>

    <div class="terms-section">
        <h2>第14条（分離可能性）</h2>
        <p>本規約のいずれかの条項が無効または執行不能と判断された場合であっても、その他の条項は引き続き有効に存続するものとします。</p>
    </div>

    <div class="terms-section">
        <h2>第15条（お問い合わせ先）</h2>
        <p>本規約に関するお問い合わせは、以下までご連絡ください。</p>
        <p style="margin-top: 20px;">
            <strong>メールアドレス：</strong> <a href="mailto:privacy@wholphin.net" style="color: var(--primary); text-decoration: none;">privacy@wholphin.net</a><br>
            <strong>運営：</strong> wholphin 開発チーム
        </p>
    </div>

    <div class="terms-date">
        <p><strong>制定日：</strong>2026年2月20日</p>
    </div>
</div>

<footer class="app-footer">
    <div class="footer-inner">
        <div class="footer-links">
            <a href="about.php" class="footer-link">About</a>
            <a href="/help" class="footer-link">ヘルプ</a>
            <a href="/privacy" class="footer-link">プライバシー</a>
            <a href="/terms" class="footer-link">利用規約</a>
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
const sections = document.querySelectorAll('.terms-section');
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
</script>

</body>
</html>