<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>エラー - wholphin</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@400..700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="about.css">

<style>
/* エラーページ専用スタイル */
.error-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 40px 24px;
    text-align: center;
}

.error-code {
    font-size: 120px;
    font-weight: 800;
    line-height: 1;
    background: linear-gradient(135deg, var(--primary) 0%, rgba(26, 115, 232, 0.5) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 24px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.1s forwards;
}

.error-code.emoji {
    background: none;
    -webkit-text-fill-color: currentColor;
    color: var(--text-main);
}

.error-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 16px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.2s forwards;
}

.error-message {
    font-size: 16px;
    color: var(--text-sub);
    line-height: 1.7;
    max-width: 500px;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.3s forwards;
}

.error-search {
    width: 100%;
    max-width: 600px;
    margin-bottom: 32px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.4s forwards;
}

.error-search-wrapper {
    position: relative;
}

.error-search-box {
    width: 100%;
    height: 56px;
    padding: 0 20px 0 56px;
    border: 2px solid var(--border);
    border-radius: 28px;
    font-size: 16px;
    color: var(--text-main);
    background: var(--bg-surface);
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
}

.error-search-box:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 4px rgba(26, 115, 232, 0.1);
}

.error-search-icon {
    position: absolute;
    left: 20px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    fill: var(--icon-color);
}

.error-actions {
    display: flex;
    gap: 16px;
    flex-wrap: wrap;
    justify-content: center;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.5s forwards;
}

.error-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    height: 48px;
    padding: 0 28px;
    border-radius: 24px;
    font-size: 15px;
    font-weight: 600;
    text-decoration: none;
    transition: transform 0.2s, box-shadow 0.2s;
    cursor: pointer;
    border: none;
}

.error-btn-primary {
    background: var(--text-main);
    color: var(--bg-base);
}

.error-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.error-btn-secondary {
    background: var(--bg-surface);
    color: var(--text-main);
    border: 1px solid var(--border);
}

.error-btn-secondary:hover {
    background: var(--bg-hover);
    transform: translateY(-1px);
}

.error-illustration {
    width: 100%;
    max-width: 300px;
    margin-bottom: 40px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.6s forwards;
}

.error-illustration svg {
    width: 100%;
    height: auto;
}

.error-suggestions {
    margin-top: 48px;
    opacity: 0;
    animation: fadeIn 0.8s var(--ease-out) 0.7s forwards;
}

.error-suggestions h3 {
    font-size: 18px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 16px;
}

.error-suggestions ul {
    list-style: none;
    padding: 0;
    text-align: left;
    display: inline-block;
}

.error-suggestions li {
    font-size: 15px;
    color: var(--text-sub);
    padding-left: 24px;
    margin-bottom: 8px;
    position: relative;
    line-height: 1.6;
}

.error-suggestions li::before {
    content: '•';
    position: absolute;
    left: 8px;
    color: var(--primary);
    font-weight: bold;
}

.maintenance-info {
    background: rgba(251, 191, 36, 0.1);
    border: 1px solid rgba(251, 191, 36, 0.3);
    border-radius: 12px;
    padding: 20px 24px;
    margin-top: 24px;
    max-width: 500px;
    text-align: left;
}

