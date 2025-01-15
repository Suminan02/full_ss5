<?php
include_once('include/webconfig.php');

$web= new MySQLClass();
$web->connect2Web();
if(empty($web->Connect)){
    echo "cannot connect database";
    exit;
}
$web->dbname(webDB);

$sql="SELECT * FROM user_info WHERE status in('0','1') ORDER BY createtime DESC;";
$res=$web->select($sql);
// echo "<pre>";
// print_r($res);

if(count($res)>0){
    for($i=0;$i<count($res);$i++){
        if($res[$i]->status==1){
            echo $res[$i]->username;
            echo "<hr>";
        }
    }
}
$web->closeDB();
?>