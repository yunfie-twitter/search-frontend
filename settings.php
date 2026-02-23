<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# website: http://ogp.me/ns/website#">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title>設定 - wholphin</title>
    <meta name="description" content="wholphinの検索設定をカスタマイズして、あなたに最適な検索体験を実現しましょう。">

    <link rel="canonical" href="https://wholphin.net/settings">
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#E5E5E5">
    <meta name="theme-color" content="#E5E5E5" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#171717" media="(prefers-color-scheme: dark)" />

    <link rel="apple-touch-icon" href="/android-chrome-192x192.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@1,300;1,700&family=Noto+Sans+JP:wght@400;500;700&display=optional" rel="stylesheet">
    
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="settings.css">
</head>
<body>

<header class="app-header">
    <a href="about" class="nav-link">About</a>
</header>

<main class="main">
    <div class="stage settings-stage">
        <div class="logo-area">
            <h1 class="logo">
                <a href="index.php" class="logo">wholphin</a>
            </h1>
        </div>

        <div class="settings-header">
            <h2 class="settings-title">設定</h2>
            <p class="settings-subtitle">あなたに最適な検索体験をカスタマイズ</p>
        </div>

        <div class="settings-container">
            <!-- Search Settings -->
            <section class="settings-section">
                <h3 class="section-title">検索設定</h3>
                
                <div class="setting-item">
                    <div class="setting-label">
                        <label for="resultsPerPage">表示件数</label>
                        <span class="setting-desc">1ページあたりの検索結果数</span>
                    </div>
                    <select id="resultsPerPage" class="setting-select">
                        <option value="10">10件</option>
                        <option value="20" selected>20件</option>
                        <option value="30">30件</option>
                        <option value="50">50件</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label for="safeSearch">セーフサーチ</label>
                        <span class="setting-desc">不適切なコンテンツのフィルタリング</span>
                    </div>
                    <select id="safeSearch" class="setting-select">
                        <option value="strict">完全</option>
                        <option value="moderate" selected>中程度</option>
                        <option value="off">オフ</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label for="searchLanguage">検索言語</label>
                        <span class="setting-desc">優先して表示する言語</span>
                    </div>
                    <select id="searchLanguage" class="setting-select">
                        <option value="ja" selected>日本語</option>
                        <option value="en">英語</option>
                        <option value="zh">中国語</option>
                        <option value="ko">韓国語</option>
                        <option value="all">すべて</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label for="searchRegion">地域設定</label>
                        <span class="setting-desc">検索結果の地域性</span>
                    </div>
                    <select id="searchRegion" class="setting-select">
                        <option value="jp" selected>日本</option>
                        <option value="us">アメリカ</option>
                        <option value="uk">イギリス</option>
                        <option value="global">グローバル</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label>新しいタブで開く</label>
                        <span class="setting-desc">検索結果を新しいタブで表示</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="openInNewTab">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label>オートコンプリート</label>
                        <span class="setting-desc">検索候補を自動表示</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="autocomplete" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </section>

            <!-- Appearance Settings -->
            <section class="settings-section">
                <h3 class="section-title">表示設定</h3>
                
                <div class="setting-item">
                    <div class="setting-label">
                        <label for="theme">テーマ</label>
                        <span class="setting-desc">色テーマの選択</span>
                    </div>
                    <select id="theme" class="setting-select">
                        <option value="auto" selected>システム設定</option>
                        <option value="light">ライト</option>
                        <option value="dark">ダーク</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label for="fontSize">フォントサイズ</label>
                        <span class="setting-desc">検索結果の文字サイズ</span>
                    </div>
                    <select id="fontSize" class="setting-select">
                        <option value="small">小</option>
                        <option value="medium" selected>中</option>
                        <option value="large">大</option>
                    </select>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label>スムーススクロール</label>
                        <span class="setting-desc">滞らかなスクロール効果</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="smoothScroll" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label>アニメーション</label>
                        <span class="setting-desc">UIアニメーションを有効化</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="animations" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </section>

            <!-- Privacy Settings -->
            <section class="settings-section">
                <h3 class="section-title">プライバシー</h3>
                
                <div class="setting-item">
                    <div class="setting-label">
                        <label>検索履歴</label>
                        <span class="setting-desc">ローカルに検索履歴を保存</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="searchHistory">
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-item">
                    <div class="setting-label">
                        <label>Cookie</label>
                        <span class="setting-desc">設定保存用Cookieを許可</span>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" id="cookies" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>

                <div class="setting-item setting-item-button">
                    <button class="clear-button" id="clearHistory">
                        <svg viewBox="0 0 24 24" width="18" height="18">
                            <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
                        </svg>
                        検索履歴を消去
                    </button>
                </div>
            </section>

            <!-- Action Buttons -->
            <div class="settings-actions">
                <button class="btn-primary" id="saveSettings">設定を保存</button>
                <button class="btn-secondary" id="resetSettings">デフォルトに戻す</button>
            </div>

            <div class="settings-notice">
                <svg viewBox="0 0 24 24" width="16" height="16">
                    <path d="M11 15h2v2h-2zm0-8h2v6h-2zm1-5C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                </svg>
                設定はこのブラウザにのみ保存されます
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