.maintenance-info h4 {
    font-size: 16px;
    font-weight: 600;
    color: var(--text-main);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.maintenance-info p {
    font-size: 14px;
    color: var(--text-main);
    line-height: 1.6;
    margin-bottom: 8px;
}

.maintenance-info p:last-child {
    margin-bottom: 0;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* 404専用イラスト */
.whale-404 {
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

@media (max-width: 600px) {
    .error-code {
        font-size: 80px;
    }
    
    .error-title {
        font-size: 24px;
    }
    
    .error-actions {
        flex-direction: column;
        width: 100%;
    }
    
    .error-btn {
        width: 100%;
        justify-content: center;
    }
    
    .error-illustration {
        max-width: 240px;
    }
}

@media (prefers-color-scheme: dark) {
    .error-btn-primary:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.5);
    }
    
    .maintenance-info {
        background: rgba(251, 191, 36, 0.15);
        border-color: rgba(251, 191, 36, 0.4);
    }
}
</style>

</head>
<body>

<div style="position:fixed; top:-20%; right:-10%; width:60vw; height:60vw; background:radial-gradient(circle, rgba(26,115,232,0.03) 0%, transparent 60%); pointer-events:none; z-index:-1;"></div>

<nav class="nav-header">
    <a href="/" class="brand-logo">wholphin</a>
</nav>

<div class="error-container">
    <!-- クジラのイラスト -->
    <div class="error-illustration">
        <svg class="whale-404" viewBox="0 0 240 160" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- 水面の波 -->
            <path d="M 0 100 Q 30 95, 60 100 T 120 100 T 180 100 T 240 100" stroke="rgba(26, 115, 232, 0.2)" stroke-width="2" fill="none"/>
            <path d="M 0 110 Q 30 105, 60 110 T 120 110 T 180 110 T 240 110" stroke="rgba(26, 115, 232, 0.15)" stroke-width="2" fill="none"/>
            
            <!-- クジラの体 -->
            <ellipse cx="120" cy="90" rx="50" ry="30" fill="rgba(26, 115, 232, 0.8)"/>
            
            <!-- クジラの尾 -->
            <path d="M 70 85 Q 50 85, 40 75 L 35 80 L 40 90 Q 50 95, 70 90 Z" fill="rgba(26, 115, 232, 0.7)"/>
            
            <!-- クジラのヒレ -->
            <path d="M 170 75 Q 180 65, 175 85 Z" fill="rgba(26, 115, 232, 0.6)"/>
            
            <!-- 目 -->
            <circle cx="140" cy="85" r="3" fill="#ffffff"/>
            <circle cx="140" cy="85" r="1.5" fill="#000000"/>
            
            <!-- 口 -->
            <path d="M 145 92 Q 150 95, 155 92" stroke="rgba(255, 255, 255, 0.5)" stroke-width="1.5" stroke-linecap="round" fill="none"/>
            
            <!-- 噴水 -->
            <g opacity="0.7">
                <circle cx="115" cy="50" r="2" fill="rgba(26, 115, 232, 0.4)">
                    <animate attributeName="cy" values="50;30;50" dur="2s" repeatCount="indefinite"/>
                    <animate attributeName="opacity" values="0.7;0;0.7" dur="2s" repeatCount="indefinite"/>
                </circle>
                <circle cx="120" cy="45" r="2.5" fill="rgba(26, 115, 232, 0.5)">
                    <animate attributeName="cy" values="45;20;45" dur="2s" repeatCount="indefinite" begin="0.2s"/>
                    <animate attributeName="opacity" values="0.7;0;0.7" dur="2s" repeatCount="indefinite" begin="0.2s"/>
                </circle>
                <circle cx="125" cy="48" r="2" fill="rgba(26, 115, 232, 0.4)">
                    <animate attributeName="cy" values="48;28;48" dur="2s" repeatCount="indefinite" begin="0.4s"/>
                    <animate attributeName="opacity" values="0.7;0;0.7" dur="2s" repeatCount="indefinite" begin="0.4s"/>
                </circle>
            </g>
        </svg>
    </div>

    <div class="error-code" id="errorCode">404</div>
    <h1 class="error-title" id="errorTitle">ページが見つかりません</h1>
    <p class="error-message" id="errorMessage">
        お探しのページは存在しないか、移動した可能性があります。<br>
        URLを確認するか、下の検索ボックスからお探しください。
    </p>

    <!-- メンテナンス情報 (動的表示) -->
    <div class="maintenance-info" id="maintenanceInfo" style="display: none;">
        <h4>🛠️ メンテナンス情報</h4>
        <p id="maintenanceSchedule"></p>
        <p id="maintenanceDetails"></p>
    </div>

    <div class="error-search" id="errorSearch">
        <form action="search" method="GET" class="error-search-wrapper">
            <svg class="error-search-icon" viewBox="0 0 24 24">
                <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
            </svg>
            <input type="text" name="q" class="error-search-box" placeholder="キーワードで検索" autocomplete="off" autofocus>
        </form>
    </div>

    <div class="error-actions">
        <a href="/" class="error-btn error-btn-primary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/>
            </svg>
            ホームに戻る
        </a>
        <button onclick="history.back()" class="error-btn error-btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
            </svg>
            前のページへ
        </button>
        <a href="status.php" class="error-btn error-btn-secondary">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
            </svg>
            ステータス確認
        </a>
    </div>

    <div class="error-suggestions">
        <h3>こんなことをお探しですか？</h3>
        <ul>
            <li><a href="about.php" style="color: var(--primary); text-decoration: none;">wholphin について</a></li>
            <li><a href="help.php" style="color: var(--primary); text-decoration: none;">使い方ガイド</a></li>
            <li><a href="status.php" style="color: var(--primary); text-decoration: none;">サービスステータス</a></li>
            <li><a href="privacy.php" style="color: var(--primary); text-decoration: none;">プライバシーポリシー</a></li>
        </ul>
    </div>
</div>

<script>
// --- メンテナンスフラグの確認 ---
const MAINTENANCE_FLAG_FILE = 'maintenance.json';

async function checkMaintenanceStatus() {
    try {
        const response = await fetch(MAINTENANCE_FLAG_FILE);
        if (response.ok) {
            const data = await response.json();
            if (data.enabled) {
                // メンテナンス中の場合、情報を表示
                showMaintenanceInfo(data);
            }
        }
    } catch (e) {
        // ファイルがない場合は無視
        console.log('No maintenance flag found');
    }
}

function showMaintenanceInfo(data) {
    const infoElement = document.getElementById('maintenanceInfo');
    const scheduleElement = document.getElementById('maintenanceSchedule');
    const detailsElement = document.getElementById('maintenanceDetails');
    
    if (data.schedule) {
        scheduleElement.textContent = `予定期間: ${data.schedule}`;
    }
    
    if (data.message) {
        detailsElement.textContent = data.message;
    }
    
    infoElement.style.display = 'block';
}

// --- エラータイプによる表示切り替え ---
const urlParams = new URLSearchParams(window.location.search);
const errorType = urlParams.get('type') || '404';

const errorConfig = {
    '400': {
        code: '400',
        title: '不正なリクエスト',
        message: 'リクエストが不正です。<br>URLを確認して再度お試しください。',
        showSearch: true
    },
    '401': {
        code: '401',
        title: '認証が必要です',
        message: 'このページへのアクセスには認証が必要です。<br>ログインしてから再度お試しください。',
        showSearch: false
    },
    '403': {
        code: '403',
        title: 'アクセスが拒否されました',
        message: 'このページへのアクセス権限がありません。<br>ホームから再度お試しください。',
        showSearch: true
    },
    '404': {
        code: '404',
        title: 'ページが見つかりません',
        message: 'お探しのページは存在しないか、移動した可能性があります。<br>URLを確認するか、下の検索ボックスからお探しください。',
        showSearch: true
    },
    '408': {
        code: '408',
        title: 'リクエストタイムアウト',
        message: 'リクエストがタイムアウトしました。<br>ネットワーク接続を確認して再度お試しください。',
        showSearch: true
    },
    '429': {
        code: '429',
        title: 'リクエストが多すぎます',
        message: '短時間に多数のリクエストがありました。<br>しばらく待ってから再度お試しください。',
        showSearch: false
    },
    '500': {
        code: '500',
        title: 'サーバーエラー',
        message: '一時的なエラーが発生しました。<br>しばらくしてから再度お試しください。',
        showSearch: true
    },
    '502': {
        code: '502',
        title: 'ゲートウェイエラー',
        message: 'サーバーが一時的に利用できません。<br>しばらくしてから再度お試しください。',
        showSearch: true
    },
    '503': {
        code: '503',
        title: 'サービス利用不可',
        message: 'サーバーが一時的に過負荷またはメンテナンス中です。<br>しばらくしてから再度お試しください。',
        showSearch: false
    },
    '504': {
        code: '504',
        title: 'ゲートウェイタイムアウト',
        message: 'サーバーからの応答がタイムアウトしました。<br>しばらくしてから再度お試しください。',
        showSearch: true
    },
    'maintenance': {
        code: '🛠️',
        title: 'メンテナンス中',
        message: '現在、システムメンテナンス中です。<br>ご不便をおかけしますが、しばらくお待ちください。',
        showSearch: false,
        isEmoji: true
    }
};

const config = errorConfig[errorType] || errorConfig['404'];

const errorCodeElement = document.getElementById('errorCode');
errorCodeElement.textContent = config.code;
if (config.isEmoji) {
    errorCodeElement.classList.add('emoji');
}

document.getElementById('errorTitle').textContent = config.title;
document.getElementById('errorMessage').innerHTML = config.message;

// 検索ボックスの表示/非表示
if (!config.showSearch) {
    document.getElementById('errorSearch').style.display = 'none';
}

// メンテナンスステータスチェック
checkMaintenanceStatus();

// --- Header Scroll Effect ---
const header = document.querySelector('.nav-header');
if (header) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}
</script>

</body>
</html>