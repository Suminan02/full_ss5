<?php 
	/*Get Data From POST Http Request*/
	$datas = file_get_contents('php://input'); //รับค่าแบบเจสัน
	/*Decode Json From LINE Data Body*/
	$deCode = json_decode($datas,true); //ดีโคด ทรูเพื่อให้เป็นอะเร json_decode($datas)>>> กรณีนี้จะเป็นobject

	

	file_put_contents('log.txt',"==============Message=======".file_get_contents('php://input') . PHP_EOL, FILE_APPEND);
	file_put_contents('log.txt', $encodeJson . PHP_EOL, FILE_APPEND);
	

	$replyToken = isset($deCode['events'][0]['replyToken'])?$deCode['events'][0]['replyToken']:"";
	$userId = isset($deCode['events'][0]['source']['userId'])?$deCode['events'][0]['source']['userId']:"";
	$text = isset($deCode['events'][0]['message']['text'])?$deCode['events'][0]['message']['text']:"";
	
	

	$messages = [];
	$messages['replyToken'] = $replyToken;
	$messages['messages'][0] = getFormatTextMessage($text);

	$encodeJson = json_encode($messages);

	$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
  	$LINEDatas['token'] = "fZ7rZ4DHkHZt0izZiJxuWufIj9+QWsG2fxF3KbIqIwmj0CxbjfFmwTNHw1ahbhMPbfarR09qpRIJToeEmx/ZrrAl95oRgSyszwnTeGbZ7XuI9OttlU3UhkDPGjFNm5y83c9IGAUFIxY0U4BXkwhTsgdB04t89/1O/w1cDnyilFU=";

  	$results = sentMessage($encodeJson,$LINEDatas);

	echo "success";
	/*Return HTTP Request 200*/
	http_response_code(200);

	function getFormatTextMessage($text)
	{
		$datas = [];
		$datas['type'] = 'text';
		$datas['text'] = $text;

		return $datas;
	}

	function sentMessage($encodeJson,$datas)
	{
		$datasReturn = [];
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $datas['url'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => $encodeJson,
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Bearer ".$datas['token'],
		    "cache-control: no-cache",
		    "content-type: application/json; charset=UTF-8",
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		    $datasReturn['result'] = 'E';
		    $datasReturn['message'] = $err;
		} else {
		    if($response == "{}"){
			$datasReturn['result'] = 'S';
			$datasReturn['message'] = 'Success';
		    }else{
			$datasReturn['result'] = 'E';
			$datasReturn['message'] = $response;
		    }
		}

		return $datasReturn;
	}
?>