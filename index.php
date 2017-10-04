<?php
// Token can be get from here https://github.com/settings/tokens
define('TOKEN', 'provide token here');

function githubRequest($url)
{
    $ch = curl_init();
    $access = TOKEN;
    curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'website');
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERPWD, $access);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    $output = curl_exec($ch);
    curl_close($ch);
    $result = json_decode(trim($output), true);
	
    return $result;
}

$result = githubRequest('https://api.github.com/search/users?q=location:singapore');
$total = $result['total_count'];
$result = githubRequest('https://api.github.com/search/users?q=location:singapore&per_page=' . $total . '&page=1');

echo "<pre>";
print_r($result);
echo "</pre>";