
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Table</title>
    <style>
        table{
        border: 1px solid #dededf;
        background-color: #ffffff;
        color: #000000;
        padding: 5px;
        overflow: auto;
        width: 100%;
        text-align: center;
        border-collapse: collapse;
        border-spacing: 1px;
        }
        th{
        border: 1px solid #dededf;
        background-color: #92cef7;
        color: #000000;
        padding: 5px; 
        }
        td{
            border: 1px solid #dededf;
        background-color: #ffffff;
        color: #000000;
        padding: 5px;
        }
    </style>
</head>
<body>
    <table id="table" style="border: solid 2px; border-collapse: seperate;">
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Name</th>
            <th>Last Name</th>
            <th>Citizen ID</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Create Time</th>
            <th>Last update</th>
            <th>Status</th>
            <th>Function</th>
        </tr>
        
        <?php
       include_once('include/webconfig.php');

       $web= new MySQLClass();
       $web->connect2Web();
       if(empty($web->Connect)){
           echo "cannot connect database";
           exit;
       }
       $web->dbname(webDB);
          
            $sql = "SELECT * FROM user_info WHERE status in('0','1') ORDER BY createtime DESC;";
            $array_result=$web->select($sql);
            
            function thaidate($m){
                $numm=(int)$m;
                $monthArray=array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
                for($i=0;$i<=$m;$i++){
                    $strMonthThai=$monthArray[$numm];
                }
               return $strMonthThai;
            }

            if(isset($_POST["delbutton"])){
               $delIdSql=$_POST["delinput"];
               $delSql="DELETE FROM user_info WHERE id=$delIdSql;";
               $array_result=$web->execute($delSql);
               echo '<script>
               window.location.href="tableshow.php";
               </script>';
            }

            if(isset($_POST['udbtn'])){
                $udInPhone=$_POST["udPhone"];
                $delIdSql=$_POST["delinput"];
                $udPhonesql="UPDATE user_info SET phone = '$udInPhone' WHERE id = $delIdSql;";
                $array_result=$web->execute($udPhonesql);
                echo '<script>
                window.location.href="tableshow.php";
                </script>';
            }
            
        if(count($array_result)>0){
            $tr_row ="";
            for($i=0;$i<count($array_result);$i++){
            $no=$i+1;
            $status="";
            if($array_result[$i]->status==1){
                $status="active";
            }else{$status="deactive";}

            $createtime=date_format(date_create($array_result[$i]->createtime),"dmY");
            $createtimeSec=date_format(date_create($array_result[$i]->createtime)," H:i:s");
            $createtimeDay=substr($createtime,0,2);
            $createtimeMonth=substr($createtime,2,2);
            $createYear=substr($createtime,4,7);
            $createtimeYearsThai=$createYear+543;
            $finalThaimonth=$createtimeDay." ".thaidate($createtimeMonth)." ".$createtimeYearsThai.$createtimeSec;

            $updateTime=date_format(date_create($array_result[$i]->updatetime),"dmY");
            $updateTimeSec=date_format(date_create($array_result[$i]->updatetime)," H:i:s");
            $updateDay=substr($updateTime,0,2);
            $updateMonth=substr($updateTime,2,2);
            $updateYear=substr($updateTime,4,7);
            $updateYearThai=$updateYear+543;
            $finalUpdateThaimonth=$updateDay." ".thaidate($updateMonth)." ".$updateYearThai.$updateTimeSec;

            $idDelBtn=$array_result[$i]->id;
            $phoneInput=$array_result[$i]->phone;
            
            $tr_row.="<tr>
            <form method='POST'>
            <td>$no</td>
            <td>".$array_result[$i]->username."</td>
            <td>".$array_result[$i]->name."</td>
            <td>".$array_result[$i]->surname."</td>
            <td>".$array_result[$i]->citizen_id."</td>
            <td>".$array_result[$i]->email."</td>
            <td><input name='udPhone' value='$phoneInput'/></td>
            <td>".$array_result[$i]->address."</td>
            <td>".$finalThaimonth."</td>
            <td>".$finalUpdateThaimonth."</td>
            <td>".$status."</td>
            
            <input name='delinput' type='hidden' value='$idDelBtn'/>
            <td>
            <button name='delbutton' type='submit' id='deletebtn'>Delete ID</button>
            <button name='udbtn' type='submit' id='updatephone'>Update Phone</button>
            </td>
            </form>
        </tr>";
    } 
        }else{
            $tr_row="<tr><td colspan='9'>..Nodata..</td></tr>";
        }
        echo $tr_row;

        ?>
    </table>
    <a href="table2.php"><button type="button" id="btn" >Back to login</button></a>
</body>
</html>