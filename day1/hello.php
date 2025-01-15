<?php
    $hello="Hello world day";
    $day =" 1";
    echo $hello.$day." naja<br><hr>";
    echo "End new line<br>";

    $x=5;
    $y=2;
    $result1 =$x+$y;
    $result2=$x.$y;
    echo $result1."<br>";
    echo $result2."<br><hr>";

    for($i=1;$i<=10;$i++){
        echo $hello.$i;
        echo "<hr>";
    }


    $number =55;
    if($number >=80){
        echo "A";
    }elseif($number>=70){
        echo "B";
    }elseif($number>=60){
        echo "C";
    }elseif($number>=50){
        echo "D";
    }else{
        echo "F";
    }
       
?>