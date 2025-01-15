<?php
     $curl = curl_init();

     curl_setopt_array($curl, array(
         CURLOPT_URL => 'url',//string ของ url ที่ต้องการ
         CURLOPT_RETURNTRANSFER => true,//1,true ค่าเป็น 1 หมายถึง return ค่ากลับมาในรูป string
         CURLOPT_ENCODING => '',
         CURLOPT_MAXREDIRS => 10,
         CURLOPT_TIMEOUT => 0,//เวลานานที่สุดที่ให้ curl ฟังก์ชันทำงาน
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
         CURLOPT_CUSTOMREQUEST => 'POST',//ประเภทการส่ง,
         CURLOPT_POSTFIELDS => '{"name": "ทดสอบ"}',//ข้อมูลที่จะส่งไป
         CURLOPT_HTTPHEADER => array(
             'Authorization: Bearer {Authorization Key}',
             'Content-Type: application/json'
         ),//	array ที่เก็บค่า http header
     ));

     $response = curl_exec($curl);

     curl_close($curl);

     $response =  json_decode($response); //แปลง string ที่ได้เป็น object
     


?>