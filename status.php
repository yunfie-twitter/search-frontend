<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>サービスステータス - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<style>
/* ステータスページ専用スタイル - モダン修正版 */
/* GSAP/Lenisを除去し、シンプルCSSのみ。SVGアイコン、Gridレイアウト、クリーン背景、pulse削除 */

:root {
    --success: #22c55e;
    --warning: #fbbf24;
    --error: #ef4444;
    --text-main: #111827;
    --text-sub: #6b7280;
    --bg-surface: #f9fafb;
    --border-subtle: #e5e7eb;
    --primary: #1e40af;
}

@media (prefers-color-scheme: dark) {
    :root {
        --text-main: #f9fafb;
        --text-sub: #d1d5db;
        --bg-surface: #1f2937;
        --border-subtle: #374151;
    }
}

.status-hero {
    min-height: 40vh;
    padding: 120px 24px 60px;
    max-width: 1200px;
    margin: 0 auto;
}

.status-hero .hero-sub {
    font-size: 12px;
    font-weight: 600;
    color: var(--primary);
    letter-spacing: 0.08em;
    text-transform: uppercase;
    margin-bottom: 16px;
}

.status-hero .hero-title {
    font-size: clamp(32px, 5vw, 48px);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.02em;
    margin-bottom: 20px;
    font-family: 'Inter', -apple-system, sans-serif;
}

.status-hero .hero-desc {
    font-size: 16px;
    color: var(--text-sub);
    max-width: 640px;
    line-height: 1.8;
}

.status-content {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 24px 100px;
}

.status-section {
    margin-bottom: 56px;
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.status-section.visible {
    opacity: 1;
    transform: translateY(0);
}

.status-section h2 {
    font-size: clamp(22px, 3vw, 28px);
    font-weight: 600;
    margin-bottom: 32px;
    letter-spacing: -0.02em;
    color: var(--text-main);
    padding-bottom: 12px;
    border-bottom: 2px solid var(--primary);
    font-family: 'Inter', sans-serif;
}

/* 総合ステータス */
.overall-status {
    background: hsla(158, 72%, 42%, 0.08);
    border: 2px solid var(--success);
    border-radius: 20px;
    padding: 40px;
    text-align: center;
    margin-bottom: 48px;
}

.overall-status.degraded {
    background: hsla(45, 92%, 58%, 0.08);
    border-color: var(--warning);
}

.overall-status.down {
    background: hsla(0, 84%, 60%, 0.08);
    border-color: var(--error);
}

.status-icon {
    width: 56px;
    height: 56px;
    margin: 0 auto 20px;
    display: block;
}

.status-icon svg {
    width: 100%;
    height: 100%;
    fill: var(--success);
}

.status-label {
    font-size: 24px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 8px;
}

.status-message {
    font-size: 15px;
    color: var(--text-sub);
}

/* サービスステータス - Gridレイアウト */
.service-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 20px;
}

.service-item {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 28px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.2s ease;
    position: relative;
    overflow: hidden;
}

.service-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--success);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.service-item:hover {
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    transform: translateY(-4px);
}

.service-item:hover::before {
    transform: scaleX(1);
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
    min-width: 80px;
    justify-content: center;
}

.service-status.operational {
    background: hsla(158, 72%, 42%, 0.1);
    color: var(--success);
}

.service-status.degraded {
    background: hsla(45, 92%, 58%, 0.1);
    color: var(--warning);
}

.service-status.down {
    background: hsla(0, 84%, 60%, 0.1);
    color: var(--error);
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: currentColor;
}

/* メンテナンス情報 */
.maintenance-card {
    background: var(--bg-surface);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 28px;
    margin-bottom: 20px;
}

.maintenance-card.scheduled {
    border-left: 5px solid #3b82f6;
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
}

.maintenance-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.maintenance-badge {
    padding: 6px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.maintenance-badge.scheduled {
    background: hsla(217, 91%, 60%, 0.1);
    color: #3b82f6;
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
    font-family: monospace;
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
    border-radius: 16px;
    padding: 24px;
    margin-bottom: 20px;
}

.incident-date {
    font-size: 13px;
    color: var(--text-sub);
    margin-bottom: 8px;
    font-family: monospace;
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
    display: inline-flex;
    align-items: center;
    gap: 4px;
    margin-top: 12px;
    padding: 6px 12px;
    background: hsla(158, 72%, 42%, 0.1);
    color: var(--success);
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

@media (max-width: 600px) {
    .status-hero {
        padding: 80px 20px 40px;
    }
    
    .status-hero .hero-title {
        font-size: 32px;
    }
    
    .service-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 16px;
        text-align: left;
    }
    
    .overall-status {
        padding: 28px 24px;
    }
    
    .service-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
}

@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

</head>
<body>

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
    <!-- 総合ステータス - SVGアイコン使用 -->
    <div class="overall-status">
        <svg class="status-icon" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path fill="currentColor" d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
        </svg>
        <div class="status-label">すべてのシステムが正常に動作しています</div>
        <div class="status-message">現在、全サービスが安定稼働中です</div>
    </div>

    <div class="status-section">
        <h2>サービス状況</h2>
        
        <div class="service-grid">
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
        
        <p style="color: var(--text-sub); font-size: 15px; text-align: center; padding: 40px 20px; border: 2px dashed var(--border-subtle); border-radius: 12px;">
            現在、予定されているメンテナンスはありません。
        </p>
    </div>

    <div class="status-section">
        <h2>過去のインシデント</h2>
        
        <div class="incident-item">
            <div class="incident-date">2026年2月15日</div>
            <div class="incident-title">検索レスポンスの一時的な遅延</div>
            <div class="incident-desc">
                外部APIのレート制限により、一部ユーザーで検索結果の読み込みが遅くなる現象が発生しました。キャッシュ機構の改善により解決しました。
            </div>
            <span class="incident-resolved">
                <svg viewBox="0 0 16 16" width="14" height="14" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M13.485 1l-7.485 7.485-3-3L0 8l6.5 6.5L16 4z"/>
                </svg>
                解決済み
            </span>
        </div>
        
        <div class="incident-item">
            <div class="incident-date">2026年2月8日</div>
            <div class="incident-title">動画タブの埋め込みプレビュー不具合</div>
            <div class="incident-desc">
                YouTube APIの仕様変更により、埋め込みプレビューが表示されない問題が発生しました。コード修正で対応完了しています。
            </div>
            <span class="incident-resolved">
                <svg viewBox="0 0 16 16" width="14" height="14" xmlns="http://www.w3.org/2000/svg">
                    <path fill="currentColor" d="M13.485 1l-7.485 7.485-3-3L0 8l6.5 6.5L16 4z"/>
                </svg>
                解決済み
            </span>
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
// GSAP/Lenis完全除去。最小JSのみ

// Section Reveal (純粋IntersectionObserver)
const sections = document.querySelectorAll('.status-section');
const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, { threshold: 0.1 });

sections.forEach(section => sectionObserver.observe(section));

// Header Scroll Effect (シンプル)
const header = document.querySelector('.nav-header');
window.addEventListener('scroll', () => {
    header.classList.toggle('scrolled', window.scrollY > 20);
}, { passive: true });

// Auto Refresh (5分ごと)
setTimeout(() => location.reload(), 5 * 60 * 1000);

// Update Last Updated Time
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
