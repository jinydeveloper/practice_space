<?php
$url = "https://www.mk.co.kr/news/";

// User-Agent 설정 (크롤링 차단 우회용)
$opts = [
    "http" => [
        "method" => "GET",
        "header" => "User-Agent: Mozilla/5.0\r\n"
    ]
];
$context = stream_context_create($opts);

// HTML 가져오기
$html = @file_get_contents($url, false, $context);
if ($html === false) {
    die("매일경제에서 데이터를 가져올 수 없습니다.");
}

// 파싱
libxml_use_internal_errors(true);
$dom = new DOMDocument();
$dom->loadHTML($html);
libxml_clear_errors();

$xpath = new DOMXPath($dom);

// 주요 뉴스 영역 추출 (클래스명은 웹페이지 구조에 따라 바뀔 수 있음)
$articles = $xpath->query("//li[contains(@class, 'top_news_node')]//a[contains(@class, 'top_news_item')]");

echo "<h1>📌 오늘의 매일경제 주요 뉴스</h1>";
echo "<ul>";

foreach ($articles as $node) {

    // print_r($node);
    $title = trim($node->textContent);
    $link = $node->getAttribute('href');

    // 상대경로 처리
    if (strpos($link, 'http') !== 0) {
        $link = "https://www.mk.co.kr" . $link;
    }

    if (!empty($title)) {
        echo "<li><a href='$link' target='_blank'>" . htmlspecialchars($title) . "</a></li>";
    }
}

echo "</ul>";
?>
