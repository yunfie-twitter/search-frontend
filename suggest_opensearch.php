<?php
// ヘッダー設定: JSON形式であることを宣言
header('Content-Type: application/x-suggestions+json; charset=UTF-8');
header('Access-Control-Allow-Origin: *'); // 必要に応じてCORS設定

// クエリパラメータの取得
$query = isset($_GET['q']) ? trim($_GET['q']) : '';

// クエリが空の場合は空の結果を返す
if ($query === '') {
    echo json_encode(["", [], [], []]);
    exit;
}

// 外部APIエンドポイント（既存のJSで使用しているもの）
$apiEndpoint = 'https://api.p2pear.asia/search';
$apiUrl = $apiEndpoint . '?q=' . urlencode($query) . '&type=suggest';

// APIからデータ取得
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3); // タイムアウト設定
$response = curl_exec($ch);
curl_close($ch);

// デフォルトの戻り値構造
$suggestions = [];
$descriptions = []; // 説明（省略可）
$urls = [];         // URL（省略可）

if ($response) {
    $data = json_decode($response, true);
    
    // APIのレスポンス形式に合わせてパース
    // index.jsのロジックを参考に、suggestions, results, または直配列を処理
    $list = [];
    if (isset($data['suggestions']) && is_array($data['suggestions'])) {
        $list = $data['suggestions'];
    } elseif (isset($data['results']) && is_array($data['results'])) {
        $list = $data['results'];
    } elseif (is_array($data)) {
        $list = $data;
    }

    // 上位10件程度に絞る
    $list = array_slice($list, 0, 10);

    foreach ($list as $item) {
        $text = '';
        
        // オブジェクトか文字列かを判定してテキスト抽出
        if (is_string($item)) {
            $text = $item;
        } elseif (is_array($item)) {
            // text, term, title, value などのキー候補から探す
            $text = $item['text'] ?? $item['term'] ?? $item['title'] ?? $item['value'] ?? '';
        }

        if ($text !== '') {
            $suggestions[] = $text;
            // 説明文があれば入れる（ここでは空）
            $descriptions[] = ""; 
            // 検索実行用URLを生成
            // 自分のサイトの検索URLに合わせる
            $urls[] = "https://wholphin.net/search?q=" . urlencode($text);
        }
    }
}

// OpenSearch JSON形式で出力
// [ "検索語句", ["候補1", "候補2"], ["説明1", "説明2"], ["URL1", "URL2"] ]
$output = [
    $query,
    $suggestions,
    $descriptions,
    $urls
];

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>