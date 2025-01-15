<?php
//เมื่อใส่ดอกเลขแล้ว จะแสดงออกมาเป้ฯดอกจัน ตามเลขที่ใส่
    
    
        // 
        
    //    echo $y = $dokjan=$dokjan."*";

    // $z=5;
    //     $dokjan="*";
    //     for($i=0;$i<$z;$i++){
    //         echo $dokjan."<br>";
    //         $dokjan=$dokjan."*"; //>>การเอาดอกจันมาเก็บไปเรื่อยๆ
    //     }

    // loop(6);
    // function loop($y){
    //     for($i=0;$i<=$y;$i++){
    //         for($j=1;$j<$i;$j++){
    //             echo $j;
    //         }
    //         echo '<br>';
    //     }
    // }

    // loop();
    // function loop(){
    //     $x=5;
    //     $y=1;
    //     $z=1;
    //     for($i=1;$i<$x;$i++){
    //         echo $y."<br>";
    //         $z=$z+1;
    //         $y=($y*10+$z);
    //     }
    // }
    
    // question:faq(6) = 6*5*4*3*2*1
    //$_POST['number_data']='';
    

// $a=123456;
// if(strlen("12345")<=5){
// echo "success";}else{echo "to much ";}


// $a="1234567891234";
// $pattern_cid= "/^[0-9]+.{13,}$/";
// if (strlen($a)==13 && preg_match($pattern_cid, $a)==FALSE ){echo "5";}else{echo "!=5";}

// $a="123456789123a";
// $pattern_cid= "/^[0-9]+.{13,}$/";
// if (strlen($a)!=13){echo "not 13";}
// if (preg_match($pattern_cid, $a)==FALSE){echo "not valid";}

    
        if(isset($_POST['number_data'])&& $_POST['number_data']!=''){ //1.เช็กก่อนว่ามีตัวแปรเข้ามาหรือไม่โดยใช้ isset และ เช็คว่าค่าที่ส่งมานั้นไม่เป็นค่าว่าง หาก ค่าที่ส่งเข้ามาเป็นค่าว่างจะส่งไปบรรทัดที่54 200
            if(is_numeric($_POST['number_data'])===FALSE){             //2.จากนั้นเช็คต่อว่าค่านั้นเป็นตัวเลขหรือไม่ หาก เป็นตัวเลขจะส่งข้อมูลต่อไปบรรทัดที่ 49 =  //4.หากบรรทัดที่ 42 เช็คแล้วว่าไม่เป็นค่าว่าง และ บรรทัด43 เช็คแล้วว่าเป็นตัวเลข ส่งบรรทัด49          
                $response =array('ret_code'=>'202','msg'=>"invalid data","data"=>""); //3.แต่หากค่าที่ส่งมานั้นไม่เป็นค่าว่างแต่ไม่ใช่ตัวเลข จะเข้า บรรทัดที่ี 43 จากนั้น จะ แสดง 202
                echo json_encode($response);                           
                exit;
            }
            $number_data=$_POST['number_data'];
            $response = array('ret_code'=>'101','msg'=>"sucess","data"=>loop($number_data)); //เมื่อเข้าบรรทัดที่ 49 data จะเรียกเอาข้อมูล ในfunction loop()มาใช้ code 101
        echo json_encode($response); 
            
            
            
        }else{
            $response =array('ret_code'=>'200','msg'=>"empty input_numb","data"=>"");
        echo json_encode($response);
            exit;
        }
    
    function loop($number_data){
        $res="";
        $resx=1;
        for($i=0;$i<$number_data;$i++){
            //echo ($y-$i)."*";
            if ($i==0){
                $res.=($number_data-$i);
                
            }else{
                $res .="*".($number_data-$i);
            }
            $resx=$resx*($i+1);
        } 
        $arrayres=array('res'=>$res,'resx'=>$resx);
        return  $arrayres;
    }
?>
    

