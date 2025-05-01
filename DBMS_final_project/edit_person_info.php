<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | Edit personal info</title>
        <link rel="stylesheet" href="whole.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
        <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"
        />
    </head>
    <body>
        <?php
            // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

            $id = $_GET["account"];
            $path="post.php?account=".$id;
            $path1="all_public.php?account=".$id;
            $tmp = "SELECT profile_photo FROM account WHERE aId=$id";
            $tmp=mysqli_query($con, $tmp);
            $your_own_pic=mysqli_fetch_array($tmp);
            // $sth = $db->prepare($tmp);
            // $sth->execute();
            // $your_own_pic = $sth->fetch();

            $tmp1 = "SELECT account, a_Name FROM account WHERE aId=$id";
            $tmp1=mysqli_query($con, $tmp1);
            $account_name=mysqli_fetch_array($tmp1);
            // $sth1 = $db->prepare($tmp1);
            // $sth1->execute();
            // $account_name = $sth1->fetch();

            $tmp2 = "SELECT email FROM personal_info WHERE aId=$id";
            $tmp2=mysqli_query($con, $tmp2);
            $info=mysqli_fetch_array($tmp2);
            // $sth2 = $db->prepare($tmp2);
            // $sth2->execute();
            // $info = $sth2->fetch();


        ?>
        <div class="main">
        <div class="top" style="text-align:center;height:60px">
        <div style="text-align:center;font-size:20px;position:relative;top:20px">
            <strong><?=$account_name['account']?></strong>
        </div>
        <a href="personal.php?page=<?=$id?>&user=<?=$id?>&invite=0" style="position:fixed;top:20px;left:490px">
        <img src="source/back.png" style="width:25px; height:auto;">
        </a>
        </div>

        <form action="personal_info.php" method="POST" style="position:relative;top:100px;left:90px;">
            <input type="hidden" name="aId" value="<?=$id?>">
            <label for="account"> Account</label><br>
            <input type="text" name="account" id="account" class="txt" value="<?=$account_name['account']?>"><br><br>
            <label for="a_Name">Nickname</label><br>
            <input type="text" name="a_Name" id="a_Name" class="txt" value="<?=$account_name['a_Name']?>"><br><br>
            <label for="email">Email</label><br>
            <input type="text" name="email" id="email" class="txt" <?php if(isset($info[0])){print 'value="'.$info[0].'"';} ?>><br>
            <span style="position:relative;left:20px;font-size:14px;color:rgb(249, 64, 64);font-weight:bolder">*為用戶忘記密碼寄信之用途</span><br><br>
            <input type="submit" value="EDIT" class="sub" style="background-color:#66afe9;border:none; color:white;font-weight:530;width:150px;position:relative;left:98px;top:17px">
        </form>
        <button class="btn" style="color:gray;position:relative;left:200px;top:113px" onclick="location.href='take_picture/index.php?account=<?=$id?>'">新增 Face ID</button>

        <div class="navbar1">
            <button onclick="location.href='mainpage.php?account=<?=$id?>'" style="border:none; background-color:white"><img src="source/home.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path1);?>'" style="border:none; background-color:white"><img src="source/search.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path);?>'" style="border:none; background-color:white"><img src="source/more.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='login.php'" style="border:none; background-color:white"><img src="source/logout.png" style="width:20px;height:20px"></button>
            <div><div class="your_own_photo">
                <a href="personal.php?page=<?=$id?>&user=<?=$id?>&invite=0">
                    <div class="profile_pic_form"><img src="profile_img/<?=$your_own_pic[0]?>" style="width:40px; height:auto"></div>
                </a>
            </div></div>
            </div>
        </div>

        
    </body>
</html>