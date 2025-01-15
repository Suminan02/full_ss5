<?php

    
    

        $username="";
        $password="";
        $c_password="";
        $name="";
        $surname="";
        $email="";
        $cid="";
        $phonenumber="";
        $address="";
        $server="";


    if(isset($_POST['username'])&&$_POST['username'] !=''){
        $username=$_POST['username'];
      }
    
      if($username==""){
        $response = array('ret_code'=>'001','msg'=>"empty input username");
        echo json_encode($response);
        exit;
      }
    
        $pattern_username = "/^[a-zA-Z0-9_]{6,16}$/";
        if (preg_match($pattern_username, $username)==FALSE) {
            $response = array('ret'=>'201','msg'=>'Invalid pattern username');
            echo json_encode($response);
         
            exit;
        }
    
      if(isset($_POST['password'])&&$_POST['password'] !=''){
        $password=$_POST['password'];
      }
      if($password==""){
        $response = array('ret_code'=>'002','msg'=>"empty input password");
        
        echo json_encode($response);
        exit;
      }
      $pattern_password ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if (preg_match($pattern_password, $password)==FALSE) {
            $response = array('ret'=>'202','msg'=>'Invalid pattern password');
            echo json_encode($response);
            
            exit;
        }
      if(isset($_POST['c_password'])&&$_POST['c_password'] !=''){
        $c_password=$_POST['c_password'];
      }
      if($c_password==""){
        $response = array('ret_code'=>'003','msg'=>"empty input confirm password");
        
        echo json_encode($response);
        exit;
      }
      $pattern_c_password ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        if (preg_match($pattern_c_password, $c_password)==FALSE) {
            $response = array('ret'=>'203','msg'=>'Invalid pattern confirm password');
            echo json_encode($response);
           
            exit;
        }
      if($c_password!=$password){
        $response = array('ret_code'=>'122','msg'=>"password and confirm password not same");
       
        echo json_encode($response);
        exit;
      }
      if(isset($_POST['name'])&&$_POST['name'] !=''){
        $name=$_POST['name'];
      }
      if($name==""){
        $response = array('ret_code'=>'004','msg'=>"empty name");
        
        echo json_encode($response);
        exit;
      }
      $pattern_name = "/^\p{L}+$/u";
        if (preg_match($pattern_name, $name)==FALSE) {
            $response = array('ret'=>'204','msg'=>'Invalid pattern name');
            echo json_encode($response);
           
            exit;
        }
      if(isset($_POST['surname'])&&$_POST['surname'] !=''){ 
        $surname=$_POST['surname']; 
        }
      if($surname==""){$response = 
        array('ret_code'=>'005','msg'=>"empty surname"); 
        echo json_encode($response);
        exit;
        }
        $pattern_lastname = "/^\p{L}+$/u";
        if (preg_match($pattern_lastname , $surname)==FALSE) {
            $response = array('ret'=>'205','msg'=>'Invalid pattern last name');
            echo json_encode($response);
           
            exit;
        }
    
        if(isset($_POST['email'])&&$_POST['email'] !=''){
        $email=$_POST['email'];
         }
      
      if($email==""){
        $response = array('ret_code'=>'006','msg'=>"empty email");
       
        echo json_encode($response);
        exit;
      }
      $pattern_email = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
        if (preg_match($pattern_email , $email)==FALSE) {
            $response = array('ret'=>'206','msg'=>'Invalid pattern email');
            echo json_encode($response);
            
            exit;
        }
      if(isset($_POST['cid'])&&$_POST['cid'] !=''){
        $cid=$_POST['cid'];
      }
      if($cid==""){
        $response = array('ret_code'=>'007','msg'=>"empty citizen id");
        
        echo json_encode($response);
        exit;
      }
      $pattern_cid= "/^[0-9]+.{12,}$/";
        if (preg_match($pattern_cid , $cid)==FALSE) {
            $response = array('ret'=>'207','msg'=>'Invalid pattern citizen ID');
            echo json_encode($response);
            
            exit;
        }
      if(isset($_POST['phonenumber'])&&$_POST['phonenumber'] !=''){
        $phonenumber=$_POST['phonenumber'];
      }
      if(isset($_POST['address'])&&$_POST['address'] !=''){
        $address=$_POST['address'];
      }
      if(isset($_POST['server'])&&$_POST['server'] !=''){
        $server=$_POST['server'];
      }

    if($server=="hunter"){
    $url="https://together-gladly-airedale.ngrok-free.app/ss5/day3/file_process.php";

   
    $data_array =array(
    'username' => $username,
    'password' => $password,
    'c_password' => $c_password,
    'email' => $email,
    'name' => $name,
    'surname' => $surname,
    'cid' => $cid,
    'phonenumber' => $phonenumber,
    'address' => $address);
    
        //echo "<pre>";
   
    
    $curlresult=curl($url,$data_array);
    $result=json_decode($curlresult);
    
    if(isset($result->ret)&&$result->ret==101){
        $response = array('ret_code'=>'101','msg'=>"success","location"=>"https://together-gladly-airedale.ngrok-free.app/ss5/day5/table_show.php");
        
        echo json_encode($response);
      }
      else{
          if(isset($result->msg)){
            $response = array('ret_code'=>'400','msg'=>$result->msg);
            echo json_encode($response);
          }else{
            $response = array('ret_code'=>'500','msg'=>"unsuccess");
            echo json_encode($response);
          }
      }
    }else if($server=="ford"){
        $url="https://oyster-famous-lemming.ngrok-free.app/ford/day3/tableprocess.php";

        $data_array =array(
            'username' => $username,
            'password' => $password,
            'con_password' => $c_password,
            'email' => $email,
            'fname' => $name,
            'lname' => $surname,
            'c_id' => $cid,
            'phone' => $phonenumber,
            'address' => $address);

            $curlresult=curl($url,$data_array);
            $result=json_decode($curlresult);

            if(isset($result->status)&&$result->status==101){
                $response = array('ret_code'=>'101','msg'=>"success","location"=>"https://oyster-famous-lemming.ngrok-free.app/ford/Day4/connet.php");
                echo json_encode($response);
              }
              else{
                  if(isset($result->msg)){
                    $response = array('ret_code'=>'400','msg'=>$result->msg);
                    echo json_encode($response);
                  }else{
                    $response = array('ret_code'=>'500','msg'=>"unsuccess");
                    echo json_encode($response);
                  }
              }
    } elseif($server=="phed") {
        $url='https://hawk-strong-abnormally.ngrok-free.app/ss5/day3/tableprocess.php';

        $data_array =array(
            'username' => $username,
            'password' => $password,
            'c_password' => $c_password,
            'email' => $email,
            'name' => $name,
            'lastname' => $surname,
            'cid' => $cid,
            'phone' => $phonenumber,
            'address' => $address);

            $curlresult=curl($url,$data_array);
            $result=json_decode($curlresult);

            if(isset($result->ret_code)&&$result->ret_code==101){
                $response = array('ret_code'=>'101','msg'=>"success","location"=>"https://hawk-strong-abnormally.ngrok-free.app/ss5/day3/tableshow.php");
                echo json_encode($response);
              }
              else{
                  if(isset($result->msg)){
                    $response = array('ret_code'=>'400','msg'=>$result->msg);
                    echo json_encode($response);
                  }else{
                    $response = array('ret_code'=>'500','msg'=>"unsuccess");
                    echo json_encode($response);
                  }
              }

    }

    function curl($url,$data_array){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 
                http_build_query( $data_array));
        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        return $server_output;
    }
        
?>