<script>
// Settings management
const SETTINGS_KEY = 'wholphin_settings';

// Default settings
const defaultSettings = {
    resultsPerPage: '20',
    safeSearch: 'moderate',
    searchLanguage: 'ja',
    searchRegion: 'jp',
    openInNewTab: false,
    autocomplete: true,
    theme: 'auto',
    fontSize: 'medium',
    smoothScroll: true,
    animations: true,
    searchHistory: false,
    cookies: true
};

// Load settings from localStorage
function loadSettings() {
    const saved = localStorage.getItem(SETTINGS_KEY);
    return saved ? { ...defaultSettings, ...JSON.parse(saved) } : defaultSettings;
}

// Save settings to localStorage
function saveSettings(settings) {
    localStorage.setItem(SETTINGS_KEY, JSON.stringify(settings));
}

// Apply settings to form
function applySettingsToForm(settings) {
    document.getElementById('resultsPerPage').value = settings.resultsPerPage;
    document.getElementById('safeSearch').value = settings.safeSearch;
    document.getElementById('searchLanguage').value = settings.searchLanguage;
    document.getElementById('searchRegion').value = settings.searchRegion;
    document.getElementById('openInNewTab').checked = settings.openInNewTab;
    document.getElementById('autocomplete').checked = settings.autocomplete;
    document.getElementById('theme').value = settings.theme;
    document.getElementById('fontSize').value = settings.fontSize;
    document.getElementById('smoothScroll').checked = settings.smoothScroll;
    document.getElementById('animations').checked = settings.animations;
    document.getElementById('searchHistory').checked = settings.searchHistory;
    document.getElementById('cookies').checked = settings.cookies;
}

// Get settings from form
function getSettingsFromForm() {
    return {
        resultsPerPage: document.getElementById('resultsPerPage').value,
        safeSearch: document.getElementById('safeSearch').value,
        searchLanguage: document.getElementById('searchLanguage').value,
        searchRegion: document.getElementById('searchRegion').value,
        openInNewTab: document.getElementById('openInNewTab').checked,
        autocomplete: document.getElementById('autocomplete').checked,
        theme: document.getElementById('theme').value,
        fontSize: document.getElementById('fontSize').value,
        smoothScroll: document.getElementById('smoothScroll').checked,
        animations: document.getElementById('animations').checked,
        searchHistory: document.getElementById('searchHistory').checked,
        cookies: document.getElementById('cookies').checked
    };
}

// Apply theme
function applyTheme(theme) {
    if (theme === 'auto') {
        document.documentElement.removeAttribute('data-theme');
    } else {
        document.documentElement.setAttribute('data-theme', theme);
    }
}

// Show notification
function showNotification(message) {
    // Simple alert for now - can be replaced with custom notification
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.classList.add('show');
    }, 10);
    
    setTimeout(() => {
        notification.classList.remove('show');
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}

// Initialize
const currentSettings = loadSettings();
applySettingsToForm(currentSettings);
applyTheme(currentSettings.theme);

// Save button
document.getElementById('saveSettings').addEventListener('click', () => {
    const settings = getSettingsFromForm();
    saveSettings(settings);
    applyTheme(settings.theme);
    showNotification('設定を保存しました');
});

// Reset button
document.getElementById('resetSettings').addEventListener('click', () => {
    if (confirm('すべての設定をデフォルトに戻しますか？')) {
        saveSettings(defaultSettings);
        applySettingsToForm(defaultSettings);
        applyTheme(defaultSettings.theme);
        showNotification('設定をリセットしました');
    }
});

// Clear history button
document.getElementById('clearHistory').addEventListener('click', () => {
    if (confirm('検索履歴を消去しますか？')) {
        // Clear search history from localStorage
        localStorage.removeItem('wholphin_search_history');
        showNotification('検索履歴を消去しました');
    }
});

// Theme change preview
document.getElementById('theme').addEventListener('change', (e) => {
    applyTheme(e.target.value);
});
</script>

</body>
</html>