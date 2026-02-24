<?php
// noscript/search.php - JSなしでも検索できるPHPレンダリング版
// API: https://api.p2pear.asia/search

$API_ENDPOINT = 'https://api.p2pear.asia/search';

function h($s) {
    return htmlspecialchars((string)$s, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function get_int($key, $default = 0, $min = null, $max = null) {
    $v = isset($_GET[$key]) ? intval($_GET[$key]) : $default;
    if ($min !== null) $v = max($min, $v);
    if ($max !== null) $v = min($max, $v);
    return $v;
}

function http_get_json($url, &$httpCode = null) {
    $httpCode = null;

    // Prefer cURL when available
    if (function_exists('curl_init')) {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CONNECTTIMEOUT => 5,
            CURLOPT_USERAGENT => 'wholphin-noscript/1.0 (+https://wholphin.net/)'
        ]);
        $body = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_error($ch);
        curl_close($ch);
        if ($body === false) {
            throw new RuntimeException('cURL error: ' . $err);
        }
    } else {
        $ctx = stream_context_create([
            'http' => [
                'method' => 'GET',
                'timeout' => 10,
                'header' => "User-Agent: wholphin-noscript/1.0 (+https://wholphin.net/)\r\n"
            ]
        ]);
        $body = @file_get_contents($url, false, $ctx);
        if ($body === false) {
            throw new RuntimeException('HTTP request failed');
        }
        // best-effort http code
        if (isset($http_response_header) && is_array($http_response_header)) {
            foreach ($http_response_header as $line) {
                if (preg_match('~^HTTP/\S+\s+(\d{3})~', $line, $m)) {
                    $httpCode = intval($m[1]);
                    break;
                }
            }
        }
    }

    $data = json_decode($body, true);
    if (!is_array($data)) {
        throw new RuntimeException('Invalid JSON response');
    }
    return $data;
}

function normalize_results($data) {
    // API returns {results: [...], count: ...}
    if (isset($data['results']) && is_array($data['results'])) return $data['results'];
    // fallback: sometimes returns array
    if (is_array($data) && array_keys($data) === range(0, count($data) - 1)) return $data;
    return [];
}

function calc_total_pages($count, $resultsLen) {
    // Mirror the heuristic in search.php (JS):
    // If count is small (<= resultsLen*2), treat it as pages; otherwise treat as total results.
    $count = intval($count);
    $resultsLen = intval($resultsLen);
    if ($count > 0 && $resultsLen > 0) {
        if ($count <= $resultsLen * 2) {
            return max(1, $count);
        }
        return max(1, (int)ceil($count / 10));
    }
    return 1;
}

$q = isset($_GET['q']) ? trim((string)$_GET['q']) : '';
$type = isset($_GET['type']) ? trim((string)$_GET['type']) : 'web';
$allowedTypes = ['web', 'image', 'video', 'news', 'social'];
if (!in_array($type, $allowedTypes, true)) $type = 'web';

$page = get_int('page', 1, 1, 9999);
$safesearch = get_int('safesearch', 0, 0, 2);
$lang = isset($_GET['lang']) ? trim((string)$_GET['lang']) : 'ja';
if ($lang === '') $lang = 'ja';

$results = [];
$count = 0;
$totalPages = 1;
$error = '';

$panelData = null;

