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


	if (strpos($text, 'gpt=') === 0) {
        $chatname = "gpt";
        $text = substr($text, 4); // Remove 'gpt=' from the input
    } elseif (strpos($text, 'gemini=') === 0) {
        $chatname = "gemini";
        $text = substr($text,7); // Remove 'gemini=' from the input
    } else {
        // Default to GPT if no specific API is requested
		$respond_array_line = "Hello, please choose to use gpt or gemini by using gpt= or gemini= and put your question after =";
    } 
	

	if($chatname=="gemini"){

		// $GEMINI_API_KEY="";
		// $url="https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=".$GEMINI_API_KEY;
	
		$arrayHeader = array();
		$arrayHeader[] = "Content-Type: application/json";
	
		$message="สัตวืชื่ออะไรเป็นที่นิยมที่สุดในประเทศไทย";
	
		$arrayPostData ='{"contents": [{"parts":[{"text":" '.$text.'"}]}]}';
		$respond= curl($url, $arrayPostData,$arrayHeader);
		$respond_array=json_decode($respond,true);
		$respond_array_line= "Gemini: ".$respond_array ["candidates"][0]["content"]["parts"][0]["text"];
	
		}
		elseif($chatname=="gpt"){
			// $gpt_api_key='';
			// $url="https://api.openai.com/v1/chat/completions";
	
			$arrayHeader = array();
			$arrayHeader[] = "Content-Type: application/json"; //วิธีการเพิ่มอะเรใน $arrayHeader
			$arrayHeader[] = "Authorization: Bearer ".$gpt_api_key;
		   
		$arrayPostData ='{
		"model": "gpt-4o-mini",
		"store": true,
		"messages": [
		  {"role": "user", "content":" '.$text .'"}
		]
		 }';
		$respond= curl($url, $arrayPostData,$arrayHeader);
		$respond_array=json_decode($respond,true);
		$respond_array_line= "GPT: " .$respond_array["choices"][0]["message"]["content"];

		}

	$messages = [];
	$messages['replyToken'] = $replyToken;
	$messages['messages'][0] = getFormatTextMessage($respond_array_line);//จากนนั้นนำตัวแปลที่รับเฉพาะข้อมูลtextไปใช้ต่อเพื่อส่งกลับไป

	
	
	$encodeJson = json_encode($messages);

	$LINEDatas['url'] = "https://api.line.me/v2/bot/message/reply";
  	$LINEDatas['token'] = "";

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

	function curl($url, $arrayPostData,$arrayHeader=array()){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $arrayPostData);
		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close($ch);
		return $server_output;
	}
?>