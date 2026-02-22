<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>wholphin - 高速でシンプルな検索体験</title>
    <meta name="description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。ウェブ、画像、動画を素早く検索できます。">
    <meta name="keywords" content="検索, 検索エンジン, wholphin, 日本語検索, 高速検索">

    <meta property="og:type" content="website">
    <meta property="og:url" content="https://wholphin.net/">
    <meta property="og:title" content="wholphin - 高速でシンプルな検索体験">
    <meta property="og:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">
    <meta property="og:site_name" content="wholphin">
    <meta property="og:locale" content="ja_JP">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="https://wholphin.net/">
    <meta name="twitter:title" content="wholphin - 高速でシンプルな検索体験">
    <meta name="twitter:description" content="wholphin は高速でシンプルな検索体験を提供する日本語対応の検索サービスです。">

    <link rel="canonical" href="https://wholphin.net/">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#E5E5E5">
    <meta name="theme-color" content="#E5E5E5" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#171717" media="(prefers-color-scheme: dark)" />

    <link rel="apple-touch-icon" href="/android-chrome-192x192.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel=“icon” href=“/favicon.ico” type=“image/x-icon”>
    <link rel="search"
          type="application/opensearchdescription+xml"
          title="wholphin"
          href="/opensearch.xml">

    <!-- --- Structured Data (JSON-LD) --- -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "wholphin",
      "url": "https://wholphin.net/",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://wholphin.net/search?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    </script>

    <!-- 1. Preconnect: 接続確立を早期化 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- 2. Preload Critical Fonts: ロゴと本文用フォントを優先読み込み -->
    <!-- これにより optional でも表示される確率が上がります -->
    <link rel="preload" href="https://fonts.gstatic.com/s/merriweathersans/v28/2-c79IRs1JiJN1FRAMjTN5zd9vgsFHXwcjfj9zlcxZI.woff2" as="font" type="font/woff2" crossorigin>

    <!-- 3. CSS for Font Loading Strategy (Inline) -->
    <style>
        /* レイアウトシフト対策: 代替フォントのサイズ調整 (size-adjust) */
        /* Noto Sans JP の代替として sans-serif (実質 Arial/Helvetica/Hiragino) を調整 */
        @font-face {
            font-family: "Noto Sans JP Fallback";
            src: local("sans-serif");
            ascent-override: 88%;  /* 上部の隙間調整 */
            descent-override: 12%; /* 下部の隙間調整 */
            size-adjust: 98%;      /* 文字幅をNoto Sans JPに寄せる */
        }

        /* Merriweather Sans の代替 */
        @font-face {
            font-family: "Merriweather Sans Fallback";
            src: local("sans-serif");
            size-adjust: 105%; /* イタリックや太字での幅ズレを補正 */
        }

        :root {
            --primary: #1a73e8;
            --text-main: #202124;
            --text-sub: #5f6368;
            --bg-body: #ffffff;
            --bg-surface: #ffffff;
            --bg-hover: #f1f3f4;
            --border: #dfe1e5;
            --shadow-soft: 0 1px 6px rgba(32,33,36,0.18);
            --radius-l: 24px;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --primary: #8ab4f8;
                --text-main: #e8eaed;
                --text-sub: #9aa0a6;
                --bg-body: #202124;
                --bg-surface: #303134;
                --bg-hover: #3c4043;
                --border: #5f6368;
                --shadow-soft: 0 1px 6px rgba(0,0,0,0.3);
            }
        }
        
        body {
            margin: 0; padding: 0;
            /* ウェブフォントがロードされるまでは調整済み代替フォントを表示 */
            font-family: "Noto Sans JP", "Noto Sans JP Fallback", sans-serif;
            background: var(--bg-body);
            color: var(--text-main);
            height: 100vh;
            overflow-x: hidden;
        }

        .main {
            display: flex;
            justify-content: center;
            padding-top: 20vh;
            min-height: 100vh;
            contain: layout;
        }
        .stage {
            width: 100%;
            max-width: 584px;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 16px;
        }

        /* ロゴのガタつき防止: 高さ固定とフォント指定 */
        .logo-area {
            min-height: 120px;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.85;
            /* レイアウトが確定するまで描画を保留せず、サイズだけ確保 */
            contain: size layout;
        }
        .logo {
            font-family: "Merriweather Sans", "Merriweather Sans Fallback", sans-serif;
            font-weight: 700;
            font-style: italic;
            font-size: 72px;
            line-height: 1;
            height: 72px;
            color: var(--text-main);
            text-decoration: none;
            display: inline-block;
            white-space: nowrap; /* 折り返しによるズレ防止 */
        }

        .search-container {
            width: 100%;
            position: relative;
            z-index: 100;
            height: 48px;
        }
        .search-box-wrap {
            position: relative;
            display: flex;
            align-items: center;
            height: 48px;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-l);
            padding: 0 14px;
            box-shadow: var(--shadow-soft);
        }
        .search-input {
            flex: 1;
            border: none;
            background: transparent;
            font-size: 16px;
            color: var(--text-main);
            outline: none;
            height: 100%;
            padding: 0 8px;
        }

        @media (max-width: 600px) {
            .logo { font-size: 56px; height: 56px; }
            .logo-area { min-height: 100px; margin-bottom: 24px; }
        }
