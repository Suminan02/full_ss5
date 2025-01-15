<?php
    
    $url="https://together-gladly-airedale.ngrok-free.app/ss5/day3/file_process.php";
    
    // $username="user17";
    // $password="Suminan02@";
    // $c_password="Suminan02@";
    // $name="asdf";
    // $lastname="saer";
    // $mail="17@f.com";
    // $cid="1111122222217";
    // $phone="1112";
    // $address="LA";

        // $username="username_55";
        // $password="Suminan02@";
        // $con_password="Suminan02@";
        // $fname="asdf";
        // $lname="saer";
        // $eamil="1csdt@fg.com";
        // $c_id="1111122222666";
        // $phone="";
        // $address="";

    $data_array =array(
    'username' => 'username19',
    'password' => 'Suminan02@',
    'c_password' => 'Suminan02@',
    'email' => 'testser@example.com',
    'name' => 'John',
    'surname' => 'Smith',
    'cid' => '9876543210333',
    'phonenumber' => '0812345678',
    'address' => '456 Test Avenue');

    echo "<pre>";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, 
            http_build_query($data_array));
    // Receive server response ...
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_output = curl_exec($ch);
    curl_close($ch);
    print_r($server_output);

?>