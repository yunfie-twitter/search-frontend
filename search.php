<?php
// search.php - セーフサーチ対応版 + Cookie保存 + 自動読み込み

// クエリ取得
$q = isset($_GET['q']) ? $_GET['q'] : '';
$q = trim($q);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
<title><?= htmlspecialchars($_GET['q'] ?? '') ?> - wholphin 検索</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <meta name="description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。ウェブ、画像、動画、ニュース、ソーシャルメディアを素早く検索できます。">
    <meta name="keywords" content="検索, 検索エンジン, wholphin, 日本語検索, 高速検索, ニュース検索, SNS検索">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://wholphin.net/">
    <meta property="og:title" content="wholphin - 高速でシンプルな検索体験">
    <meta property="og:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">
    <meta property="og:site_name" content="wholphin">
    <meta property="og:locale" content="ja_JP">
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#ffffff">
    <link rel="apple-touch-icon" href="/android-chrome-192x192.png">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://cf866966.cloudfree.jp/">
    <meta name="twitter:title" content="wholphin - 高速でシンプルな検索体験">
    <meta name="twitter:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">

    <link rel="canonical" href="https://wholphin.net/">
<link rel="preload" href="https://fonts.gstatic.com/s/merriweathersans/v28/2-c79IRs1JiJN1FRAMjTN5zd9vgsFHXwcjfj9zlcxZI.woff2" as="font" type="font/woff2" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@100..900&display=optional" rel="stylesheet">
<link rel="shortcut icon" href="/favicon.ico">
<style>
/* CSS省略 - 元のファイルと同じ */
:root {
    --primary: #1a73e8;
    --primary-hover: #1557b0;
    --text-main: #202124;
    --text-sub: #5f6368;
    --text-link: #1a0dab;
    --bg-body: #ffffff;
    --bg-surface: #ffffff;
    --bg-hover: #f1f3f4;
    --border: #dfe1e5;
    --icon-color: #9aa0a6;
    --shadow-soft: 0 1px 6px rgba(32,33,36,0.18);
    --radius-l: 24px;
    --radius-m: 12px;
    --header-bg: rgba(255,255,255,0.98);
    --footer-bg: #f2f2f2;
}

@media (prefers-color-scheme: dark) {
    :root {
        --primary: #8ab4f8;
        --primary-hover: #aecbfa;
        --text-main: #e8eaed;
        --text-sub: #bdc1c6;
        --text-link: #8ab4f8;
        --bg-body: #202124;
        --bg-surface: #303134;
        --bg-hover: #3c4043;
        --border: #5f6368;
        --icon-color: #9aa0a6;
        --shadow-soft: 0 1px 6px rgba(0,0,0,0.3);
        --header-bg: rgba(32,33,36,0.98);
        --footer-bg: #171717;
    }
}

* { box-sizing: border-box; -webkit-tap-highlight-color: transparent; outline: none; }
html, body { height: 100%; margin: 0; }

body {
    font-family: 'Noto Sans JP', sans-serif;
    color: var(--text-main);
    background: var(--bg-body);
    display: flex;
    flex-direction: column;
    overflow-y: scroll;
    transition: background 0.3s, color 0.3s;
}

a { text-decoration: none; color: inherit; }
button { border: none; background: none; cursor: pointer; padding: 0; }

.app-wrapper {
    flex: 1;
    display: flex;
    flex-direction: column;
}

header {
    position: sticky; top: 0; z-index: 1000;
    background: var(--header-bg);
    border-bottom: 1px solid var(--border);
    transition: background 0.3s, border-color 0.3s;
}

.header-inner {
    display: flex; align-items: center; gap: 24px;
    padding: 20px 24px 0; max-width: 1200px; margin: 0;
}

.logo {
    font-size: 24px; font-weight: 700; color: var(--text-main);
    white-space: nowrap; user-select: none; cursor: pointer;
    letter-spacing: -0.5px;
    font-family: "Merriweather Sans", sans-serif;
    font-optical-sizing: auto;
    font-style: italic;
    flex-shrink: 0;
}
@media (prefers-color-scheme: dark) { .logo { color: #fff; } }

.search-container {
    flex: 1; max-width: 690px; position: relative;
}

.search-box-wrap {
    position: relative;
    border-radius: var(--radius-l);
    background: var(--bg-surface);
    border: 1px solid var(--border);
    z-index: 101;
    display: flex;
    align-items: center;
    padding-left: 14px;
    height: 44px;
    transition: box-shadow 0.2s, background 0.2s, border-color 0.2s;
}

.search-box-wrap:hover { box-shadow: var(--shadow-soft); border-color: transparent; }

.search-box-wrap.active.has-suggestions {
    box-shadow: var(--shadow-soft);
    border-color: transparent;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    background: var(--bg-surface);
}

.search-icon-left {
    width: 20px; height: 20px; fill: var(--icon-color);
    flex-shrink: 0; margin-right: 8px;
    pointer-events: none;
    display: block;
}

.mobile-back-btn {
    display: none;
    width: 24px; height: 24px; padding: 2px;
    margin-right: 8px; cursor: pointer;
    fill: var(--text-sub);
}

.search-input {
    flex: 1; height: 100%; padding: 0 8px 0 0;
    border: none; background: transparent;
    font-size: 16px; color: var(--text-main);
    border-radius: var(--radius-l);
    min-width: 0;
}
.search-input::placeholder { color: var(--text-sub); opacity: 0.8; }

.action-btn-area {
    height: 44px;
    display: flex; align-items: center;
    margin-right: 4px;
    gap: 4px;
}

.icon-btn {
    width: 36px; height: 36px;
    display: flex; align-items: center; justify-content: center;
    border-radius: 50%;
    cursor: pointer;
    transition: background 0.2s;
}
.icon-btn:hover { background: var(--bg-hover); }

.clear-btn, .mic-btn {
    display: none;
    width: 24px; height: 24px;
}
.clear-btn svg, .mic-btn svg { width: 100%; height: 100%; fill: var(--icon-color); }

.mic-btn { display: flex; }
.mic-btn svg { fill: var(--primary); }

.search-box-wrap.has-value .mic-btn { display: none; }
.search-box-wrap.has-value .clear-btn { display: flex; }

.mic-btn.listening svg { display: none; }
.mic-btn.listening::after {
    content: ''; width: 14px; height: 14px;
    background: #ea4335; border-radius: 50%;
    animation: pulse-red 1.5s infinite;
}
@keyframes pulse-red {
    0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(234, 67, 53, 0.7); }
    70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(234, 67, 53, 0); }
    100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(234, 67, 53, 0); }
}

