<?php
$access_token = '';
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
			
			$tmps = '{
						  "type": "imagemap",
						  "baseUrl": "www.google.com",
						  "altText": "this is an imagemap",
						  "baseSize": {
						      "height": 1040,
						      "width": 1040
						  },
						  "actions": [
						      {
						          "type": "uri",
						          "linkUri": "www.youtube.com",
						          "area": {
						              "x": 0,
						              "y": 0,
						              "width": 520,
						              "height": 1040
						          }
						      },
						      {
						          "type": "message",
						          "text": "hello",
						          "area": {
						              "x": 520,
						              "y": 0,
						              "width": 520,
						              "height": 1040
						          }
						      }
						  ]
						}';
							 	 
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [json_decode($tmps)]
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
echo "OK xx hell";
?>
Contact GitHub API Training Shop Blog About
© 2016 GitHub, Inc. Terms Privacy Security Status Help
