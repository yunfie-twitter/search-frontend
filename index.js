// 既存のindex.jsの内容は保持しつつ、末尾に以下を追加する形を想定
// ※ 実際の既存コードは保持される必要があるため、ここでは追加部分のみを示します
// ※ 実際の統合時は既存のindex.jsの末尾にこのコードを追加してください

/**
 * PWAモードのオフライン検出機能
 * source=pwa パラメータが存在する場合、オフライン状態を監視
 */
(function initPWAOfflineDetection() {
    // URLパラメータからPWAモードを判定
    const urlParams = new URLSearchParams(window.location.search);
    const isPWA = urlParams.get('source') === 'pwa';
    
    if (!isPWA) return;
    
    console.log('PWAモードが有効です');
    
    // オフライン状態の監視
    function checkOnlineStatus() {
        if (!navigator.onLine) {
            console.log('オフライン状態を検出しました');
            window.location.href = '/offline.html?source=pwa';
        }
    }
    
    // オフラインイベントのリスナー
    window.addEventListener('offline', () => {
        console.log('offline イベント発火');
        checkOnlineStatus();
    });
    
    // オンラインイベントのリスナー
    window.addEventListener('online', () => {
        console.log('online イベント発火 - 接続復旧');
    });
    
    // ページアンロード前の接続チェック（フォールバック）
    window.addEventListener('beforeunload', () => {
        if (!navigator.onLine) {
            checkOnlineStatus();
        }
    });
    
    // 初回ロード時のチェック
    if (!navigator.onLine) {
        checkOnlineStatus();
    }
})();

/**
 * PWAモードでのリンク処理
 * すべての内部リンクにsource=pwaパラメータを付与
 */
(function maintainPWAParameter() {
    const urlParams = new URLSearchParams(window.location.search);
    const isPWA = urlParams.get('source') === 'pwa';
    
    if (!isPWA) return;
    
    document.addEventListener('DOMContentLoaded', () => {
        // すべてのリンクを取得
        const links = document.querySelectorAll('a');
        
        links.forEach(link => {
            // 内部リンクのみ処理
            if (link.hostname === window.location.hostname && link.href) {
                try {
                    const url = new URL(link.href);
                    // source=pwaパラメータを追加
                    if (!url.searchParams.has('source')) {
                        url.searchParams.set('source', 'pwa');
                        link.href = url.toString();
                    }
                } catch (e) {
                    console.error('リンク処理エラー:', e);
                }
            }
        });
        
        console.log('PWAモード: 内部リンクにパラメータを付与しました');
    });
    
    // フォーム送信時もパラメータを維持
    document.addEventListener('submit', (e) => {
        const form = e.target;
        if (form.method.toLowerCase() === 'get') {
            const formAction = new URL(form.action || window.location.href);
            if (formAction.hostname === window.location.hostname) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'source';
                input.value = 'pwa';
                form.appendChild(input);
            }
        }
    });
})();