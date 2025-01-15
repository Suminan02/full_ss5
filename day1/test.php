<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "TEST"; ?></title>
    <link rel="stylesheet" href="./style.css/style.css">
</head>
<body>
    <?php
        echo "9999";
    ?>
    <h1>H1</h1>
    <div id="div_1" class="css_border txt_color" onclick="clickx(this);">
        DIV 1
    </div>
    <div class="css_border" onclick="clickx(this);">
        DIV 2
    </div>
    <br style="clear: both;"onclick="clickx(this);">
    <br>
    <br>
    <span class="css_border" onclick="clickx(this);">Span 1</span>
    <span class="css_border" onclick="clickx(this);">Span 2</span>
    <script>
        function clickx(elm_id){
            console.log(elm_id);
            elm_id.innerHTML="New Text";
        }  
    </script>

</body>
</html>