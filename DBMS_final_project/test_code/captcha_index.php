<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>fidZone | Forget password</title>
    <link rel="stylesheet" href="../whole.css">
</head>
<script>
    function refresh_code(){ 
        document.getElementById("imgcode").src="captcha.php"; 
    } 
</script>

<body>
    <div class="body">
        <form name="form1" method="post" action="checkcode.php">
            <div><span style="font-size: 15.5px;font-weight: 530;" onclick="location.href='../login.php'">SIGN IN</span>&nbsp&nbsp&nbsp&nbsp
            <input type="button" value="SIGN UP" onclick="location.href='../create_account.php'" class="btn"></div>
            <br>
            <input type="text" name="account" id="account" class="txt" placeholder="Account" require><br>
            <input type="text" name="checkword"  class="txt" style="width:218px" placeholder="Verification code">
            <img id="imgcode" src="captcha.php" onclick="refresh_code()" style="position:relative;top:11px;left:5px"><br><br>
            <input type="submit" name="Submit" value="SEND" class="numbtn"  >
        </form>
        <div style="font-size:14px;color:rgb(249, 64, 64);font-weight:bolder;margin:20px;position:relative;left:5px">
        <?php
            if(isset($_GET["correct"])){
                $correct=$_GET["correct"];
                // 該帳號沒有新增電子信箱-1
                // 該帳號不存在-2
                // 驗證碼錯誤0
                // correc:1
                if($correct==1){
                    print '已寄送驗證信';
                }else if($correct==-1){
                    print '該帳號沒有新增電子信箱！';
                }else if($correct==-2){
                    print '該帳號不存在！';
                }else{
                    print '驗證碼錯誤！';
                }
            }
        ?>
        </div>
    </div>
    
</body>
</html>

