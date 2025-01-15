<?php
    // echo "<pre>";
    // print_r($_GET);
    // echo "<hr>";
    // print_r($_POST);
    $number_data=0;
    if(isset($_POST['submit'])&& $_POST['submit']!=''){
        if(isset($_POST['number_data'])&& $_POST['number_data']!=''){
            $number_data=$_POST['number_data'];
        }echo cal($number_data);
    }else{
        echo "Invalid";
        exit;
    }
    function cal($number_data){
        $result = "cannot call";
        if($number_data>=80){
            $result="A";
           }else if($number_data>=70){
            $result="B";
           }else if($number_data >=60){
            $result="C";
           }else if($number_data >=50){
            $result="D";
           }else{
            $result="F";
           }
           return $result;
    }
    // http://localhost/ss5/day1/cal_process.php?data1=xxxx&data2=yyyy
?>
