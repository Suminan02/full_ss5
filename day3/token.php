<?php
$input_current=date('Y-m-d H:i:s');
$input_username = "abd1234";
$token_chksum =md5($input_current,$input_username);


$input_current=$_POST['$input_current'];//
$input_username=$_POST['$input_username'];
$token_chksum=$_POST['$token_chksum'];//


$token=md5($input_current."|".$input_username."md5");

if($token_chksum!=$token){
    echo "unreal data";
    exit;
}
$data_diff=strtotime(date('Y-m-d H:i:s'))-strtotime($input_current);
if($date_diff>=300||$date_diff<0){
    echo "token expire";
    exit;
}
    


?>