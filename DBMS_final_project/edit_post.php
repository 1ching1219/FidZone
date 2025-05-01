<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | MAIN</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
    </head>
    <body>
        <div style="position:fixed;left: 500px;top:120px">
        <button onclick="window.history.back();" style="border:none; background-color:white;position:fixed;top:15px;left:490px;z-index:12"><img src="source/back.png" style="width:20px;height:20px"></button>
        <div style="position:fixed;top:0px;left:490px;width:540px;height:50px;line-height:50px;border-bottom:1px solid rgb(209, 207, 207);text-align:center">EDIT POST</div> 
        <?php
            $pid=$_GET["pid"];
            $account=$_GET["user"];
            $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

            $tmp="SELECT p_description FROM posts WHERE pId=$pid";
            $tmp=mysqli_query($con, $tmp);
            $p_description=mysqli_fetch_array($tmp);
            // $sth = $db->prepare($tmp);
            // $sth->execute();
            // $p_description = $sth->fetch();

            $path="post.php?account=".$account;

            $tmp7 = "SELECT profile_photo FROM account WHERE aId=$account";
            $tmp7=mysqli_query($con, $tmp7);
            $your_own_pic=mysqli_fetch_array($tmp7);
            // $sth7 = $db->prepare($tmp7);
            // $sth7->execute();
            // $your_own_pic = $sth7->fetch();

            $pic = "SELECT photo FROM photos WHERE pId = $pid";
            $pic=mysqli_query($con, $pic);

        ?>
        <div style="width:500px;overflow-x:auto;height:120px;display:flex;border-radius:3px;position:relative;left:5px;">
             <?php
                foreach($pic as $pics){
                ?>
                <div style="background-image: url('post_img/<?=$pics["photo"]?>');width:200px;height:100px" class="post_pic_form"></div><br>
                   
            <?php }?>
        </div><br>
        <form action="edit_sql.php" method="POST">
            <input type="hidden" name="account" value="<?=$account?>">
            <input type="hidden" name="pId" value="<?=$pid?>">
            <textarea name="p_description"><?=$p_description[0]?></textarea><br><br>
            <input type="submit" class="P_sub" style="position:relative;left:170px" value="EDIT">
        </form>
        <div class="navbar1" style="z-index:20">
            <button onclick="location.href='mainpage.php?account=<?=$account?>'" style="border:none; background-color:white"><img src="source/home.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path);?>'" style="border:none; background-color:white"><img src="source/more.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='login.php'" style="border:none; background-color:white"><img src="source/logout.png" style="width:20px;height:20px"></button>
            <div><div class="your_own_photo">
                <a href="personal.php?page=<?=$account?>&user=<?=$account?>&invite=0">
                    <div class="profile_pic_form"><img src="profile_img/<?=$your_own_pic[0]?>" style="width:40px; height:auto"></div>
                </a>
            </div></div>
        </div>  
    </div>
</body>