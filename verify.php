<?php
$access_token = 'kqJHzsi56OH56WLEq+29E0HoCR7sI/ddKh9CuSfHB/ENK/PSFTRW+pQRg5L7dRB7hHPMhMLUg7CvErwEHRZSMD0tZvA9JGo6Rxmr5oUAcn5FwS4WEEG/ztNtpA2uw8I1QcIRg8vgF4zYIZZlubOigAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
