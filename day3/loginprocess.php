<?php
$username="";
$password="";

    if(isset($_POST['username'])&&$_POST['username'] !=''){
    $username=$_POST['username'];
    }
    if($username==""){
    $response = array('ret_code'=>'001','msg'=>"empty input username");
    write_log(json_encode($response));
    echo json_encode($response);
    exit;
    }
    $pattern_username = "/^[a-zA-Z0-9_]{6,16}$/";
    if (preg_match($pattern_username, $username)==FALSE) {
        $response = array('ret'=>'201','msg'=>'Invalid pattern username');
        echo json_encode($response);
        write_log(json_encode($response));
        exit;
    }
    if(isset($_POST['password'])&&$_POST['password'] !=''){
        $password=$_POST['password'];
    }
    if($password==""){
        $response = array('ret_code'=>'002','msg'=>"empty input password");
        write_log(json_encode($response));
        echo json_encode($response);
        exit;
    }
    $pattern_password ="/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
    if (preg_match($pattern_password, $password)==FALSE) {
            $response = array('ret'=>'202','msg'=>'Invalid pattern password');
            echo json_encode($response);
            write_log(json_encode($response));
            exit;
    }

    include_once('include/webconfig.php');

    $web= new MySQLClass();
    $web->connect2Web();
    if(empty($web->Connect)){
        echo "cannot connect database";
        exit;
    }
    $web->dbname(webDB);

    
    $password =md5($password);
    $sql = "SELECT username, password,status FROM user_info WHERE username='".$username."' AND password='".$password."' ";
  
    $array_result=$web->select($sql);

            if(count($array_result)==1){
                if($array_result[0]->status==1){
                    $response = array('ret_code'=>'101','msg'=>"login success");
                    write_log(json_encode($response));
                    echo json_encode($response);
                    
                    session_start();
                    $_SESSION['username']=$array_result[0]->username;

                }else{
                    $response = array('ret_code'=>'110','msg'=>"user not active");
                    write_log(json_encode($response));
                    echo json_encode($response);
                }
            }
            else{
                $response = array('ret_code'=>'111','msg'=>"user account not found or password incorrect");
                    write_log(json_encode($response));
                    echo json_encode($response);
            }
            

            $web->closeDB();

    function write_log($log){
    //Something to write to txt log
    $date_log = date("Y-m-d H:i:s").PHP_EOL.
    "DATA : ".$log.PHP_EOL."-------------------------".PHP_EOL;
    //Save string to log, use FILE_APPEND to append.
    file_put_contents('logs/log_'.date("Ymd").'.txt', $date_log, FILE_APPEND);
    }
   
?>