.announcement-banner {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1000;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-100%);
    transition: transform 0.3s ease-out;
    max-height: 0;
    overflow: hidden;
}

.announcement-banner.show {
    transform: translateY(0);
    max-height: 80px;
}

.announcement-content {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px 16px;
    max-width: 1200px;
    margin: 0 auto;
    gap: 12px;
}

.announcement-icon {
    flex-shrink: 0;
    display: flex;
    align-items: center;
}

.announcement-icon svg {
    fill: currentColor;
}

.announcement-text {
    flex: 1;
    font-size: 14px;
    line-height: 1.5;
    font-weight: 500;
    text-align: center;
}

.announcement-text a {
    color: #ffffff;
    text-decoration: underline;
    font-weight: 700;
}

.dismiss-btn {
    flex-shrink: 0;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    width: 32px;
    height: 32px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s;
}

.dismiss-btn:hover {
    background: rgba(255, 255, 255, 0.3);
}

.dismiss-btn svg {
    fill: currentColor;
}

/* バナー表示時のbody調整 */
body.banner-active {
    padding-top: 56px;
}

@media (max-width: 600px) {
    .announcement-text {
        font-size: 13px;
    }
    .announcement-content {
        padding: 10px 12px;
    }
}

    </style>

    <!-- 4. Web Fonts: display=optional でレイアウトシフトを撲滅 -->
    <!-- 重要: 末尾に &display=optional を付与 -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@1,300;1,700&family=Noto+Sans+JP:wght@400;500;700&display=optional">
    
    <!-- メインCSSは遅延読み込み -->
    <link rel="stylesheet" href="index.css" media="print" onload="this.media='all'">
        <link rel="stylesheet" href="fonts.css" media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="index.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@1,300;1,700&family=Noto+Sans+JP:wght@400;500;700&display=optional">
    </noscript>
</head>
<body>

<header class="app-header">
    <a href="about" class="nav-link">About</a>
</header>

<!-- お知らせバナー -->
<div id="announcementBanner" class="announcement-banner" role="alert" aria-live="polite">
    <div class="announcement-content">
        <span class="announcement-icon">
            <svg viewBox="0 0 24 24" width="20" height="20">
                <path d="M11 15h2v2h-2zm0-8h2v6h-2zm1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
            </svg>
        </span>
        <span class="announcement-text" id="announcementText"></span>
        <button id="dismissBanner" class="dismiss-btn" aria-label="閉じる">
            <svg viewBox="0 0 24 24" width="18" height="18">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
    </div>
</div>

