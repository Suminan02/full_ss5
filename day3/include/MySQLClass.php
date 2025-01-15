<?php
require_once('Variable.DB.php');
class MySQLClass{
    var $Connect;

    function connect2Web(){

        $this->Connect=mysqli_connect(webIP, webUser, webPW);

        @mysqli_query($this->Connect,"set character_set_results=utf8mb4");
        @mysqli_query($this->Connect,"set character_set_client=utf8mb4");
        @mysqli_query($this->Connect,"set character_set_connection=utf8mb4");
    }

    function dbname($dbname){
        @mysqli_select_db($this->Connect,$dbname);

        if(mysqli_error($this->Connect)!=''){
            echo mysqli_error($this->Connect);
        }
    }

    function closeDB(){
        @mysqli_close($this->Connect);
    }

    function select($sql){
        $array_result = array();
        $result =mysqli_query($this->Connect,$sql);
        if($result){
            while($row = mysqli_fetch_object($result)) {
                array_push($array_result, $row);
            } 
            mysqli_free_result($result); //ทำเพื่อเคลีย$result ที่กำลังจองแรมอยู่
        }else{
            if(mysqli_error($this->Connect)!=''){
                //echo mysqli_error($this->Connect);
            }
            return false;
        }
       return $array_result;
    }

    function execute($sql){
        $result =mysqli_query($this->Connect,$sql);
        if($result){
            return true;
        }else{
            if(mysqli_error($this->Connect)!=''){
                //echo mysqli_error($this->Connect);
            }
            return false;
        }
    }
    function escape_string($str){   //ใช้สำหรับป้องกันการโจมตีเข้าระบบsqlสำหรับค่าที่เราเข้ามาแต่ไม่ได้ดักความปลอดภัย
        return mysqli_real_escape_string($this->Connect,$str);
    }
}
?>