if ($q !== '') {
    try {
        $baseParams = [
            'q' => $q,
            'type' => $type,
            'page' => $page,
            'safesearch' => $safesearch,
            'lang' => $lang,
        ];
        $url = $API_ENDPOINT . '?' . http_build_query($baseParams);
        $data = http_get_json($url, $httpCode);
        $results = normalize_results($data);
        $count = isset($data['count']) ? intval($data['count']) : 0;
        $totalPages = calc_total_pages($count, count($results));

        // fetch panel for first page of web results
        if ($type === 'web' && $page === 1) {
            $panelUrl = $API_ENDPOINT . '?' . http_build_query([
                'q' => $q,
                'type' => 'panel',
                'safesearch' => $safesearch,
                'lang' => $lang,
            ]);
            try {
                $panelData = http_get_json($panelUrl, $panelCode);
            } catch (Throwable $e) {
                $panelData = null;
            }
        }
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}

function build_url($q, $type, $page, $safesearch, $lang) {
    $params = [
        'q' => $q,
        'type' => $type,
        'page' => $page,
        'safesearch' => $safesearch,
        'lang' => $lang,
    ];
    return '?' . http_build_query($params);
}

function host_of($url) {
    $h = @parse_url($url, PHP_URL_HOST);
    return $h ? $h : '';
}

function render_knowledge_panel($panelData, $q) {
    if (!is_array($panelData)) return '';
    $results = $panelData['results'] ?? null;
    if (!is_array($results)) return '';

    $wikiResult = null;
    foreach ($results as $r) {
        if (is_array($r) && !empty($r['wiki_priority'])) {
            $wikiResult = $r;
            break;
        }
    }
    if (!$wikiResult || empty($wikiResult['url'])) return '';

    $panel = $panelData['featured_panel'] ?? [];
    $wikiTitle = $panelData['wiki_title'] ?? $q;

    $description = '';
    if (is_array($panel) && !empty($panel['description'])) {
        $description = (string)$panel['description'];
    } elseif (!empty($wikiResult['summary'])) {
        $description = mb_substr((string)$wikiResult['summary'], 0, 300);
        if (mb_strlen((string)$wikiResult['summary']) > 300) $description .= '...';
    }

    $imageUrl = (is_array($panel) && !empty($panel['image_url'])) ? (string)$panel['image_url'] : '';
    $subtitle = (is_array($panel) && !empty($panel['subtitle'])) ? (string)$panel['subtitle'] : '';
    $facts = (is_array($panel) && !empty($panel['facts']) && is_array($panel['facts'])) ? $panel['facts'] : [];

    ob_start();
    ?>
    <div class="knowledge-panel">
        <div class="panel-header">
            <?php if ($imageUrl): ?>
                <img src="<?= h($imageUrl) ?>" class="panel-image" alt="<?= h($wikiTitle) ?>">
            <?php endif; ?>
            <div class="panel-info">
                <h2 class="panel-title"><?= h($wikiTitle) ?></h2>
                <?php if ($subtitle): ?>
                    <div class="panel-subtitle"><?= h($subtitle) ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($description): ?>
            <div class="panel-description"><?= h($description) ?></div>
        <?php endif; ?>

        <?php if (!empty($facts)): ?>
            <div class="panel-facts">
                <?php foreach ($facts as $fact):
                    if (!is_array($fact)) continue;
                    $label = $fact['label'] ?? '';
                    $value = $fact['value'] ?? '';
                    if ($label === '' || $value === '') continue;
                    ?>
                    <div class="panel-fact">
                        <span class="panel-fact-label"><?= h($label) ?>:</span>
                        <span class="panel-fact-value"><?= h($value) ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <div class="panel-source">
            <a href="<?= h($wikiResult['url']) ?>" target="_blank" rel="noopener">Wikipedia</a> より
        </div>
    </div>
    <?php
    return ob_get_clean();
}

?><!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
    <title><?= h($q) ?> - wholphin 検索 (noscript)</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.gstatic.com/s/merriweathersans/v28/2-c79IRs1JiJN1FRAMjTN5zd9vgsFHXwcjfj9zlcxZI.woff2" as="font" type="font/woff2" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:ital,wght@0,300..800;1,300..800&family=Noto+Sans+JP:wght@100..900&display=optional" rel="stylesheet">

    <link rel="shortcut icon" href="/favicon.ico">

    <style>
        :root {
            --primary: #1a73e8;
            --text-main: #202124;
            --text-sub: #5f6368;
            --text-link: #1a0dab;
            --bg-body: #ffffff;
            --bg-surface: #ffffff;
            --bg-hover: #f1f3f4;
            --border: #dfe1e5;
            --shadow-soft: 0 1px 6px rgba(32,33,36,0.18);
            --radius-l: 24px;
            --radius-m: 12px;
            --header-bg: rgba(255,255,255,0.98);
            --footer-bg: #f2f2f2;
        }
        @media (prefers-color-scheme: dark) {
            :root {
                --primary: #8ab4f8;
                --text-main: #e8eaed;
                --text-sub: #bdc1c6;
                --text-link: #8ab4f8;
                --bg-body: #202124;
                --bg-surface: #303134;
                --bg-hover: #3c4043;
                --border: #5f6368;
                --shadow-soft: 0 1px 6px rgba(0,0,0,0.3);
                --header-bg: rgba(32,33,36,0.98);
                --footer-bg: #171717;
            }
        }
        * { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            font-family: 'Noto Sans JP', sans-serif;
            color: var(--text-main);
            background: var(--bg-body);
            display: flex;
            flex-direction: column;
        }
        a { color: inherit; text-decoration: none; }

        header {
            position: sticky;
            top: 0;
            z-index: 1000;
            background: var(--header-bg);
            border-bottom: 1px solid var(--border);
        }
        .header-inner {
            display: flex;
            align-items: center;
            gap: 24px;
            padding: 18px 24px 0;
            max-width: 1200px;
        }
        .logo {
            font-size: 24px;
            font-weight: 700;
            white-space: nowrap;
            user-select: none;
            cursor: pointer;
            letter-spacing: -0.5px;
            font-family: "Merriweather Sans", sans-serif;
            font-style: italic;
        }
        .search-container { flex: 1; max-width: 690px; }
        .search-box-wrap {
            border-radius: var(--radius-l);
            background: var(--bg-surface);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            height: 44px;
            padding: 0 14px;
        }
        .search-input {
            flex: 1;
            height: 100%;
            border: none;
            background: transparent;
            font-size: 16px;
            color: var(--text-main);
            outline: none;
        }
        .search-btn {
            border: none;
            background: var(--primary);
            color: #fff;
            height: 32px;
            padding: 0 12px;
            border-radius: 999px;
            cursor: pointer;
            font-size: 14px;
        }

        .tabs {
            display: flex;
            gap: 24px;
            padding: 16px 24px 0;
            max-width: 1200px;
            margin-left: 105px;
            overflow-x: auto;
            scrollbar-width: none;
        }
        .tabs::-webkit-scrollbar { display: none; }
        .tab {
            padding: 0 4px 12px;
            font-size: 14px;
            color: var(--text-sub);
            border-bottom: 3px solid transparent;
            font-weight: 500;
            white-space: nowrap;
        }
        .tab.active { color: var(--primary); border-bottom-color: var(--primary); }

        main { width: 100%; max-width: 1200px; padding: 24px; }
        .content-area { margin-left: 105px; max-width: 650px; min-height: 40vh; }
        .stats { font-size: 14px; color: var(--text-sub); margin-bottom: 18px; }

        .knowledge-panel {
            border: 1px solid var(--border);
            border-radius: var(--radius-m);
            padding: 20px;
            margin-bottom: 32px;
            background: var(--bg-surface);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .panel-header { display: flex; align-items: flex-start; gap: 16px; margin-bottom: 16px; }
        .panel-image { width: 120px; height: 120px; border-radius: 8px; object-fit: cover; flex-shrink: 0; background: var(--bg-hover); }
        .panel-title { font-size: 22px; font-weight: 600; margin: 0 0 8px; line-height: 1.3; }
        .panel-subtitle { font-size: 14px; color: var(--text-sub); margin-bottom: 12px; }
        .panel-description { font-size: 14px; line-height: 1.6; margin-bottom: 12px; }
        .panel-facts { display: grid; gap: 8px; margin-top: 16px; }
        .panel-fact { display: flex; font-size: 13px; line-height: 1.5; }
        .panel-fact-label { font-weight: 600; color: var(--text-sub); min-width: 100px; flex-shrink: 0; }
        .panel-source { margin-top: 16px; padding-top: 16px; border-top: 1px solid var(--border); font-size: 12px; color: var(--text-sub); }
        .panel-source a { color: var(--text-link); }

        .web-item { margin-bottom: 28px; }
        .web-cite { display: flex; align-items: center; gap: 10px; font-size: 14px; margin-bottom: 6px; color: var(--text-main); }
        .web-cite img { width: 18px; height: 18px; border-radius: 50%; background: #f1f3f4; object-fit: cover; border: 1px solid rgba(0,0,0,0.1); }
        .web-title { display: inline-block; font-size: 20px; color: var(--text-link); line-height: 1.3; margin-bottom: 6px; }
        .web-title:hover { text-decoration: underline; }
        .web-desc { font-size: 14px; line-height: 1.6; color: var(--text-sub); word-break: break-all; }

        .pagination {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin: 32px 0;
            padding: 12px 0;
            flex-wrap: wrap;
        }
        .pagination a {
            min-width: 40px;
            height: 40px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 999px;
            font-size: 14px;
            font-weight: 500;
            color: var(--primary);
            padding: 0 12px;
        }
        .pagination a:hover { background: var(--bg-hover); }
        .pagination .active {
            background: var(--primary);
            color: #fff;
            cursor: default;
            pointer-events: none;
        }
        .pagination .disabled { color: var(--text-sub); pointer-events: none; opacity: 0.6; }

        .error {
            border: 1px solid var(--border);
            background: var(--bg-surface);
            padding: 16px;
            border-radius: var(--radius-m);
            color: var(--text-sub);
        }

        footer {
            background: var(--footer-bg);
            padding: 16px 24px;
            border-top: 1px solid var(--border);
            font-size: 14px;
            color: var(--text-sub);
        }
        .footer-inner { max-width: 1200px; margin-left: 105px; display: flex; gap: 24px; flex-wrap: wrap; }

        @media (max-width: 820px) {
            .header-inner { flex-direction: column; padding: 16px 16px 0; gap: 12px; }
            .tabs { margin-left: 0; padding-left: 16px; padding-right: 16px; }
            main { padding: 16px; }
            .content-area { margin-left: 0; max-width: 100%; }
            .footer-inner { margin-left: 0; justify-content: center; }
            .panel-header { flex-direction: column; }
            .panel-image { width: 100%; height: 200px; }
        }
    </style>
</head>
<body>

<?php include __DIR__ . '/../cookie-consent.php'; ?>

<header>
    <div class="header-inner">
        <div class="logo" onclick="window.location.assign('/')">wholphin</div>
        <div class="search-container">
            <form method="get" action="" class="search-box-wrap">
                <input class="search-input" type="text" name="q" value="<?= h($q) ?>" placeholder="検索" autocomplete="off">
                <input type="hidden" name="type" value="<?= h($type) ?>">
                <input type="hidden" name="page" value="1">
                <input type="hidden" name="safesearch" value="<?= h($safesearch) ?>">
                <input type="hidden" name="lang" value="<?= h($lang) ?>">
                <button class="search-btn" type="submit">検索</button>
            </form>
        </div>
    </div>

    <nav class="tabs" aria-label="search types">
        <?php foreach (['web' => 'すべて', 'image' => '画像', 'video' => '動画', 'news' => 'ニュース', 'social' => 'ソーシャル'] as $t => $label):
            $u = build_url($q, $t, 1, $safesearch, $lang);
            $active = ($t === $type) ? 'active' : '';
            ?>
            <a class="tab <?= $active ?>" href="<?= h($u) ?>"><?= h($label) ?></a>
        <?php endforeach; ?>
    </nav>
</header>

<main>
    <div class="content-area">
        <?php if ($q === ''): ?>
            <div class="stats">検索語を入力してください</div>
        <?php else: ?>
            <?php if ($error): ?>
                <div class="error">読み込みエラーが発生しました: <?= h($error) ?></div>
            <?php else: ?>
                <div class="stats">
                    <?php if (!empty($results)): ?>
                        約 <?= number_format($count) ?> 件 (<?= h($page) ?> / <?= h($totalPages) ?> ページ)
                    <?php else: ?>
                        見つかりませんでした
                    <?php endif; ?>
                </div>

                <?php
                if ($type === 'web' && $page === 1 && $panelData) {
                    echo render_knowledge_panel($panelData, $q);
                }
                ?>

                <?php foreach ($results as $item):
                    if (!is_array($item)) continue;
                    $title = $item['title'] ?? '';
                    $url = $item['url'] ?? '';
                    $summary = $item['summary'] ?? '';
                    if ($title === '' && $summary === '') continue;
                    if ($url === '') continue;
                    $host = host_of($url);
                    $favicon = $item['favicon'] ?? '';
                    ?>
                    <div class="web-item">
                        <div class="web-cite">
                            <?php if ($favicon): ?>
                                <img src="<?= h($favicon) ?>" alt="" onerror="this.style.display='none'">
                            <?php endif; ?>
                            <span><?= h($host) ?></span>
                        </div>
                        <a class="web-title" href="<?= h($url) ?>" target="_blank" rel="noopener"><?= h($title ?: 'No Title') ?></a>
                        <?php if ($summary): ?>
                            <div class="web-desc"><?= h($summary) ?></div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

                <?php if ($totalPages > 1):
                    $prevPage = max(1, $page - 1);
                    $nextPage = min($totalPages, $page + 1);

                    // show up to 5 pages around current
                    $start = max(1, min($page - 2, $totalPages - 4));
                    $end = min($totalPages, $start + 4);
                    ?>
                    <div class="pagination" aria-label="pagination">
                        <a class="<?= ($page === 1) ? 'disabled' : '' ?>" href="<?= h(build_url($q, $type, $prevPage, $safesearch, $lang)) ?>">&lt; 前へ</a>

                        <?php for ($i = $start; $i <= $end; $i++):
                            $cls = ($i === $page) ? 'active' : '';
                            ?>
                            <a class="<?= $cls ?>" href="<?= h(build_url($q, $type, $i, $safesearch, $lang)) ?>"><?= h($i) ?></a>
                        <?php endfor; ?>

                        <a class="<?= ($page === $totalPages) ? 'disabled' : '' ?>" href="<?= h(build_url($q, $type, $nextPage, $safesearch, $lang)) ?>">次へ &gt;</a>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<footer>
    <div class="footer-inner">
        <span>wholphin (noscript)</span>
        <span style="flex:1"></span>
        <span>&copy; 2026 wholphin search</span>
    </div>
</footer>

</body>
</html>