<main class="main">
    <div class="stage">
        <div class="logo-area">
            <h1 class="logo">
                <a href="index.php" class="logo">wholphin</a>
            </h1>
        </div>

        <div class="search-container">
            <div class="search-box-wrap" id="searchBoxWrap">
                <button id="mobileBackBtn" class="mobile-back-btn" aria-label="戻る">
                    <svg viewBox="0 0 24 24"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                </button>

                <div class="search-icon-left">
                    <svg viewBox="0 0 24 24"><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/></svg>
                </div>

                <input type="text" id="searchInput" class="search-input" placeholder="検索または URL を入力" autocomplete="off">

                <div class="action-btn-area">
                    <button id="clearBtn" class="icon-btn clear-btn" aria-label="クリア">
                        <svg viewBox="0 0 24 24"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
                    </button>
                    <button id="micBtn" class="icon-btn mic-btn" aria-label="音声検索">
                        <svg viewBox="0 0 24 24"><path d="M12 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3S9 3.34 9 5v6c0 1.66 1.34 3 3 3z"/><path d="M17 11c0 2.76-2.24 5-5 5s-5-2.24-5-5H5c0 3.53 2.61 6.43 6 6.92V21h2v-3.08c3.39-.49 6-3.39 6-6.92h-2z"/></svg>
                    </button>
                </div>

                <div id="suggestList" class="suggest-list"></div>
            </div>
        </div>
    </div>
</main>

<footer class="app-footer">
    <div class="footer-left">
        <a href="/help" class="footer-link">ヘルプ</a>
        <a href="/privacy" class="footer-link">プライバシー</a>
        <a href="/terms" class="footer-link">利用規約</a>
    </div>
</footer>

<script src="index.js" defer></script>
  <script>
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js')
          .then(reg => console.log('SW registered:', reg.scope))
          .catch(err => console.log('SW registration failed:', err));
      });
    }

// お知らせバナー管理
(function() {
    const banner = document.getElementById('announcementBanner');
    const dismissBtn = document.getElementById('dismissBanner');
    const announcementText = document.getElementById('announcementText');
    
    // ▼▼▼ 設定エリア ▼▼▼
    const announcement = {
        id: 'banner_maintenance_202602',
        message: 'Wholphin Searchの設備メンテナンスについて',
        link: 'https://p2pear.asia/blog_post?slug=wholphin-search&utm_source=blog', 
        startDate: '2026-02-16',
        endDate: '2026-02-16',
        isDismissible: false 
    };
    // ▲▲▲ 設定エリア ▲▲▲
    
    // 表示判定
    function shouldShowBanner() {
        const now = new Date();
        const start = new Date(announcement.startDate);
        const end = new Date(announcement.endDate);

        if (now < start || now > end) return false;

        // 閉じるボタンが有効(true)の場合のみ、過去の履歴(localStorage)をチェック
        if (announcement.isDismissible) {
            const dismissed = localStorage.getItem('dismissed_banner');
            if (dismissed === announcement.id) return false;
        }
        
        return true;
    }
    
    // バナー表示処理
    function showBanner() {
        if (!shouldShowBanner()) return;
        
        // テキストとリンクの設定
        if (announcement.link) {
            const url = typeof announcement.link === 'string' ? announcement.link : announcement.link.url;
            // 変更点: デフォルトテキストを '>' に変更
            const text = (typeof announcement.link === 'object' && announcement.link.text) ? announcement.link.text : '>';
            
            // 変更点: '>' のためにスタイル調整 (下線を消して太字に、左マージンを確保)
            announcementText.innerHTML = `${announcement.message}<a href="${url}" target="_blank" rel="noopener" style="text-decoration: none; font-weight: bold; margin-left: 0.5em; display: inline-block;">${text}</a>`;
        } else {
            announcementText.textContent = announcement.message;
        }

        // 閉じるボタンの制御
        if (dismissBtn) {
            if (announcement.isDismissible) {
                dismissBtn.style.display = 'flex';
                dismissBtn.onclick = () => {
                    banner.classList.remove('show');
                    document.body.classList.remove('banner-active');
                    localStorage.setItem('dismissed_banner', announcement.id);
                    // アニメーション完了後に非表示
                    setTimeout(() => { banner.style.display = 'none'; }, 300);
                };
            } else {
                dismissBtn.style.display = 'none';
            }
        }
        
        // アニメーション表示
        setTimeout(() => {
            banner.classList.add('show');
            document.body.classList.add('banner-active');
        }, 300);
    }
    
    // 初期化実行
    showBanner();
})();

  </script>
</body>
</html>