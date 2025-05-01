<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | LOGIN</title>
        <meta charset="utf-8">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Radio+Canada&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="whole.css">
    </head>
    <body>
    <div class="body">
        
    <form action="login_check.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" >
        <div><span style="border-bottom:2px solid #66afe9;font-size: 15.5px;font-weight: 530;">SIGN IN</span>&nbsp&nbsp&nbsp&nbsp
        <input type="button" value="SIGN UP" onclick="location.href='create_account.php'" class="btn"></div>
        <br>
        <input type="text" placeholder="Account" name="account" required class="txt"><br>
        <input type="password" placeholder="Password" name="a_password" required class="txt"><br>
        <div class="forgot"><a href="test_code/captcha_index.php">Forgot password?</a></div>
        <div class="forgot" style="position:relative;bottom:7px;right:5px" onclick="face()"><a href="../opencv/test.php"><img src="source/FaceID.jpg" style="width:60px;position:relative;top:10px;"> Face ID</a></div>
        <input type="submit" value="SIGN IN" class="sub" style="background-color:#66afe9;border:none; color:white;font-weight:530">
    </form>
    <div style="height:600px;width:600px;position:fixed;top:120px;left:440px;line-height:600px; background:white;display:none" id="face">
        
        <img src="source/FaceID.gif" style="width:260px;" >
        <div style="position:relative;bottom:570px">It takes a second . . .</div>
    </div>
    </div>
    <script>
        function face(){
            var face=document.getElementById("face");
            face.style.display="block";
        }
        
    </script>
    </body>
</html>

