<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>サービスステータス - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<!-- GSAP & Lenis -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="https://unpkg.com/@studio-freight/lenis@1.0.42/dist/lenis.min.js"></script>

<style>
/* ステータスページ専用スタイル */
.status-hero {
    min-height: 40vh;
    padding-top: 120px;
    padding-bottom: 60px;
}

.status-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.1s forwards;
}

.status-hero .hero-title {
    font-size: 48px;
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.03em;
    margin-bottom: 20px;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.2s forwards;
}

.status-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 640px;
    line-height: 1.8;
    opacity: 0;
    animation: slideUp 0.6s var(--ease-out) 0.3s forwards;
}

.status-content {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.status-section {
    margin-bottom: 56px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s var(--ease-out), transform 0.6s var(--ease-out);
}

.status-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.status-section h2 {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 24px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    position: relative;
    padding-left: 16px;
}

.status-section h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 4px;
    width: 4px;
    height: 26px;
    background: var(--primary);
    border-radius: 2px;
}

/* 総合ステータス */
.overall-status {
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(34, 197, 94, 0.05) 100%);
    border: 2px solid #22c55e;
    border-radius: 16px;
    padding: 32px;
    text-align: center;
    margin-bottom: 48px;
}

.overall-status.degraded {
    background: linear-gradient(135deg, rgba(251, 191, 36, 0.1) 0%, rgba(251, 191, 36, 0.05) 100%);
    border-color: #fbbf24;
}

.overall-status.down {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
    border-color: #ef4444;
}

.status-icon {
    font-size: 48px;
    margin-bottom: 16px;
}

.status-label {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 8px;
}

.status-message {
    font-size: 15px;
    color: var(--text-sub);
}

/* サービスステータスアイテム */
.service-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.service-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: box-shadow 0.2s;
}

.service-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.service-info {
    flex: 1;
}

.service-name {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 4px;
}

.service-desc {
    font-size: 14px;
    color: var(--text-sub);
}

.service-status {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.service-status.operational {
    background: rgba(34, 197, 94, 0.1);
    color: #16a34a;
}

.service-status.degraded {
    background: rgba(251, 191, 36, 0.1);
    color: #d97706;
}

.service-status.down {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* メンテナンス情報 */
.maintenance-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 24px;
    margin-bottom: 16px;
}

.maintenance-card.scheduled {
    border-left: 4px solid #3b82f6;
}

.maintenance-card.in-progress {
    border-left: 4px solid #fbbf24;
}

.maintenance-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.maintenance-badge {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
}

.maintenance-badge.scheduled {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.maintenance-badge.in-progress {
    background: rgba(251, 191, 36, 0.1);
    color: #d97706;
}

.maintenance-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-main);
}

.maintenance-time {
    font-size: 14px;
    color: var(--text-sub);
    margin-bottom: 8px;
}

.maintenance-desc {
    font-size: 14px;
    color: var(--text-main);
    line-height: 1.6;
}

/* 更新時刻 */
.last-updated {
    text-align: center;
    font-size: 13px;
    color: var(--text-sub);
    margin-top: 48px;
    padding-top: 24px;
    border-top: 1px solid var(--border-subtle);
}

/* インシデント履歴 */
.incident-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 12px;
    padding: 20px 24px;
    margin-bottom: 16px;
}

.incident-date {
    font-size: 13px;
    color: var(--text-sub);
    margin-bottom: 8px;
}

.incident-title {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 8px;
}

.incident-desc {
    font-size: 14px;
    color: var(--text-main);
    line-height: 1.7;
}

.incident-resolved {
    display: inline-block;
    margin-top: 8px;
    padding: 4px 10px;
    background: rgba(34, 197, 94, 0.1);
    color: #16a34a;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

@media (max-width: 600px) {
    .status-hero .hero-title {
        font-size: 36px;
    }
    
    .status-section h2 {
        font-size: 22px;
    }
    
    .service-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
    }
    
    .overall-status {
        padding: 24px 20px;
    }
}

