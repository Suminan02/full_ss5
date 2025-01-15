<?php
include_once('include/webconfig.php');

$web= new MySQLClass();
$web->connect2Web();
if(empty($web->Connect)){
    echo "cannot connect database";
    exit;
}
$web->dbname(webDB);

$password="";
$sql="INSERT INTO user_info (username, password, citizen_id, email, name, surname, address, phone) 	
VALUES ('user03', 'asdfg', '1234567891227', 'bac@x.com', 'saankam', 'saamkan', 'bkk', '021354898');";
$password =md5($password);

$result_insert=$web->execute($sql);

if($result_insert){
    echo "success";
}else{
    echo "unsuccess".mysqli_error($web->Connect);
}
$web->closeDB();
  
//   $sql = "SELECT * FROM user_info;";
//   $result=mysqli_query($conn,$sql);


//   $array_result = array();
//     while($row = mysqli_fetch_object($result)) {
//         array_push($array_result, $row);
//     }
//     if(count($array_result)>0){
//         for($i=0;$i<count($array_result);$i++){
//             echo "id =".$array_result[$i]->id;
//             echo "|username =".$array_result[$i]->username;
//             echo "<hr>";
//         }
//     }
    
    
 //$result = $conn->query($sql);
//    echo "<pre>";
//   print_r($result);
// //   print_r($result->fetch_array());

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = mysqli_fetch_assoc($result)) {
//       echo "id: " . $row["id"]. " - Username: " . $row["username"]. "name: " . $row["name"]. "<br>";
//     }
//   } else {
//     echo "0 results";
//   }


  ?>