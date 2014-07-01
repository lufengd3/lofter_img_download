<?php
set_time_limit(0);
define('URL', "http://wanimal.lofter.com/?page=");
$pageNum = 1;
$start = time();

do {
    //$pageExist = getPage($pageNum);
    $pageExist = getPage($pageNum);
    $pageNum += 1;

} while ($pageNum < 30);

echo "Total time: ", (time() - $start), " s\n";

function getPage($page) {
    echo "Getting page $page...\n";
    $html = curlGet(URL.$page);
    $urlList = getImgUrl($html);
    echo "matched ", count($urlList), " images\n";
    saveUrlList($urlList);
}

function curlGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

function getImgUrl($html) {
    $pattern = '/<img src="(.*)" .*\/>/U';
    preg_match_all($pattern, $html, $matches);
    
    return $matches[1];
}

function saveUrlList($urlList) {
    $f = fopen('imageUrls', 'a+');
    foreach ($urlList as $val) {
        fwrite($f, $val."\n");
    }
    fclose($f);
}

function checkPageExist() {
    return true;
}