@media (prefers-color-scheme: dark) {
    .service-item:hover {
        box-shadow: 0 4px 16px rgba(0,0,0,0.3);
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
<section class="hero status-hero">
    <span class="hero-sub">Service Status</span>
    
    <h1 class="hero-title">サービスステータス</h1>
    
    <p class="hero-desc">
        wholphin の現在の稼働状況と、予定されているメンテナンス情報を確認できます。
    </p>
</section>

<!-- Status Content -->
<div class="status-content">
    <!-- 総合ステータス -->
    <div class="overall-status">
        <div class="status-icon">✅</div>
        <div class="status-label">すべてのシステムが正常に動作しています</div>
        <div class="status-message">現在、全サービスが安定稼働中です</div>
    </div>

    <div class="status-section">
        <h2>サービス状況</h2>
        
        <div class="service-list">
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">検索エンジンコア</div>
                    <div class="service-desc">メインの検索機能とAPI</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
            
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">外部検索API連携</div>
                    <div class="service-desc">第三者検索エンジンへのプロキシ接続</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
            
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">動画検索（YouTube）</div>
                    <div class="service-desc">動画タブと埋め込みプレビュー</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
            
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">ソーシャル検索（Fediverse）</div>
                    <div class="service-desc">Mastodon、Misskey等の分散型SNS検索</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
            
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">画像検索</div>
                    <div class="service-desc">画像タブとビジュアル検索機能</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
            
            <div class="service-item">
                <div class="service-info">
                    <div class="service-name">ニュース検索</div>
                    <div class="service-desc">ニュース記事の検索と表示</div>
                </div>
                <div class="service-status operational">
                    <span class="status-dot"></span>
                    正常
                </div>
            </div>
        </div>
    </div>

    <div class="status-section">
        <h2>予定されたメンテナンス</h2>
        
        <div class="maintenance-card scheduled" style="display: none;">
            <div class="maintenance-header">
                <span class="maintenance-badge scheduled">予定</span>
                <span class="maintenance-title">定期メンテナンス</span>
            </div>
            <div class="maintenance-time">2026年3月1日 02:00 - 04:00 (JST)</div>
            <div class="maintenance-desc">
                システムの定期メンテナンスを実施します。この間、サービスが一時的に利用できなくなる場合があります。
            </div>
        </div>
        
        <p style="color: var(--text-sub); font-size: 15px;">現在、予定されているメンテナンスはありません。</p>
    </div>

    <div class="status-section">
        <h2>過去のインシデント</h2>
        
        <div class="incident-item">
            <div class="incident-date">2026年2月15日</div>
            <div class="incident-title">検索レスポンスの一時的な遅延</div>
            <div class="incident-desc">
                外部APIのレート制限により、一部ユーザーで検索結果の読み込みが遅くなる現象が発生しました。キャッシュ機構の改善により解決しました。
            </div>
            <span class="incident-resolved">解決済み</span>
        </div>
        
        <div class="incident-item">
            <div class="incident-date">2026年2月8日</div>
            <div class="incident-title">動画タブの埋め込みプレビュー不具合</div>
            <div class="incident-desc">
                YouTube APIの仕様変更により、埋め込みプレビューが表示されない問題が発生しました。コード修正で対応完了しています。
            </div>
            <span class="incident-resolved">解決済み</span>
        </div>
    </div>

    <div class="last-updated">
        <p>最終更新：<span id="lastUpdated">2026年2月20日 00:25 JST</span></p>
        <p style="margin-top: 8px; font-size: 12px;">このページは5分ごとに自動更新されます</p>
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
const sections = document.querySelectorAll('.status-section');
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

// --- Auto Refresh (5分ごと) ---
setTimeout(() => {
    location.reload();
}, 5 * 60 * 1000);

// --- Update Last Updated Time ---
function updateLastUpdated() {
    const now = new Date();
    const formatted = now.toLocaleString('ja-JP', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        timeZone: 'Asia/Tokyo',
        timeZoneName: 'short'
    });
    document.getElementById('lastUpdated').textContent = formatted;
}

updateLastUpdated();
</script>

</body>
</html>