.safesearch-btn { position: relative; }
.safesearch-menu {
    position: absolute; top: 100%; right: 0; margin-top: 8px;
    background: var(--bg-surface); border: 1px solid var(--border);
    border-radius: var(--radius-m); box-shadow: var(--shadow-soft);
    min-width: 180px; display: none; z-index: 1001;
}
.safesearch-menu.open { display: block; }
.safesearch-menu-item {
    padding: 12px 16px; cursor: pointer; display: flex;
    align-items: center; justify-content: space-between;
    font-size: 14px; color: var(--text-main); transition: background 0.2s;
}
.safesearch-menu-item:hover { background: var(--bg-hover); }
.safesearch-menu-item:first-child { border-radius: var(--radius-m) var(--radius-m) 0 0; }
.safesearch-menu-item:last-child { border-radius: 0 0 var(--radius-m) var(--radius-m); }
.safesearch-menu-item.active { background: var(--bg-hover); font-weight: 600; color: var(--primary); }
.safesearch-menu-item .check-icon { width: 18px; height: 18px; fill: var(--primary); display: none; }
.safesearch-menu-item.active .check-icon { display: block; }

.suggest-list {
    position: absolute; top: 100%; left: 0; right: 0;
    background: var(--bg-surface); border-radius: 0 0 24px 24px;
    padding-bottom: 8px; box-shadow: var(--shadow-soft);
    display: none; z-index: 100; overflow: hidden;
    max-height: 50vh; overflow-y: auto; margin: -1px;
}
.search-box-wrap.active.has-suggestions .suggest-list { display: block; }
.suggest-item {
    padding: 0 16px; height: 48px; font-size: 16px; cursor: pointer;
    display: flex; align-items: center; gap: 14px; color: var(--text-main);
}
.suggest-item:hover, .suggest-item.selected { background: var(--bg-hover); }
.suggest-icon { width: 18px; height: 18px; fill: var(--icon-color); flex-shrink: 0; }
.suggest-text { white-space: nowrap; overflow: hidden; text-overflow: ellipsis; flex: 1; }

.tabs {
    display: flex; gap: 24px; margin-left: 105px; padding-top: 16px;
    overflow-x: auto; scrollbar-width: none; -ms-overflow-style: none;
}
.tabs::-webkit-scrollbar { display: none; }
.tab {
    padding: 0 4px 12px; font-size: 14px; color: var(--text-sub);
    cursor: pointer; border-bottom: 3px solid transparent;
    font-weight: 500; white-space: nowrap; flex-shrink: 0;
}
.tab:hover { color: var(--primary); }
.tab.active { color: var(--primary); border-bottom-color: var(--primary); }

main { width: 100%; max-width: 1200px; padding: 24px; }
.content-area { margin-left: 105px; max-width: 650px; min-height: 40vh; }
.stats { font-size: 14px; color: var(--text-sub); margin-bottom: 24px; height: 20px; }

/* Knowledge Panel等のスタイルは元のファイルと同じため省略 */
.knowledge-panel {
    border: 1px solid var(--border); border-radius: var(--radius-m);
    padding: 20px; margin-bottom: 32px; background: var(--bg-surface);
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}
.panel-header { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 16px; }
.panel-image { width: 120px; height: 120px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: var(--bg-hover); }
.panel-info { flex: 1; min-width: 0; }
.panel-title { font-size: 22px; font-weight: 600; color: var(--text-main); margin-bottom: 8px; line-height: 1.3; }
.panel-subtitle { font-size: 14px; color: var(--text-sub); margin-bottom: 12px; }
.panel-description { font-size: 14px; line-height: 1.6; color: var(--text-main); margin-bottom: 12px; }
.panel-facts { display: grid; gap: 8px; margin-top: 16px; }
.panel-fact { display: flex; font-size: 13px; line-height: 1.5; }
.panel-fact-label { font-weight: 600; color: var(--text-sub); min-width: 100px; flex-shrink: 0; }
.panel-fact-value { color: var(--text-main); }
.panel-source { margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--border); font-size: 12px; color: var(--text-sub); }
.panel-source a { color: var(--text-link); text-decoration: none; }
.panel-source a:hover { text-decoration: underline; }

@media (max-width: 820px) {
    .knowledge-panel { padding: 16px; }
    .panel-header { flex-direction: column; }
    .panel-image { width: 100%; height: 200px; }
}

