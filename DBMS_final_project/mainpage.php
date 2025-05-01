<!DOCTYPE html>
<html lang="zh-TW">
    <head>
        <meta charset="utf-8">
        <title>fidZone | MAIN</title>
        
        <link rel="stylesheet" href="whole.css">
        <!-- HTTP 1.1 -->
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <!-- HTTP 1.0 -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <!-- Cache Expires -->
        <meta http-equiv="Expires" content="0"/>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

        
    </head>
    
    <body>
        <div>
            
            <?php
            
            include("phone_check.php");

            ?>
        </div>
    <div class="main">
        <div class="top">
        <div style="height:50px;width:auto;overflow:hidden;position:relative;bottom:5px">
            <a href=""><img src="source/logo.png" style="height:65px;width:auto"></a>
        </div>
        <?php
            $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
            $id = $_GET["account"];
            $path="post.php?account=".$id;
            $path1="all_public.php?account=".$id;
            include("notification.php");
        ?>
        
        </div>
        <br>
        <div class="all_posts">
        <?php
            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
            $sql="SELECT * FROM posts ORDER BY RAND(1)";
            $rows=mysqli_query($con, $sql);
            // $rows=mysqli_fetch_array($result);
            // print $row['profile_photo'];
            // $rows = $db->query("SELECT * FROM posts ORDER BY pId DESC");
            foreach($rows as $row){

                $pid = $row["pId"];
                $aid = $row["aId"];
                $pic = "SELECT photo FROM photos WHERE pId = $pid";
                $pic=mysqli_query($con, $pic);
                $p_description = $row["p_description"];

                $tmp = "SELECT profile_photo FROM account WHERE aId=$aid";
                $tmp=mysqli_query($con, $tmp);
                $profile_pic=mysqli_fetch_array($tmp);
                // $sth = $db->prepare($tmp);
                // $sth->execute();
                // $profile_pic = $sth->fetch();

                $tmp1 = "SELECT account FROM account WHERE aId=$aid";
                $tmp1=mysqli_query($con, $tmp1);
                $account_name=mysqli_fetch_array($tmp1);
                // $sth1 = $db->prepare($tmp1);
                // $sth1->execute();
                // $account_name = $sth1->fetch();

                $tmpa = "SELECT COUNT(*) FROM friend_lists WHERE aId=$id AND aId2=$aid";
                $tmpa=mysqli_query($con, $tmpa);
                $is_friend_a=mysqli_fetch_array($tmpa);
                // $stha = $db->prepare($tmpa);
                // $stha->execute();
                // $is_friend_a = $stha->fetch();

                $tmpb = "SELECT COUNT(*) FROM friend_lists WHERE aId=$aid AND aId2=$id";
                $tmpb=mysqli_query($con, $tmpb);
                $is_friend_b=mysqli_fetch_array($tmpb);
                // $sthb = $db->prepare($tmpb);
                // $sthb->execute();
                // $is_friend_b = $sthb->fetch();

                if($is_friend_a[0] or $is_friend_b[0]){
                    
                

                ?>
                
                <div class="a_whole_set">

                <div class="account_name"><a href="personal.php?page=<?=$aid?>&user=<?=$id?>&invite=0">
                    <div class="profile_pic_form" style="float:left"><img src="profile_img/<?=$profile_pic[0]?>" style="width:40px; height:auto"></div>
                    <span style="position:relative; top:15px; left:10px"><?=$account_name[0]?></span></a>
                </div>

                <div class="wrapper"><div id="<?=$row["pId"]?>"></div>
                <?php
                foreach($pic as $pics){
                ?>
                   <div style="background-image: url('post_img/<?=$pics["photo"]?>');" class="post_pic_form"></div><br>
                   
            <?php }
                $a = "SELECT COUNT(*) FROM likes WHERE pId=$pid";
                $a=mysqli_query($con, $a);
                $likesNum=mysqli_fetch_array($a);
                // $a = $db->prepare($a);
                // $a->execute();
                // $likesNum = $a->fetch();

                $chk = "SELECT COUNT(*) FROM likes WHERE pId=$pid AND aId=$id";
                $chk=mysqli_query($con, $chk);
                $chk=mysqli_fetch_array($chk);
                // $chk = $db->prepare($chk);
                // $chk->execute();
                // $chk= $chk->fetch();                       
            ?>
            </div>
            <div style="display:flex">
            <form action="<?php
            if(!$chk[0]){
                print'likes.php';
            }else{
                print'cancel_likes.php';
            }
            ?>
            
            " method="POST" enctype="multipart/form-data" style="position:relative; bottom:7px" id=<?=$pid?> name=""frm1>
                <input type="hidden" name="pid" value="<?=$pid?>">
                <input type="hidden" name="account" value="<?=$id?>">
                <input type="hidden" name="details" value=0>
                
                <input type="image" onclick=frm1.submit() src="source/<?php
            if(!$chk[0]){
                print'like.png';
            }else{
                print'like1.png';
            }
            ?>" style="width: 20px;height: 20px;position:relative;left:5px;top: 4px;">
            </form>&nbsp&nbsp<?=$likesNum[0]?>人說讚</div>
            <div class="comment_zone">
            <?php
                print('<strong>  ');?> <a href="personal.php?page=<?=$aid?>&user=<?=$id?>&invite=0">
                <?php
                print $account_name[0].'  </strong></a>';
                print($p_description);
                
                $hold=$row['pId'];
                $tmp4 ="SELECT comment, aId FROM comments WHERE pId=$hold";
                $tmp4 = mysqli_query($con, $tmp4);
                
                foreach($tmp4 as $com){
                    $hold2=$com["aId"];
                    $tmp5 = "SELECT account FROM account WHERE aId=$hold2";
                    $tmp5=mysqli_query($con, $tmp5);
                    $com_name=mysqli_fetch_array($tmp5);
                    // $sth5 = $db->prepare($tmp5);
                    // $sth5->execute();
                    // $com_name = $sth5->fetch();

                    print '<br><strong>';?><a href="personal.php?page=<?=$com["aId"]?>&user=<?=$id?>&invite=0">
                    <?php
                    print $com_name[0].' </strong></a>';
                    print $com["comment"];
                    
                    
                }

                ?>
                </div>     
                <br>
                <form action="comment.php" name="<?=$row["pId"]?>" method="POST" id="<?=$row["pId"]?>">
                    <input type="hidden" name="pId_comment" value="<?=$row["pId"]?>">
                    <input type="hidden" name="account" value="<?=$id?>">
                    <input type="text" placeholder="leave a comment..." name="comments"  required class="comment"> 
                    <input type="image" onclick=<?=$row["pId"]?>.submit() src="source/send-message.png" style="width: 20px;height: 20px;position:relative;left:500px;bottom: 28px;">
                </form>
            <?php
                print '</div><br><br>';
                
            }}
            $tmp7 = "SELECT profile_photo FROM account WHERE aId=$id";
            $tmp7=mysqli_query($con, $tmp7);
            $your_own_pic=mysqli_fetch_array($tmp7);
            // $sth7 = $db->prepare($tmp7);
            // $sth7->execute();
            // $your_own_pic = $sth7->fetch();
            
            ?>
            
            <div style="text-align:center; width:540px;padding:40px">沒有更多貼文了...</div>
            <br><br><br><br>
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
        </div>
        <script>

            
            window.onpageshow = function(event) {
            if (event.persisted) {
                console.log('re')
                window.history.go(0)
                
            }
            };
            
        </script>
    </body>
</html>