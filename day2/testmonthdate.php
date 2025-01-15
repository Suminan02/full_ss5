<?php
function thaidate($m){
    
    $monthArray=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    for($i=0;$i<=$m;$i++){
        $strMonthThai=$monthArray[$m];
    }
   return $strMonthThai;
}
echo thaidate(2);
?>