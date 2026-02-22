<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>プライバシーポリシー - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* プライバシーポリシー専用スタイル */
.privacy-hero {
    min-height: 40vh;
    padding-top: 120px;
    padding-bottom: 60px;
}

.privacy-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.1s forwards;
}

.privacy-hero .hero-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.2s forwards;
}

.privacy-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 680px;
    line-height: 1.8;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.3s forwards;
}

.privacy-content {
    max-width: 760px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.privacy-section {
    margin-bottom: 56px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
}

.privacy-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.privacy-section h2 {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    position: relative;
    padding-left: 16px;
}

.privacy-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 4px;
    width: 4px;
    height: 24px;
    background: var(--primary);
    border-radius: 2px;
}

.privacy-section h3 {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 12px;
    margin-top: 28px;
    color: var(--text-main);
}

.privacy-section p {
    font-size: 15px;
    line-height: 1.85;
    color: var(--text-main);
    margin-bottom: 16px;
}

.privacy-section ul {
    list-style: none;
    padding-left: 0;
    margin-bottom: 20px;
    margin-top: 12px;
}

.privacy-section li {
    font-size: 15px;
    line-height: 1.8;
    color: var(--text-main);
    padding-left: 28px;
    margin-bottom: 10px;
    position: relative;
}

.privacy-section li::before {
    content: '•';
    position: absolute;
    left: 10px;
    color: var(--primary);
    font-weight: bold;
    font-size: 18px;
}

.privacy-highlight {
    background: rgba(26, 115, 232, 0.08);
    border-left: 3px solid var(--primary);
    padding: 24px 28px;
    border-radius: 8px;
    margin: 28px 0;
}

.privacy-highlight p {
    margin-bottom: 0;
    font-weight: 500;
    line-height: 1.8;
}

.privacy-note {
    font-size: 14px;
    color: var(--text-sub);
    font-style: italic;
    margin-top: 8px;
    padding-left: 12px;
    border-left: 2px solid var(--border);
}

.privacy-date {
    font-size: 13px;
    color: var(--text-sub);
    margin-top: 60px;
    padding-top: 24px;
    border-top: 1px solid var(--border-subtle);
}

@media (max-width: 600px) {
    .privacy-hero .hero-title {
        font-size: 36px;
    }
    
    .privacy-section h2 {
        font-size: 20px;
    }
    
    .privacy-section h3 {
        font-size: 17px;
    }
    
    .privacy-highlight {
        padding: 20px 20px;
    }
}

