<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Serif+Text:ital@0;1&family=Jersey+10&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
   <style>
    #wrapper{
        width:75%;
        border: 0px solid #ccc;
        border-radius: 17px;
        padding: 20px;
        margin: 0 auto;
    }
   </style>
</head>

<body>
    <?php
        session_start();
        if(isset($_SESSION["username"])){
            echo "<script>alert('user still login');
            window.location.href='loginsuccess.php';
            </script>";  
            exit;
        }
    ?>
        <div id="wrapper" class="mt-5">
                            <div class="form-group">
                            <h3>Login</h3>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="username" class="form-control " id="username" aria-describedby="emailHelp" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control " id="password" aria-describedby="emailHelp" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                        <button type="button" class="btn btn-dark" id="btnlogin">Login</button>
                        <a href="table2.php"><button type="button" class="btn btn-inf" id="btn">Register</button></a>
                        </div>
                        
                        <div class="alert " role="alert" id="wornninglogin">&nbsp;</div>
        </div>

        <!-- <table>
            <div>
            <tr>
                <td class="info_right">Username</td>
                <td>
                    <input type="username" name="username" id="username" placeholder="please enter username">
                </td>
            </tr>
            </div>
            
            <tr>
                <td class="info_right" >Password</td>
                <td>
                    <input type="password" name="password" id="password" placeholder="please enter your password " >
                </td>
                
            </tr>
            <tr>
                <td class="div_button"><button id="btnlogin" type="submit" class="btn btn-dark">Login</button></td>
                <td class="div_button"><a href="table2.php"><button type="button" id="btn" >Register</button></a></td>
            </tr>
            <tr>
                <td></td>
                <td><span id="wornninglogin">&nbsp;</span></td>
                <td><span id="wornningsuccess">&nbsp;</span></td>
            </tr>
        </table> -->
    
    
    <script>
        
        $( document ).ready(function() {
        console.log( "ready!" );
        });

        $( "#btnlogin" ).click(function() {
            var username = $("#username").val();
            var password = $("#password").val();

        if(username==""){
        valid_data("username","please enter your username!");
        return false;
        }
        if(!/^[a-zA-Z0-9_]{6,16}$/.test(username)){
        valid_data("username","username must have 6-16 dijig and A-Z ,a-z,0-9");
        return false;
        }
        if(password==""){
            valid_data("password","please enter your password!");
            return false;
        }
        if(!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)){
        valid_data("password","password mush have at lease 8 dijig and 1 special, capital, small and number character ");
        return false;
        }else{
            
        }

            $("#alert").html("");

            var dataString = 
            'username='+ username+
            '&password='+password;

        $.ajax ({
                    type: "POST", //METHOD "GET","POST"
                    url: "loginprocess.php", //File ที่ส่งค่าไปหา
                    data: dataString,
                    //cache: false,
                    success: function(data) {
                        //console.log(data);
                        var data_res=JSON.parse(data);
                        console.log(data_res);
                        if(data_res.ret_code==101){
                            $("#wornninglogin").html(data_res.msg);
                            $("#wornninglogin").addClass("alert-success").removeClass("alert-danger");
                            window.location.href='loginsuccess.php';
                        }else{
                            $("#wornninglogin").html(data_res.msg);
                            $("#wornninglogin").addClass("alert-danger").removeClass("alert-success");
                        }
                    } 
                });
        })

        function valid_data(elm_id,msg_wron){
            $("#wornninglogin").addClass("alert-danger");
            $("#wornninglogin").html(msg_wron);
            $("#"+elm_id).focus();
        }
    </script>
    
</body>
</html>