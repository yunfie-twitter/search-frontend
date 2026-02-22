const CACHE_NAME = 'wholphin-v2';
const OFFLINE_PAGE = '/offline.html';

const ASSETS_TO_CACHE = [
  '/',
  '/index.php',
  '/index.css',
  '/index.js',
  '/favicon.ico',
  '/manifest.json',
  '/search.php',
  OFFLINE_PAGE,
  'https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@1,300;1,700&family=Noto+Sans+JP:wght@400;500;700&display=optional'
];

// インストール時: 静的アセットをキャッシュ
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('Opened cache');
      return cache.addAll(ASSETS_TO_CACHE);
    })
  );
  self.skipWaiting(); // 直ちに有効化
});

// アクティベート時: 古いキャッシュを削除
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((cacheNames) => {
      return Promise.all(
        cacheNames.map((cacheName) => {
          if (cacheName !== CACHE_NAME) {
            return caches.delete(cacheName);
          }
        })
      );
    })
  );
  self.clients.claim();
});

// フェッチ時: キャッシュ戦略の適用
self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);

  // 1. 検索結果ページやAPI、外部画像 - ネットワーク優先でオフライン時はフォールバック
  if (url.pathname.includes('search.php') || url.hostname !== self.location.hostname) {
    event.respondWith(
      fetch(event.request).catch(() => {
        // source=pwa パラメータがある場合はオフライン画面へ
        if (url.searchParams.get('source') === 'pwa') {
          return caches.match(OFFLINE_PAGE);
        }
        return new Response('オフラインです', { 
          status: 503,
          headers: { 'Content-Type': 'text/plain; charset=utf-8' }
        });
      })
    );
    return;
  }

  // 2. 静的リソース (CSS, JS, Fonts, Top Page) -> Stale-While-Revalidate
  // キャッシュがあればそれを返し、裏でネットワークから更新して次回に備える
  event.respondWith(
    caches.match(event.request).then((cachedResponse) => {
      const fetchPromise = fetch(event.request).then((networkResponse) => {
        // 正常なレスポンスならキャッシュ更新
        if (networkResponse && networkResponse.status === 200 && networkResponse.type === 'basic') {
          const responseToCache = networkResponse.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return networkResponse;
      }).catch(() => {
        // PWAモードでのオフライン時
        if (url.searchParams.get('source') === 'pwa') {
          return caches.match(OFFLINE_PAGE);
        }
      });

      return cachedResponse || fetchPromise;
    })
  );
});