@media (prefers-color-scheme: dark) {
    .privacy-highlight {
        background: rgba(138, 180, 248, 0.08);
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
<section class="hero privacy-hero">
    <span class="hero-sub">Privacy Policy</span>
    
    <h1 class="hero-title">プライバシーポリシー</h1>
    
    <p class="hero-desc">
        wholphin（以下「当サービス」）は、ユーザーのプライバシー保護を最重要事項の一つとして位置づけています。当サービスは、可能な限り<strong>個人を特定しない設計（Privacy by Design）</strong>を採用し、必要最小限の情報のみを取り扱うことで、安心して利用できる検索体験の提供を目指します。<br><br>
        本プライバシーポリシーは、当サービスにおいてどのような情報を、どの目的で、どのように取り扱うのかを明確に説明するものです。本ポリシーで定義されていない用語については、個人情報保護法、GDPR その他関連法令の一般的な定義に従います。
    </p>
</section>

<!-- Privacy Content -->
<div class="privacy-content">
    <div class="privacy-section">
        <h2>1. 基本方針</h2>
        <p>当サービスは、以下の基本方針に基づいて運営されます。</p>
        <ul>
            <li>ユーザー個人を識別・追跡することを目的としたデータ収集は行いません。</li>
            <li>検索履歴をユーザー単位で恒常的に保存・管理しません。</li>
            <li>情報の収集・利用は、サービス提供に必要な最小限の範囲に限定します。</li>
            <li>データの取り扱いについて、可能な限り透明性を確保します。</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>2. 収集する情報の種類</h2>
        <p>当サービスは、外部検索エンジンへの検索リクエストをプロキシ（代理接続）する形で検索結果を提供します。そのため、ユーザーの検索リクエストは当サービスのサーバーを経由して送信され、外部検索エンジンに対してユーザーを直接識別可能な情報が送信されることはありません。</p>
        
        <h3>2.1 検索クエリ</h3>
        <ul>
            <li>ユーザーが入力した検索キーワード（検索クエリ）は、検索結果を生成する目的で一時的に処理されます。</li>
            <li>検索クエリは、アカウント情報、IPアドレス、Cookie ID 等の個人を特定し得る情報と恒常的に紐付けられることはありません。</li>
            <li>検索品質向上のため、検索クエリが匿名化または統計的に集計された形式で利用される場合があります。</li>
        </ul>
        <p><strong>利用目的の例：</strong></p>
        <ul>
            <li>検索アルゴリズムの改善</li>
            <li>検索結果の関連性・品質の統計的評価</li>
        </ul>
        <p class="privacy-note">※ 検索クエリの保持期間は、内部運用上必要な最小限の期間に限定されます。</p>
        
        <h3>2.2 技術情報（ログ情報）</h3>
        <p>当サービスは、安定運用、セキュリティ確保、不正利用防止のため、以下の技術情報を収集する場合があります。</p>
        <ul>
            <li>IPアドレス（保存時または処理時に匿名化・短縮される場合があります）</li>
            <li>ブラウザの種類およびバージョン</li>
            <li>OS・デバイスの種類</li>
            <li>アクセス日時</li>
            <li>エラー情報、パフォーマンスに関する技術的データ</li>
        </ul>
        <p>これらの情報は、ユーザー個人を特定または追跡する目的で利用されることはありません。</p>
        <p class="privacy-note">※ ログの保存期間および匿名化手法の詳細は、セキュリティ上の理由から公開していません。</p>
        
        <h3>2.3 Cookieおよび類似技術</h3>
        <p>当サービスでは、以下の目的に限定してCookieまたは類似の技術を使用する場合があります。</p>
        <ul>
            <li>言語や表示形式などの検索設定の保持</li>
            <li>セッション管理</li>
            <li>不正アクセス防止</li>
        </ul>
        <div class="privacy-highlight">
            <p>広告配信や行動追跡を目的としたCookieは使用しません。</p>
        </div>
        <p>ユーザーはブラウザ設定によりCookieを無効化できますが、その場合、一部機能が正常に動作しないことがあります。</p>
    </div>

    <div class="privacy-section">
        <h2>3. 情報の利用目的</h2>
        <p>当サービスが収集した情報は、以下の目的にのみ利用されます。</p>
        <ul>
            <li>検索結果の提供および精度向上</li>
            <li>サービスの安定運用、保守、障害対応</li>
            <li>セキュリティ対策および不正利用の防止</li>
            <li>個人を特定しない統計データの作成・分析</li>
            <li>法令または公的機関からの適法な要請への対応</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>4. 情報の保管期間と管理</h2>
        <ul>
            <li>検索クエリは処理後速やかに匿名化され、個人識別可能な形で長期保存されることはありません。</li>
            <li>技術情報およびログは、運用上必要な最短期間のみ保管され、一定期間経過後に削除されます。</li>
            <li>保存期間は、情報の種類、利用目的、法的要件により異なります。</li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>5. セキュリティ対策</h2>
        <p>当サービスは、以下を含む業界標準のセキュリティ対策を講じています。</p>
        <ul>
            <li>通信の暗号化（HTTPS）</li>
            <li>アクセス制御および権限管理</li>
            <li>不正アクセス・不正利用の監視</li>
            <li>内部運用における最小権限原則</li>
        </ul>
        <p>また、通信の最適化およびDDoS対策等を目的として、第三者が提供するCDN・セキュリティサービスを利用する場合があります。これらの事業者は、通信過程においてIPアドレス等の技術情報を処理することがありますが、契約および法令に基づき適切に取り扱われます。</p>
        <p class="privacy-note">※ ただし、インターネット通信の性質上、完全な安全性を保証するものではありません。</p>
    </div>

    <div class="privacy-section">
        <h2>6. 第三者への情報提供</h2>
        <p>当サービスは、以下の場合を除き、ユーザー情報を第三者に提供、販売、または共有しません。</p>
        <ul>
            <li><strong>法令に基づく開示要請があった場合</strong></li>
            <li><strong>サービス提供に必要な範囲で業務委託先に情報を提供する場合</strong><br>
            この場合、守秘義務およびデータ保護義務を含む契約を締結します</li>
            <li><strong>ユーザー本人の明示的な同意がある場合</strong></li>
        </ul>
    </div>

    <div class="privacy-section">
        <h2>7. 外部サービスとの連携</h2>
        
        <h3>7.1 外部検索エンジン</h3>
        <p>当サービスは、外部検索エンジンへプロキシ方式で接続します。ユーザーのIPアドレスや識別子が直接送信されることはありませんが、検索結果の内容について当サービスは保証しません。</p>
        
        <h3>7.2 ソーシャルタブ（Fediverse検索）</h3>
        <p>「ソーシャル」タブでは、分散型プロトコルに基づき公開されている投稿情報を検索対象とします。当サービスは、投稿内容の正確性、合法性、権利関係について責任を負いません。</p>
    </div>

    <div class="privacy-section">
        <h2>8. 外部リンク</h2>
        <p>検索結果には外部サイトへのリンクが含まれる場合があります。外部サイトにおける個人情報の取り扱いについて、当サービスは責任を負いません。各外部サイトのプライバシーポリシーをご確認ください。</p>
    </div>

    <div class="privacy-section">
        <h2>9. ユーザーの権利</h2>
        <p>ユーザーは、適用法令に基づき、以下の権利を有します。</p>
        <ul>
            <li>情報へのアクセス権</li>
            <li>情報の訂正または削除の要求</li>
            <li>データ処理への異議申立て</li>
            <li>Cookieの管理と拒否</li>
        </ul>
        <p>ただし、匿名化された情報については、技術的な理由により対応できない場合があります。これらの権利行使については、下記お問い合わせ先までご連絡ください。</p>
    </div>

    <div class="privacy-section">
        <h2>10. 子どものプライバシー</h2>
        <p>当サービスは13歳未満の子どもを対象としておらず、意図的に個人情報を収集しません。保護者の方が、お子様が個人情報を提供したと思われる場合は、速やかにご連絡ください。</p>
    </div>

    <div class="privacy-section">
        <h2>11. ポリシーの変更</h2>
        <p>本ポリシーは、法令変更やサービス内容の変更に伴い、予告なく改定されることがあります。重要な変更がある場合は、当サービス上で通知します。定期的にこのページを確認し、最新のポリシーをご確認ください。</p>
    </div>

    <div class="privacy-section">
        <h2>12. お問い合わせ先</h2>
        <p>プライバシーポリシーに関するご質問やご意見は、以下の方法でお問い合わせください。</p>
        <p style="margin-top: 20px;">
            <strong>メールアドレス：</strong> <a href="mailto:privacy@wholphin.net" style="color: var(--primary); text-decoration: none;">privacy@wholphin.net</a><br>
            <strong>運営：</strong> wholphin 開発チーム
        </p>
    </div>

    <div class="privacy-section">
        <h2>13. 準拠法および管轄</h2>
        <p>本ポリシーは日本法を準拠法とし、関連する紛争は日本の裁判所を第一審の専属的合意管轄とします。</p>
    </div>

    <div class="privacy-section">
        <h2>14. EEAおよびGDPRに関する補足</h2>
        <p>EEA（欧州経済領域）居住者にGDPRが適用される場合、当サービスは正当な処理根拠に基づき個人データを取り扱います。ただし、当サービスは原則として個人を直接識別可能なデータを保持しないため、権利行使が技術的に制限される場合があります。</p>
        <p>GDPRに基づく権利行使についてのお問い合わせは、上記連絡先までご連絡ください。</p>
    </div>

    <div class="privacy-date">
        <p><strong>最終更新日：</strong>2026年2月20日</p>
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
const sections = document.querySelectorAll('.privacy-section');
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