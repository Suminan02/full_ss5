<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <input type="text" name="numb_1" id="numb_1">
    <button type="button" id="btn"> Send</button><br>
    <div id="result">
        Result here
    </div>
    <script>
        $( document ).ready(function() {
        console.log( "ready!" );
        });

        $("#btn").click(function(){
            var numb_1 = $("#numb_1").val();
            //alert(numb_1);
            if(numb_1==''){   //กรณีที่ numb_1เป็นค่าว่าง ให้ส่งไปที่บรรทัดที่ 24
                alert('Input number plaese');
                $("#number_1").focus();
                return false;
            }
        //var data_1=1;    
        var dataString = 'number_data='+ numb_1+""; //ค่าที่จะส่งไปพร้อมตัวแปร
        $.ajax ({
                    type: "POST", //METHOD "GET","POST"
                    url: "testloop.php", //File ที่ส่งค่าไปหา
                    data: dataString,
                    //cache: false,
                    success: function(data) {
                    console.log(data);
                    var data_res=JSON.parse(data);
                    console.log(data_res.data.res);
                    console.log(data_res.data.resx);
                    if(data_res.ret_code==101){
                        data=data_res.data.res+"="+data_res.data.resx
                        console.log(data);
                        $("#result").html(data);
                    }else{
                        alert(data_res.msg);
                    }
                    
                    // if(data==0){
                    // //alert("success");
                    // }
                    // else{
                    //     alert("Unsuccess");
                    // }
                    } 
                });;
    });
    </script>
</body>
</html>