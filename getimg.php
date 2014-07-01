<?php
set_time_limit(0);
define('URL', "http://wanimal.lofter.com/?page=");
$pageNum = 1;
$start = time();

do {
    //getPage($pageNum); // save the images' url to a file
    saveImg($pageNum); // directively save image by file_put_contents()
    $pageNum += 1;

} while ($pageNum < 30);

echo "Total time: ", (time() - $start), " s\n";

/**
 * match images' url and save to a file
 * @param Integer $page
 */
function getPage($page) {
    echo "Getting page $page...\n";
    $html = curlGet(URL.$page);
    $urlList = getImgUrl($html);
    echo "matched ", count($urlList), " images\n";
    saveUrlList($urlList);
}

/**
 * use curl get file
 * @param String $url
 * @return Recourse
 */ 
function curlGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_DNS_CACHE_TIMEOUT, 1024); // default expire time is 120s
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

/**
 * get images' url from a html file
 * @param String $html
 * @return Array
 */
function getImgUrl($html) {
    $pattern = '/<img src="(.*)" .*\/>/U';
    preg_match_all($pattern, $html, $matches);
    
    return $matches[1];
}

/**
 * save images' url in file
 * @param Array $urlList
 */
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

/**
 * use file_put_contents() save image directively
 * @param Integer $page
 */
function saveImg($page) {
    echo "Getting page $page...\n";
    $html = curlGet(URL.$page);
    $urlList = getImgUrl($html);
    $i = 1;

    foreach ($urlList as $val) {
        $image = curlGet($val);
        file_put_contents("./images/$page-$i.jpg", $image);
        //file_put_contents("./images/$page-$i.jpg", file_get_contents($val));
        ++ $i;
    }
}
