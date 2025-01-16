<?php
    $chatname="gpt";
    
    if($chatname=="gemini"){

    $GEMINI_API_KEY="AIzaSyDMMpAJ7GOIowY24ugbA6ioaW_0LEo0EI4";
    $url="https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=".$GEMINI_API_KEY;

    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";

    $message="สัตวืชื่ออะไรเป็นที่นิยมที่สุดในประเทศไทย";

    $arrayPostData ='{"contents": [{"parts":[{"text":" '.$message.'"}]}]}';
    $respond= curl($url, $arrayPostData,$arrayHeader);
    $respond_array=json_decode($respond,true);
    $respond_array_line= $respond_array ["candidates"][0]["content"]["parts"][0]["text"];

    echo $respond_gemini_array_line;
    }

    elseif($chatname=="gpt"){
        // $gpt_api_key='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';
        $url="https://api.openai.com/v1/chat/completions";

        $arrayHeader = array();
        $arrayHeader[] = "Content-Type: application/json";
        $arrayHeader[] = "Authorization: Bearer ".$gpt_api_key;
       
        $message="สัตว์ชื่ออะไรเป็นที่นิยมที่สุดในประเทศไทย";

    $arrayPostData ='{
    "model": "gpt-4o-mini",
    "store": true,
    "messages": [
      {"role": "user", "content":" '.$message.'"}
    ]
     }';
    $respond= curl($url, $arrayPostData,$arrayHeader);
    $respond_array=json_decode($respond,true);
    
   
    $respond_array_line=  $respond_array["choices"][0]["message"]["content"];
    echo $respond_array_line;
    //echo $respond_gemini_array_line;
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