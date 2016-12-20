Skip to content
This repository
Search
Pull requests
Issues
Gist
 @uopeydel
 Unwatch 1
  Star 0
  Fork 0 uopeydel/testline1
 Code  Issues 0  Pull requests 0  Projects 0  Wiki  Pulse  Graphs  Settings
Branch: master Find file Copy pathtestline1/bot.php
f128972  just now
@uopeydel uopeydel xx
1 contributor
RawBlameHistory     
78 lines (74 sloc)  2.23 KB
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
			
			$tmps = '{
						  "type": "imagemap",
						  "baseUrl": "https://pbs.twimg.com/profile_images/664342624082526208/VH-iVYvv.jpg",
						  "altText": "this is an imagemap",
						  "baseSize": {
						      "height": 1040,
						      "width": 1040
						  },
						  "actions": [
						      {
						          "type": "uri",
						          "linkUri": "https://example.com/",
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
