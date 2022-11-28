<?php
error_reporting(E_ALL);
ini_set('display_errors', 0);
define('FACEBOOK_SDK_V4_SRC_DIR', __DIR__.'/src/Facebook/');
require_once(__DIR__.'/src/Facebook/autoload.php');

$fb = new Facebook\Facebook([
 'app_id' => '178052102574509',
 'app_secret' => '9c8ca3de61b6eca89dfac43d8f2a5eee',
 'default_graph_version' => 'v2.2',
]);


//Post property to Facebook
$linkData = [
 'link' => 'www.ksm.co.zm',
 'message' => 'This is a test message'
];
$pageAccessToken ='EAACh7ZCxTUa0BAImIeZA5DFU0ywNYDMRZBywfl69p9m2fmzZAEskO3xwWV9or3Vlsn6ZCwwc2IKybIxuPLsUJgd3ihCZB709jdXMIJbUZBDVsvbBfZAaCKB9i2mgKcwzg3LmuRrOZCRt8RHRu2RbAtfAVvvSwvS3SybvLbBf3ahIAzcmmZCzPimfSw3ct7OIaEmAdIyWOADLiojwZDZD';

try {
 $response = $fb->post('/me/feed', $linkData, $pageAccessToken);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
 echo 'Graph returned an error: '.$e->getMessage();
 exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
 echo 'Facebook SDK returned an error: '.$e->getMessage();
 exit;
}
$graphNode = $response->getGraphNode();
?>