.web-item { margin-bottom: 36px; }
.web-cite { display: flex; align-items: center; gap: 10px; font-size: 14px; margin-bottom: 8px; }
.web-cite img { width: 18px; height: 18px; border-radius: 50%; background: #f1f3f4; object-fit: cover; border: 1px solid rgba(0,0,0,0.1); }
.web-cite span { color: var(--text-main); font-size: 14px; }
.web-title { display: block; font-size: 20px; color: var(--text-link); line-height: 1.3; margin-bottom: 8px; letter-spacing: 0.2px; }
.web-title:hover { text-decoration: underline; }
.web-desc { font-size: 14px; line-height: 1.6; color: var(--text-sub); word-break: break-all; }
@media (prefers-color-scheme: dark) {
    .web-desc { color: #bdc1c6; }
    .web-cite img { border: 1px solid #5f6368; }
}

.video-item { display: flex; gap: 16px; margin-bottom: 24px; cursor: pointer; border-radius: 14px; padding: 10px; transition: background 0.15s, box-shadow 0.15s, border-color 0.15s; border: 1px solid transparent; }
.video-item:hover .video-title { color: var(--primary); }
.video-item.is-active { background: var(--bg-hover); border-color: rgba(26,115,232,0.45); box-shadow: 0 4px 14px rgba(26,115,232,0.12); }
@media (prefers-color-scheme: dark) { .video-item.is-active { border-color: rgba(138,180,248,0.55); box-shadow: 0 4px 14px rgba(138,180,248,0.12); } }
.video-thumb { width: 180px; aspect-ratio: 16/9; flex-shrink: 0; border-radius: var(--radius-m); background: #000; overflow: hidden; position: relative; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
.video-thumb img { width: 100%; height: 100%; object-fit: cover; }
.video-item.is-active .video-thumb { display: none; }
.video-thumb::after { content: ''; position: absolute; inset: 0; background: rgba(0,0,0,0.0); transition: background 0.15s; }
.video-item:hover .video-thumb::after { background: rgba(0,0,0,0.12); }
.video-play-btn { position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 56px; height: 56px; border-radius: 999px; background: rgba(0,0,0,0.55); display: grid; place-items: center; backdrop-filter: blur(2px); }
.video-play-btn svg { width: 22px; height: 22px; fill: #fff; margin-left: 2px; }
.video-info { flex: 1; min-width: 0; }
.video-title { font-size: 18px; color: var(--text-link); line-height: 1.3; margin-bottom: 6px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.video-meta { font-size: 13px; color: var(--text-sub); display: flex; flex-wrap: wrap; align-items: center; gap: 6px; }
.video-meta .video-favicon { width: 14px; height: 14px; border-radius: 3px; object-fit: cover; background: var(--bg-hover); border: 1px solid rgba(0,0,0,0.08); }
@media (prefers-color-scheme: dark) { .video-meta .video-favicon { border: 1px solid rgba(255,255,255,0.12); } }
.video-desc { font-size: 13px; color: var(--text-sub); margin-top: 8px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.video-embed { margin-top: 12px; border: 1px solid var(--border); border-radius: var(--radius-m); overflow: hidden; background: #000; }
.video-embed iframe { width: 100%; aspect-ratio: 16/9; height: auto; display: block; border: 0; }
.video-embed-loading { padding: 14px; font-size: 13px; color: var(--text-sub); background: var(--bg-surface); }
.video-embed-error { padding: 14px; font-size: 13px; color: #b3261e; background: var(--bg-surface); }

.news-item { margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1px solid var(--border); }
.news-item:last-child { border-bottom: none; }
.news-source { font-size: 12px; color: var(--text-sub); margin-bottom: 4px; display: flex; align-items: center; gap: 6px; }
.news-title { font-size: 18px; color: var(--text-link); text-decoration: none; margin-bottom: 6px; display: block; }
.news-title:hover { text-decoration: underline; }
.news-date { font-size: 12px; color: var(--text-sub); }

.social-item { margin-bottom: 20px; padding: 16px; border: 1px solid var(--border); border-radius: var(--radius-m); background: var(--bg-surface); }
.social-header { display: flex; align-items: center; gap: 10px; margin-bottom: 8px; }
.social-avatar { width: 32px; height: 32px; border-radius: 50%; background: #eee; object-fit: cover; }
.social-author { font-weight: bold; font-size: 14px; }
.social-date { font-size: 12px; color: var(--text-sub); margin-left: auto; }
.social-content { font-size: 14px; line-height: 1.5; color: var(--text-main); white-space: pre-wrap; }
.social-images { display: grid; gap: 8px; margin-top: 12px; }
.social-images.count-1 { grid-template-columns: 1fr; }
.social-images.count-2, .social-images.count-3, .social-images.count-4 { grid-template-columns: repeat(2, 1fr); }
.social-img-wrap { aspect-ratio: 16/9; border-radius: 8px; overflow: hidden; background: #f0f0f0; cursor: pointer; position: relative; }
.social-img-wrap img { width: 100%; height: 100%; object-fit: cover; transition: transform 0.2s; }
.social-img-wrap:hover img { transform: scale(1.05); }
.social-img-more { font-size: 12px; color: var(--text-sub); margin-top: 4px; }

.image-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 16px; padding-bottom: 24px; }
.img-card { cursor: pointer; position: relative; overflow: hidden; border-radius: var(--radius-m); aspect-ratio: 16/10; background: var(--bg-surface); }
.img-card img { width: 100%; height: 100%; object-fit: cover; }
.img-card:hover img { transform: scale(1.05); transition: transform 0.2s; }
.img-card .overlay { position: absolute; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); padding: 24px 12px 12px; color: #fff; opacity: 0; transition: opacity .2s; }
.img-card:hover .overlay { opacity: 1; }

.app-footer { background: var(--footer-bg); padding: 16px 24px; border-top: 1px solid var(--border); font-size: 14px; color: var(--text-sub); transition: background 0.3s, border-color 0.3s; }
.footer-inner { max-width: 1200px; margin-left: 105px; display: flex; gap: 24px; flex-wrap: wrap; }
.footer-link { cursor: pointer; }
.footer-link:hover { color: var(--text-main); }

@media (max-width: 820px) {
    .header-inner { flex-direction: column; padding: 16px 16px 0; gap: 12px; }
    .logo { margin: 0 auto; }
    .search-container { width: 100%; max-width: 100%; }
    .tabs { margin-left: 0; gap: 20px; justify-content: flex-start; overflow-x: auto; padding-left: 16px; padding-right: 16px; }
    main { padding: 16px; }
    .content-area { margin-left: 0; max-width: 100%; }
    .footer-inner { margin-left: 0; justify-content: center; }
    .video-item { flex-direction: column; gap: 10px; }
    .video-thumb { width: 100%; aspect-ratio: 16/9; }
    .image-grid { grid-template-columns: repeat(2, 1fr); gap: 8px; }
    body.mobile-search-active { overflow: hidden; }
    body.mobile-search-active .logo, body.mobile-search-active .tabs, body.mobile-search-active main, body.mobile-search-active .app-footer { display: none; }
    body.mobile-search-active header { position: fixed; inset: 0; background: var(--bg-body); z-index: 9999; padding: 0; border: none; display: flex; flex-direction: column; }
    body.mobile-search-active .header-inner { padding: 0; margin: 0; flex-direction: column; width: 100%; height: 100%; max-width: none; }
    body.mobile-search-active .search-container { width: 100%; height: 100%; display: flex; flex-direction: column; }
    body.mobile-search-active .search-box-wrap { border-radius: 0; border: none; border-bottom: 1px solid var(--border); box-shadow: none; height: 60px; flex-shrink: 0; background: var(--bg-surface); }
    body.mobile-search-active .search-box-wrap.active.has-suggestions { border-bottom-left-radius: 0; border-bottom-right-radius: 0; border-color: transparent; border-bottom: 1px solid var(--border); box-shadow: none; }
    body.mobile-search-active .mobile-back-btn { display: block; }
    body.mobile-search-active .search-icon-left { display: none; }
    body.mobile-search-active .suggest-list { display: block !important; width: 100%; height: auto; flex: 1; overflow-y: auto; max-height: none; box-shadow: none; border-radius: 0; padding: 0; background: var(--bg-body); }
}

.skeleton { background: #eee; border-radius: 4px; }
@media (prefers-color-scheme: dark) { .skeleton { background: #3c4043; } }
.sk-line { height: 14px; margin-bottom: 8px; }
.sk-title { height: 22px; width: 60%; margin-bottom: 12px; }
.loader-trigger { height: 80px; display: flex; align-items: center; justify-content: center; opacity: 0; transition: opacity .3s; }
.loader-trigger.visible { opacity: 1; }
.spinner { width: 28px; height: 28px; border: 3px solid var(--border); border-top-color: var(--primary); border-radius: 50%; animation: spin 0.8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

.load-more-btn {
    display: block;
    margin: 32px auto;
    padding: 12px 32px;
    background: var(--primary);
    color: white;
    border: none;
    border-radius: var(--radius-m);
    font-size: 15px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 8px rgba(26,115,232,0.2);
}
.load-more-btn:hover {
    background: var(--primary-hover);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(26,115,232,0.3);
}
.load-more-btn:active {
    transform: translateY(0);
}
.load-more-btn.hidden {
    display: none;
}

.modal { position: fixed; inset: 0; z-index: 2000; background: rgba(0,0,0,0.92); display: none; align-items: center; justify-content: center; }
.modal.open { display: flex; }
.modal-content { max-width: 95vw; max-height: 90vh; display: flex; flex-direction: column; align-items: center; }
.modal-img-wrapper img { max-width: 90vw; max-height: 80vh; display: block; object-fit: contain; border-radius: 4px; }
.close-btn { position: absolute; top: 16px; right: 24px; color: #fff; font-size: 36px; cursor: pointer; opacity: 0.7; z-index: 2001; }
</style>
</head>
<body>

<?php include 'cookie-consent.php'; ?>

<div class="app-wrapper">
    <header>
        <div class="header-inner">
            <div class="logo" onclick="window.location.assign('/')">wholphin</div>
            <div class="search-container">
                <div class="search-box-wrap" id="searchBoxWrap">
                    <div class="mobile-back-btn" id="mobileBackBtn">
                        <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                    </div>
                    <svg class="search-icon-left" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <input type="text" id="searchInput" class="search-input" placeholder="検索" autocomplete="off">
                    <div class="action-btn-area">
                        <div class="icon-btn safesearch-btn" id="safesearchBtn" title="セーフサーチ設定">
                            <svg viewBox="0 0 24 24" width="24" height="24"><path fill="var(--icon-color)" d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/></svg>
                            <div class="safesearch-menu" id="safesearchMenu">
                                <div class="safesearch-menu-item" data-value="0"><span>オフ</span><svg class="check-icon" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                                <div class="safesearch-menu-item" data-value="1"><span>適度</span><svg class="check-icon" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                                <div class="safesearch-menu-item" data-value="2"><span>厳格</span><svg class="check-icon" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/></svg></div>
                            </div>
                        </div>
                        <div id="micBtn" class="icon-btn mic-btn" title="音声検索"><svg viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg></div>
                        <div id="clearBtn" class="icon-btn clear-btn" tabindex="-1"><svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg></div>
                    </div>
                    <div class="suggest-list" id="suggestList"></div>
                </div>
            </div>
        </div>
        <div class="tabs">
            <div class="tab" data-type="web" onclick="app.switchTab('web')">すべて</div>
            <div class="tab" data-type="image" onclick="app.switchTab('image')">画像</div>
            <div class="tab" data-type="video" onclick="app.switchTab('video')">動画</div>
            <div class="tab" data-type="news" onclick="app.switchTab('news')">ニュース</div>
            <div class="tab" data-type="social" onclick="app.switchTab('social')">ソーシャル</div>
        </div>
    </header>

    <main id="main">
        <div class="content-area">
            <div id="stats" class="stats"></div>
            <div id="resultsContainer"></div>
            <button id="loadMoreBtn" class="load-more-btn hidden" onclick="app.loadMore()">さらに表示</button>
            <div id="loader" class="loader-trigger"><div class="spinner"></div></div>
        </div>
    </main>

    <footer class="app-footer">
        <div class="footer-inner">
            <span class="footer-link">wholphin について</span>
            <span class="footer-link">ヘルプ</span>
            <span class="footer-link">プライバシー</span>
            <span class="footer-link">利用規約</span>
            <span style="flex:1"></span>
            <span>&copy; 2026 wholphin search</span>
        </div>
    </footer>
</div>

<div id="modal" class="modal" onclick="if(event.target===this) modal.close()">
    <div class="close-btn" onclick="modal.close()">&times;</div>
    <div class="modal-content">
        <div class="modal-img-wrapper"><img id="modalImg" src=""></div>
        <div style="color:#e8eaed; margin-top:16px; font-size:15px; text-align:center; padding:0 16px;" id="modalTitle"></div>
    </div>
</div>

<script>
const API_ENDPOINT = 'https://api.p2pear.asia/search';
const PAGES_PER_BATCH = 5; // Web検索は5ページごとに手動ロード

const CookieManager = {
    set(name, value, days = 365) {
        const expires = new Date(Date.now() + days * 864e5).toUTCString();
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/; SameSite=Lax`;
    },
    get(name) {
        return document.cookie.split('; ').reduce((r, v) => {
            const parts = v.split('=');
            return parts[0] === name ? decodeURIComponent(parts[1]) : r;
        }, '');
    },
    has(name) {
        return this.get(name) !== '';
    }
};

const app = {
    state: {
        q: '',
        type: 'web',
        safesearch: 0,
        pages: { web: 1, image: 1, video: 1, news: 1, social: 1 },
        results: { web: [], image: [], video: [], news: [], social: [] },
        hasMore: { web: true, image: true, video: true, news: true, social: true },
        loading: false,
        totalCount: 0,
        suggestIndex: -1,
        suggestions: [],
        isListening: false,
        pendingFetch: null,
        panelData: null,
        oembed: { cache: {}, open: {} }
    },

    refs: {
        input: document.getElementById('searchInput'),
        clearBtn: document.getElementById('clearBtn'),
        micBtn: document.getElementById('micBtn'),
        boxWrap: document.getElementById('searchBoxWrap'),
        suggestList: document.getElementById('suggestList'),
        container: document.getElementById('resultsContainer'),
        stats: document.getElementById('stats'),
        loader: document.getElementById('loader'),
        loadMoreBtn: document.getElementById('loadMoreBtn'),
        main: document.getElementById('main'),
        mobileBackBtn: document.getElementById('mobileBackBtn'),
        safesearchBtn: document.getElementById('safesearchBtn'),
        safesearchMenu: document.getElementById('safesearchMenu')
    },

    init() {
        const savedSafesearch = CookieManager.get('safesearch');
        if (savedSafesearch) this.state.safesearch = parseInt(savedSafesearch, 10);
        this.updateSafesearchUI();

        const params = new URLSearchParams(window.location.search);
        this.state.q = params.get('q') || '';
        this.state.type = params.get('type') || 'web';
        
        this.refs.input.value = this.state.q;
        this.toggleClearBtn();
        this.updateTabUI();
        
        if (this.state.q) this.fetchData(true);

        this.setupEventListeners();
        this.setupVoiceInput();
        this.setupSafesearch();
        
        // Web検索以外は無限スクロール
        this.observer = new IntersectionObserver((entries) => {
            if (this.state.type === 'web') return; // Web検索は手動
            if (entries[0].isIntersecting && !this.state.loading && this.state.hasMore[this.state.type]) {
                console.log('[無限スクロール] トリガー検知');
                this.loadMore();
            }
        }, { rootMargin: '200px' });
        this.observer.observe(this.refs.loader);
    },

    setupSafesearch() {
        this.refs.safesearchBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.refs.safesearchMenu.classList.toggle('open');
        });
        document.querySelectorAll('.safesearch-menu-item').forEach(item => {
            item.addEventListener('click', (e) => {
                const value = parseInt(e.currentTarget.dataset.value, 10);
                this.setSafesearch(value);
                this.refs.safesearchMenu.classList.remove('open');
            });
        });
        document.addEventListener('click', (e) => {
            if (!this.refs.safesearchBtn.contains(e.target)) {
                this.refs.safesearchMenu.classList.remove('open');
            }
        });
    },

    setSafesearch(value) {
        this.state.safesearch = value;
        CookieManager.set('safesearch', value);
        this.updateSafesearchUI();
        if (this.state.q) {
            this.resetResults();
            this.fetchData(true);
        }
    },

    updateSafesearchUI() {
        document.querySelectorAll('.safesearch-menu-item').forEach(item => {
            const value = parseInt(item.dataset.value, 10);
            item.classList.toggle('active', value === this.state.safesearch);
        });
    },

    setupEventListeners() {
        this.refs.input.addEventListener('input', (e) => {
            this.handleInput(e);
            this.toggleClearBtn();
        });
        this.refs.input.addEventListener('focus', (e) => {
            if (window.innerWidth <= 820) document.body.classList.add('mobile-search-active');
            this.refs.boxWrap.classList.add('active');
            if (this.refs.input.value.trim().length > 0) {
                 if (this.state.suggestions.length > 0) this.renderSuggestions(this.state.suggestions);
                 else this.fetchSuggestions(this.refs.input.value.trim());
            }
        });
        this.refs.input.addEventListener('keydown', (e) => this.handleKeydown(e));
        this.refs.clearBtn.addEventListener('click', () => {
            this.refs.input.value = '';
            this.refs.input.focus();
            this.toggleClearBtn();
            this.closeSuggest();
        });
        this.refs.mobileBackBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            this.closeSearchMode();
        });
        document.addEventListener('click', (e) => {
            const isMobile = document.body.classList.contains('mobile-search-active');
            if (!this.refs.boxWrap.contains(e.target) && !isMobile) {
                this.closeSuggest();
                this.refs.boxWrap.classList.remove('active');
            }
        });
        window.onpopstate = (e) => {
            if (e.state) {
                this.state.q = e.state.q;
                this.state.type = e.state.type;
                this.refs.input.value = this.state.q;
                this.toggleClearBtn();
                this.resetResults();
                this.updateTabUI();
                this.fetchData(true);
            }
        };
    },

    closeSearchMode() {
        document.body.classList.remove('mobile-search-active');
        this.refs.boxWrap.classList.remove('active');
        this.refs.input.blur();
        this.closeSuggest();
    },

    setupVoiceInput() {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        if (!SpeechRecognition) {
            this.refs.micBtn.style.display = 'none';
            return;
        }
        const recognition = new SpeechRecognition();
        recognition.lang = 'ja-JP';
        recognition.interimResults = false;
        recognition.maxAlternatives = 1;
        recognition.onstart = () => {
            this.state.isListening = true;
            this.refs.micBtn.classList.add('listening');
            this.refs.input.placeholder = "お話しください...";
        };
        recognition.onend = () => {
            this.state.isListening = false;
            this.refs.micBtn.classList.remove('listening');
            this.refs.input.placeholder = "検索";
        };
        recognition.onresult = (event) => {
            const transcript = event.results[0][0].transcript;
            if (transcript) {
                this.refs.input.value = transcript;
                this.toggleClearBtn();
                this.performSearch();
            }
        };
        recognition.onerror = (e) => {
            console.error('Voice Error:', e.error);
            this.state.isListening = false;
            this.refs.micBtn.classList.remove('listening');
            this.refs.input.placeholder = "エラーが発生しました";
            setTimeout(() => { this.refs.input.placeholder = "検索"; }, 2000);
        };
        this.refs.micBtn.addEventListener('click', () => {
            if (this.state.isListening) recognition.stop();
            else recognition.start();
        });
    },

    toggleClearBtn() {
        const hasVal = this.refs.input.value.length > 0;
        this.refs.boxWrap.classList.toggle('has-value', hasVal);
    },

    handleInput(e) {
        const val = e.target.value.trim();
        if (val.length === 0) {
            this.closeSuggest();
            return;
        }
        clearTimeout(this.suggestTimer);
        this.suggestTimer = setTimeout(() => this.fetchSuggestions(val), 250);
    },

    async fetchSuggestions(query) {
        try {
            const res = await fetch(`${API_ENDPOINT}?q=${encodeURIComponent(query)}&type=suggest`);
            const data = await res.json();
            let list = [];
            if (Array.isArray(data.results)) list = data.results;
            else if (Array.isArray(data)) list = data;
            else if (data.suggestions) list = data.suggestions;
            this.state.suggestions = list;
            this.renderSuggestions(list);
        } catch (e) { console.error('Suggest error', e); }
    },

    getSuggestText(item) {
        if (!item) return '';
        if (typeof item === 'string') return item;
        return item.title || item.text || item.value || '';
    },

    renderSuggestions(list) {
        if (!list || list.length === 0) {
            this.closeSuggest();
            return;
        }
        const html = list.map((item, idx) => {
            const text = this.getSuggestText(item);
            if (!text) return '';
            return `
                <div class="suggest-item" data-idx="${idx}" onclick="app.selectSuggest(${idx})">
                    <svg class="suggest-icon" viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                    <span class="suggest-text">${text}</span>
                </div>
            `;
        }).join('');
        if (html) {
            this.refs.suggestList.innerHTML = html;
            this.refs.boxWrap.classList.add('has-suggestions');
        } else {
            this.closeSuggest();
        }
        this.state.suggestIndex = -1;
    },

    selectSuggest(index) {
        const item = this.state.suggestions[index];
        const text = this.getSuggestText(item);
        if (text) {
            this.refs.input.value = text;
            this.toggleClearBtn();
            this.closeSearchMode();
            this.performSearch();
        }
    },

    closeSuggest() {
        this.refs.boxWrap.classList.remove('has-suggestions');
        this.refs.suggestList.innerHTML = '';
        this.state.suggestIndex = -1;
    },

    handleKeydown(e) {
        const items = document.querySelectorAll('.suggest-item');
        if (e.key === 'Enter') {
            if (this.state.suggestIndex >= 0 && items[this.state.suggestIndex]) {
                items[this.state.suggestIndex].click();
            } else {
                this.closeSearchMode();
                this.performSearch();
            }
        } else if (e.key === 'ArrowDown' && items.length > 0) {
            e.preventDefault();
            this.state.suggestIndex = Math.min(this.state.suggestIndex + 1, items.length - 1);
            this.updateSuggestSelection(items);
        } else if (e.key === 'ArrowUp' && items.length > 0) {
            e.preventDefault();
            this.state.suggestIndex = Math.max(this.state.suggestIndex - 1, -1);
            this.updateSuggestSelection(items);
        }
    },

    updateSuggestSelection(items) {
        items.forEach(i => i.classList.remove('selected'));
        if (this.state.suggestIndex >= 0) {
            const item = items[this.state.suggestIndex];
            item.classList.add('selected');
            const idx = parseInt(item.dataset.idx);
            this.refs.input.value = this.getSuggestText(this.state.suggestions[idx]);
        }
    },

    updateTabUI() {
        document.querySelectorAll('.tab').forEach(t => {
            t.classList.toggle('active', t.dataset.type === this.state.type);
        });
        this.refs.main.setAttribute('data-mode', this.state.type);
    },

    switchTab(type) {
        if (this.state.type === type) return;
        this.state.type = type;
        this.updateTabUI();
        this.updateURL();
        this.renderResults();
        this.updateLoadMoreButton();
        if (this.state.results[type].length === 0 && this.state.q) {
            if (this.state.loading) {
                this.state.pendingFetch = { q: this.state.q, type: this.state.type, reset: true };
            } else {
                this.fetchData(true);
            }
        }
    },

    performSearch() {
        const val = this.refs.input.value.trim();
        if (!val) return;
        this.state.q = val;
        this.resetResults();
        this.updateURL();
        this.fetchData(true);
    },

    resetResults() {
        this.state.pages = { web: 1, image: 1, video: 1, news: 1, social: 1 };
        this.state.results = { web: [], image: [], video: [], news: [], social: [] };
        this.state.hasMore = { web: true, image: true, video: true, news: true, social: true };
        this.state.panelData = null;
        this.state.oembed = { cache: {}, open: {} };
        this.refs.container.innerHTML = '';
        this.refs.stats.textContent = '';
        this.refs.loadMoreBtn.classList.add('hidden');
    },

    updateURL() {
        const url = `?q=${encodeURIComponent(this.state.q)}&type=${this.state.type}`;
        history.pushState({ q: this.state.q, type: this.state.type }, '', url);
    },

    async fetchData(isInitial = false) {
        if (this.state.loading) return;
        const type = this.state.type;
        const page = this.state.pages[type];
        const prevCount = this.state.results[type].length;

        console.log(`[fetchData] type=${type}, page=${page}, prevCount=${prevCount}`);

        this.state.loading = true;
        this.toggleLoader(true);
        this.refs.loadMoreBtn.classList.add('hidden');

        if (isInitial && this.state.results[type].length === 0) {
            this.renderSkeleton();
        }

        try {
            const safesearchParam = `&safesearch=${this.state.safesearch}&lang=ja`;
            const url = `${API_ENDPOINT}?q=${encodeURIComponent(this.state.q)}&type=${type}&pages=${page}${safesearchParam}`;
            console.log(`[API Request] ${url}`);
            
            if (type === 'web' && isInitial && !this.state.panelData) {
                const panelPromise = fetch(`${API_ENDPOINT}?q=${encodeURIComponent(this.state.q)}&type=panel${safesearchParam}`);
                const webPromise = fetch(url);
                const [panelRes, webRes] = await Promise.all([panelPromise, webPromise]);
                const panelData = await panelRes.json();
                const webData = await webRes.json();
                this.state.panelData = panelData;
                
                const allResults = webData.results || [];
                const newResults = allResults.slice(prevCount);
                this.state.results[type] = allResults;
                this.state.totalCount = webData.count || allResults.length;
                
                console.log(`[API Response] 全体=${allResults.length}, 新規=${newResults.length}`);
                
                if (newResults.length > 0) {
                    const maxPage = Math.max(...allResults.map(r => r.page || 1));
                    this.state.pages[type] = maxPage + 1;
                    this.state.hasMore[type] = true;
                } else {
                    this.state.hasMore[type] = false;
                }
            } else {
                const res = await fetch(url);
                const data = await res.json();
                
                const allResults = data.results || [];
                const newResults = allResults.slice(prevCount);
                this.state.results[type] = allResults;
                this.state.totalCount = data.count || allResults.length;
                
                console.log(`[API Response] 全体=${allResults.length}, 新規=${newResults.length}`);
                
                if (newResults.length > 0) {
                    const maxPage = Math.max(...allResults.map(r => r.page || 1));
                    this.state.pages[type] = maxPage + 1;
                    this.state.hasMore[type] = true;
                } else {
                    this.state.hasMore[type] = false;
                }
            }

            this.renderResults();
        } catch (e) {
            console.error('[fetchData] エラー:', e);
            this.refs.stats.textContent = "読み込みエラーが発生しました";
            this.state.hasMore[type] = false;
        } finally {
            this.state.loading = false;
            this.updateLoadMoreButton();
            this.toggleLoader(this.state.type !== 'web' && this.state.hasMore[type]);
            this.flushPendingFetch();
        }
    },

    loadMore() {
        const type = this.state.type;
        console.log(`[loadMore] type=${type}, hasMore=${this.state.hasMore[type]}, loading=${this.state.loading}`);
        
        if (type === 'web') {
            // Web検索は5ページ分まとめて取得
            const currentPage = this.state.pages[type];
            const targetPage = Math.min(currentPage + PAGES_PER_BATCH - 1, currentPage + PAGES_PER_BATCH);
            console.log(`[loadMore Web] ${currentPage}ページから${targetPage}ページまで取得`);
            this.state.pages[type] = targetPage;
        }
        
        if (this.state.hasMore[type] && !this.state.loading) {
            this.fetchData(false);
        }
    },

    updateLoadMoreButton() {
        const type = this.state.type;
        if (type === 'web' && this.state.hasMore[type] && !this.state.loading) {
            this.refs.loadMoreBtn.classList.remove('hidden');
        } else {
            this.refs.loadMoreBtn.classList.add('hidden');
        }
    },

    flushPendingFetch() {
        const p = this.state.pendingFetch;
        if (!p) return;
        if (p.q === this.state.q && p.type === this.state.type && !this.state.loading) {
            this.state.pendingFetch = null;
            setTimeout(() => this.fetchData(!!p.reset), 0);
        }
    },

    toggleLoader(show) {
        this.refs.loader.classList.toggle('visible', show);
    },

    renderSkeleton() {
        const type = this.state.type;
        let html = '';
        if (type === 'web' || type === 'news') {
            for(let i=0; i<4; i++) html += `<div class="web-item"><div class="sk-title skeleton"></div><div class="sk-line skeleton"></div><div class="sk-line skeleton" style="width:80%"></div></div>`;
        } else if (type === 'image') {
            html = '<div class="image-grid">';
            for(let i=0; i<10; i++) html += '<div class="img-card skeleton"></div>';
            html += '</div>';
        } else if (type === 'video') {
            for(let i=0; i<4; i++) html += `<div class="video-item"><div class="video-thumb skeleton"></div><div style="flex:1"><div class="sk-title skeleton"></div><div class="sk-line skeleton"></div></div></div>`;
        } else if (type === 'social') {
            for(let i=0; i<4; i++) html += `<div class="social-item"><div class="social-header"><div class="social-avatar skeleton"></div><div class="sk-title skeleton" style="width:30%;height:16px;margin:0"></div></div><div class="sk-line skeleton"></div></div>`;
        }
        this.refs.container.innerHTML = html;
    },

    isInvalid(str) {
        if (!str) return true;
        const s = String(str).trim();
        return s === 'null' || s === 'undefined' || s === '';
    },

    isEmbeddable(url) {
        if (!url) return false;
        try {
            const u = new URL(url);
            const host = u.hostname.replace(/^www\./, '');
            const allowHosts = new Set(['youtube.com','m.youtube.com','youtu.be','vimeo.com','player.vimeo.com','dailymotion.com','www.dailymotion.com','dai.ly','twitch.tv','www.twitch.tv','kick.com','www.kick.com','soundcloud.com','www.soundcloud.com','bandcamp.com','open.spotify.com','music.apple.com']);
            if (host.endsWith('.bandcamp.com')) return true;
            return allowHosts.has(host);
        } catch (e) {
            return false;
        }
    },

    getNoembedUrl(targetUrl) {
        return `https://noembed.com/embed?url=${encodeURIComponent(targetUrl)}`;
    },

    sanitizeOembedHtml(html) {
        if (!html || typeof html !== 'string') return '';
        const match = html.match(/<iframe[\s\S]*?<\/iframe>/i);
        if (!match) return '';
        const tmp = document.createElement('div');
        tmp.innerHTML = match[0];
        const iframe = tmp.querySelector('iframe');
        if (!iframe) return '';
        const src = iframe.getAttribute('src') || '';
        if (!/^https?:\/\//i.test(src)) return '';
        const clean = document.createElement('iframe');
        clean.src = src;
        clean.setAttribute('loading', 'lazy');
        clean.setAttribute('referrerpolicy', 'origin-when-cross-origin');
        clean.setAttribute('allowfullscreen', '');
        clean.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share');
        clean.setAttribute('title', iframe.getAttribute('title') || 'embedded media');
        return clean.outerHTML;
    },

    async fetchOEmbed(targetUrl) {
        const cache = this.state.oembed.cache;
        if (cache[targetUrl]) return cache[targetUrl];
        const apiUrl = this.getNoembedUrl(targetUrl);
        const res = await fetch(apiUrl);
        if (!res.ok) throw new Error(`oEmbed fetch failed: ${res.status}`);
        const data = await res.json();
        if (data && data.error) throw new Error(String(data.error));
        const cleaned = {
            title: data.title || '',
            provider_name: data.provider_name || '',
            author_name: data.author_name || '',
            thumbnail_url: data.thumbnail_url || '',
            html: this.sanitizeOembedHtml(data.html || ''),
            url: data.url || targetUrl
        };
        cache[targetUrl] = cleaned;
        return cleaned;
    },

    stopAllEmbeds(exceptIndex = null) {
        const open = this.state.oembed.open;
        Object.keys(open).forEach(k => {
            const idx = parseInt(k, 10);
            if (Number.isNaN(idx)) return;
            if (exceptIndex !== null && idx === exceptIndex) return;
            if (!open[idx]) return;
            const mount = document.getElementById(`video-embed-mount-${idx}`);
            if (mount) mount.innerHTML = '';
            open[idx] = false;
        });
    },

    async openVideoEmbed(index, url) {
        if (this.state.oembed.open[index]) {
            this.stopAllEmbeds(null);
            this.renderResults();
            return;
        }
        this.stopAllEmbeds(index);
        const open = this.state.oembed.open;
        open[index] = true;
        this.renderResults();
        const mountId = `video-embed-mount-${index}`;
        const mount = document.getElementById(mountId);
        if (mount) mount.innerHTML = `<div class="video-embed-loading">埋め込みを読み込み中...</div>`;
        try {
            const o = await this.fetchOEmbed(url);
            if (!o.html) throw new Error('embed html is empty');
            const mount2 = document.getElementById(mountId);
            if (mount2) mount2.innerHTML = `<div class="video-embed">${o.html}</div>`;
        } catch (e) {
            const mount2 = document.getElementById(mountId);
            if (mount2) mount2.innerHTML = `<div class="video-embed-error">埋め込みの取得に失敗しました</div>`;
            console.error(e);
        }
    },

    renderKnowledgePanel(panelData) {
        if (!panelData) return '';
        const wikiResult = panelData.results?.find(r => r.wiki_priority) || null;
        if (!wikiResult) return '';
        const panel = panelData.featured_panel || {};
        const wikiTitle = panelData.wiki_title || this.state.q;
        let description = '';
        if (panel.description) {
            description = panel.description;
        } else if (wikiResult.summary) {
            description = wikiResult.summary.substring(0, 300);
            if (wikiResult.summary.length > 300) description += '...';
        }
        return `
            <div class="knowledge-panel">
                <div class="panel-header">
                    ${panel.image_url ? `<img src="${panel.image_url}" class="panel-image" alt="${wikiTitle}">` : ''}
                    <div class="panel-info">
                        <h2 class="panel-title">${wikiTitle}</h2>
                        ${panel.subtitle ? `<div class="panel-subtitle">${panel.subtitle}</div>` : ''}
                    </div>
                </div>
                ${description ? `<div class="panel-description">${description}</div>` : ''}
                ${panel.facts && panel.facts.length > 0 ? `
                    <div class="panel-facts">
                        ${panel.facts.map(fact => `
                            <div class="panel-fact">
                                <span class="panel-fact-label">${fact.label}:</span>
                                <span class="panel-fact-value">${fact.value}</span>
                            </div>
                        `).join('')}
                    </div>
                ` : ''}
                <div class="panel-source">
                    <a href="${wikiResult.url}" target="_blank">Wikipedia</a> より
                </div>
            </div>
        `;
    },

    renderResults() {
        const type = this.state.type;
        const list = this.state.results[type];
        if (list.length > 0) {
            this.refs.stats.textContent = `約 ${this.state.totalCount.toLocaleString()} 件`;
        } else if (!this.state.loading) {
            this.refs.stats.textContent = '見つかりませんでした';
        }
        if (type === 'web') this.renderWebList(list);
        else if (type === 'image') this.renderImageGrid(list);
        else if (type === 'video') this.renderVideoList(list);
        else if (type === 'news') this.renderNewsList(list);
        else if (type === 'social') this.renderSocialList(list);
        
        this.updateLoadMoreButton();
    },

    renderWebList(list) {
        let html = '';
        if (this.state.panelData) html += this.renderKnowledgePanel(this.state.panelData);
        html += list.map(item => {
            if (this.isInvalid(item.title) && this.isInvalid(item.summary)) return '';
            return `
            <div class="web-item">
                <div class="web-cite">
                    ${item.favicon ? `<img src="${item.favicon}" onerror="this.style.display='none'">` : ''}
                    <span>${new URL(item.url).hostname}</span>
                </div>
                <a href="${item.url}" target="_blank" class="web-title">${item.title || 'No Title'}</a>
                <div class="web-desc">${item.summary || ''}</div>
            </div>
            `;
        }).join('');
        this.refs.container.innerHTML = html;
    },

    renderVideoList(list) {
        this.refs.container.innerHTML = list.map((item, index) => {
            if (this.isInvalid(item.title)) return '';
            const canEmbed = this.isEmbeddable(item.url);
            const isOpen = !!this.state.oembed.open[index];
            const host = new URL(item.url).hostname;
            const faviconUrl = `https://www.google.com/s2/favicons?domain=${encodeURIComponent(host)}&sz=32`;
            return `
            <div class="video-item ${isOpen ? 'is-active' : ''}" onclick="window.open('${item.url}')">
                <div class="video-thumb" onclick="event.stopPropagation(); ${canEmbed ? `app.openVideoEmbed(${index}, '${item.url.replace(/'/g, "\\'")}')` : `window.open('${item.url}')`} ">
                    <img src="${item.thumbnail || ''}" onerror="this.src='//placehold.co/320x180/eee/999?text=No+Thumb'">
                    <div class="video-play-btn" aria-hidden="true"><svg viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>
                </div>
                <div class="video-info">
                    <div class="video-title">${item.title || 'No Title'}</div>
                    <div class="video-meta">
                        <img class="video-favicon" src="${faviconUrl}" onerror="this.style.display='none'" alt="">
                        <span>${host}</span>
                        ${item.duration ? `• ${item.duration}` : ''}
                        ${item.publishedDate ? `• ${item.publishedDate}` : ''}
                        ${canEmbed ? (isOpen ? '• 再生中(タップで停止)' : '• 埋め込み対応') : ''}
                    </div>
                    <div class="video-desc">${item.summary || ''}</div>
                    ${canEmbed && isOpen ? `<div id="video-embed-mount-${index}"></div>` : ''}
                </div>
            </div>
            `;
        }).join('');
    },

    renderNewsList(list) {
        this.refs.container.innerHTML = list.map(item => {
             return `
            <div class="news-item">
                <div class="news-source">
                    ${item.favicon ? `<img src="${item.favicon}" style="width:16px;height:16px;">` : ''}
                    <span>${new URL(item.url).hostname}</span>
                </div>
                <a href="${item.url}" target="_blank" class="news-title">${item.title || 'No Title'}</a>
                <div class="web-desc">${item.summary || ''}</div>
                <div class="news-date" style="margin-top:4px;color:#70757a">${item.publishedDate || ''}</div>
            </div>
            `;
        }).join('');
    },

    renderSocialList(list) {
        const formatText = (text) => {
            if (!text) return '';
            let t = text.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
            t = t.replace(/(https?:\/\/[^\s]+)/g, '<a href="$1" target="_blank" rel="noopener noreferrer" onclick="event.stopPropagation()" style="color:#1a0dab;text-decoration:none;">$1</a>');
            t = t.replace(/\n/g, '<br>');
            return t;
        };
        this.refs.container.innerHTML = list.map(item => {
            let imagesHtml = '';
            if (item.hasImages && item.images && item.images.length > 0) {
                const imgCount = item.images.length;
                const displayImages = item.images.slice(0, 4);
                const gridClass = `count-${Math.min(imgCount, 4)}`;
                imagesHtml = `
                <div class="social-images ${gridClass}">
                    ${displayImages.map(img => `
                        <div class="social-img-wrap" onclick="event.stopPropagation(); modal.openImage('${img.url}')">
                            <img src="${img.thumbnailUrl}" alt="" loading="lazy" onerror="this.style.display='none'">
                        </div>
                    `).join('')}
                </div>
                ${imgCount > 4 ? `<div class="social-img-more">+${imgCount - 4}枚の画像</div>` : ''}
                `;
            }
            const contentHtml = formatText(item.summary || item.content || item.title);
            return `
            <div class="social-item" style="cursor:pointer" onclick="window.open('${item.url}')">
                <div class="social-header">
                    ${item.favicon ? `<img src="${item.favicon}" class="social-avatar" onerror="this.style.display='none'">` : '<div class="social-avatar"></div>'}
                    <span class="social-author">${item.author || new URL(item.url).hostname}</span>
                    <span class="social-date">${item.publishedDate || ''}</span>
                </div>
                <div class="social-content">${contentHtml}</div>
                ${imagesHtml}
            </div>
            `;
        }).join('');
    },

    renderImageGrid(list) {
        let html = '<div class="image-grid">';
        html += list.map((item, index) => {
            if (this.isInvalid(item.thumbnail)) return '';
            return `
            <div class="img-card" onclick="modal.open(${index})">
                <img src="${item.thumbnail}" loading="lazy">
                <div class="overlay"><div style="font-size:12px">${item.title || ''}</div></div>
            </div>
            `;
        }).join('');
        html += '</div>';
        this.refs.container.innerHTML = html;
    }
};

const modal = {
    el: document.getElementById('modal'),
    img: document.getElementById('modalImg'),
    title: document.getElementById('modalTitle'),
    open(index) {
        const item = app.state.results.image[index];
        if(!item) return;
        this.img.src = item.thumbnail;
        this.title.textContent = item.title;
        this.el.classList.add('open');
        document.body.style.overflow = 'hidden';
    },
    openImage(url) {
        this.img.src = url;
        this.title.textContent = '';
        this.el.classList.add('open');
        document.body.style.overflow = 'hidden';
    },
    close() {
        this.el.classList.remove('open');
        document.body.style.overflow = '';
    }
};

app.init();
</script>

</body>
</html>