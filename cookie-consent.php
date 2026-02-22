<?php
// cookie-consent.php - Cookie同意バナー
?>
<style>
.cookie-consent-banner {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
    padding: 20px;
    box-shadow: 0 -2px 10px rgba(0,0,0,0.1);
    z-index: 10000;
    display: none;
    animation: slideUp 0.3s ease-out;
}

.cookie-consent-banner.show {
    display: block;
}

@keyframes slideUp {
    from {
        transform: translateY(100%);
    }
    to {
        transform: translateY(0);
    }
}

.cookie-consent-content {
    max-width: 1200px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
}

.cookie-consent-text {
    flex: 1;
    min-width: 300px;
    font-size: 14px;
    line-height: 1.6;
    color: var(--text-main);
}

.cookie-consent-text a {
    color: var(--primary);
    text-decoration: underline;
}

.cookie-consent-actions {
    display: flex;
    gap: 12px;
    flex-shrink: 0;
}

.cookie-consent-btn {
    padding: 10px 24px;
    border-radius: 24px;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    white-space: nowrap;
}

.cookie-consent-btn:active {
    transform: scale(0.98);
}

.cookie-consent-btn-accept {
    background: var(--primary);
    color: #fff;
}

.cookie-consent-btn-accept:hover {
    background: var(--primary-hover);
}

.cookie-consent-btn-decline {
    background: var(--bg-hover);
    color: var(--text-main);
    border: 1px solid var(--border);
}

.cookie-consent-btn-decline:hover {
    background: var(--border);
}

@media (max-width: 820px) {
    .cookie-consent-banner {
        padding: 16px;
    }
    
    .cookie-consent-content {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
    }
    
    .cookie-consent-text {
        min-width: auto;
    }
    
    .cookie-consent-actions {
        width: 100%;
    }
    
    .cookie-consent-btn {
        flex: 1;
        text-align: center;
    }
}
</style>

<div id="cookieConsentBanner" class="cookie-consent-banner">
    <div class="cookie-consent-content">
        <div class="cookie-consent-text">
            このサイトでは、検索設定の保存など、サービスの改善のためにCookieを使用しています。
            続行することで、<a href="/privacy" target="_blank">プライバシーポリシー</a>に同意したものとみなされます。
        </div>
        <div class="cookie-consent-actions">
            <button class="cookie-consent-btn cookie-consent-btn-decline" onclick="cookieConsent.decline()">拒否</button>
            <button class="cookie-consent-btn cookie-consent-btn-accept" onclick="cookieConsent.accept()">同意する</button>
        </div>
    </div>
</div>

<script>
const cookieConsent = {
    init() {
        // Cookie同意がまだの場合はバナーを表示
        if (!CookieManager.has('cookie_consent')) {
            setTimeout(() => {
                document.getElementById('cookieConsentBanner').classList.add('show');
            }, 1000);
        }
    },
    
    accept() {
        CookieManager.set('cookie_consent', 'accepted', 365);
        this.hide();
    },
    
    decline() {
        CookieManager.set('cookie_consent', 'declined', 365);
        // 拒否された場合は既存のCookieを削除
        CookieManager.set('safesearch', '', -1);
        this.hide();
    },
    
    hide() {
        const banner = document.getElementById('cookieConsentBanner');
        banner.classList.remove('show');
        setTimeout(() => {
            banner.style.display = 'none';
        }, 300);
    }
};

// ページ読み込み時に初期化
if (typeof CookieManager !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => cookieConsent.init());
    } else {
        cookieConsent.init();
    }
}
</script>