<?php
$access_token = 'kqJHzsi56OH56WLEq+29E0HoCR7sI/ddKh9CuSfHB/ENK/PSFTRW+pQRg5L7dRB7hHPMhMLUg7CvErwEHRZSMD0tZvA9JGo6Rxmr5oUAcn5FwS4WEEG/ztNtpA2uw8I1QcIRg8vgF4zYIZZlubOigAdB04t89/1O/w1cDnyilFU=';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);



// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			// Get replyToken
			$replyToken = $event['replyToken'];
			// Build message to reply back
			
			if($text == "1")
			{
				$jtemplate = json_decode('{
				"type": "buttons",
				"thumbnailImageUrl": "https://example.com/bot/images/image.jpg",
				"title": "Menu",
				"text": "Please select",
				"actions": [
					{
						"type": "postback",
						"label": "Buy",
						"data": "action=buy&itemid=123"
					},
					{
						"type": "postback",
						"label": "Add to cart"
						"data": "action=add&itemid=123"
					},
					{
						"type": "uri",
						"label": "View detail",
						"uri": "http://example.com/page/123
					}
					]}');
				
				$messages1 = [
					'type' => 'template',
					'altText' => 'this is a buttons template',
					'template' => [$jtemplate]
				];
				$url1 = 'https://api.line.me/v2/bot/message/push';
				$data1 = [
					'to' => 'U83670cc497f32dcba4e722be89893a6e',
					'messages' => [$messages1],
				];
				$post1 = json_encode($data1);
				$headers1 = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
				$ch1 = curl_init($url1);
				curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch1, CURLOPT_POSTFIELDS, $post1);
				curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
				curl_setopt($ch1, CURLOPT_FOLLOWLOCATION, 1);
				$result1 = curl_exec($ch1);
				curl_close($ch1);
			}
			
			$messages = [
				'type' => 'text',
				'text' => $text.' ที่ป้อนมา'.$event['source']['userId']
			];
			
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);
			echo $result . "\r\n";
		}
	}
}
echo "aa OK b cc dd";
?>
