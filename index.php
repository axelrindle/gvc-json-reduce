<?php

// requires
require_once 'utils.php';

// php settings
ini_set('html_errors', false);

// get url parameter
$url = isset($_GET['url']) ? $_GET['url'] : null;
if (!$url) die('Error: No url parameter given!');
if (!str_starts_with($url, 'https://api.github.com/')) die('This url does not seem to be a valid Github API url!');
if (!str_ends_with($url, '/releases')) die('Seems like you don\'t want to fetch releases!');

// execute request
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => $url,
    CURLOPT_HTTPHEADER => array(
        'User-Agent: axelrindle'
    )
));
$result = curl_exec($curl);
curl_close($curl);

// validate json
$result = json_decode($result, true);
if (isset($result['message'])) die($result['message']);

// reduce json
$transformed = array();
foreach ($result as $el) {
    array_push($transformed, array(
        "name" => $el['name'],
        "tag_name" => $el['tag_name'],
        "isPrerelease" => $el['prerelease'],
        "publishedAt" => $el['published_at'],
        "url" => $el['html_url'],
    ));
}
echo json_encode($transformed);