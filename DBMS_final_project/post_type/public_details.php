<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../whole.css">
        <meta charset="utf-8">
        <!-- HTTP 1.1 -->
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <!-- HTTP 1.0 -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <!-- Cache Expires -->
        <meta http-equiv="Expires" content="0"/>
    </head>
    <body>


    <div class="main">
        <br>
        <div class="top" style="line-height:50px;text-align:center;height:60px">
            <a href="javascript:history.back()" style="position:fixed;top:15px;left:490px">
            <img src="../source/back.png" style="width:25px; height:auto;">
            </a>
        </div>
        <?php
            $id = $_GET["account"];
            $path="../post.php?account=".$id;
            $path1="../all_public.php?account=".$id;
            $category = $_GET["category"];
            $pId=$_GET["pId"];
            // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
            $tmp = "SELECT profile_photo FROM account WHERE aId=$id";
            $tmp=mysqli_query($con, $tmp);
            $your_own_pic=mysqli_fetch_array($tmp);
            // $sth = $db->prepare($tmp);
            // $sth->execute();
            // $your_own_pic = $sth->fetch();
        ?>
        
        <div class="all_posts" style="position:relative; right:8px">
        <?php
            $first = "SELECT * FROM posts as p WHERE pId = $pId";
            $first=mysqli_query($con, $first);
            $first=mysqli_fetch_array($first);
            // $first = $db->prepare($first);
            // $first->execute();
            // $first = $first->fetch();
            
            $rows = "SELECT * FROM posts NATURAL JOIN account WHERE a_Type='public' 
                    AND pId != $pId AND p_description LIKE '%$category%' ORDER BY RAND($pId)";
            $rows=mysqli_query($con, $rows);

            $index=0;
            foreach($rows as $row){

                $pid = $row["pId"];
                $aid = $row["aId"];
                $p_description = $row["p_description"];
                
                if($index==0){
                    $pid=$pId;
                    $sth="SELECT aId, p_description FROM posts WHERE pId=$pid";
                    $sth=mysqli_query($con, $sth);
                    $sth=mysqli_fetch_array($sth);
                    // $sth=$db->prepare($sth);
                    // $sth->execute();
                    // $sth=$sth->fetch();
                    $aid=$sth['aId'];
                    $p_description=$sth['p_description'];
                    
                    $index +=1;
                }
                $pic = "SELECT photo FROM photos WHERE pId = $pid";
                $pic = mysqli_query($con, $pic);
                

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

                
                ?>
                
                <div class="a_whole_set">

                <div class="account_name"><a href="../personal.php?page=<?=$aid?>&user=<?=$id?>&invite=0">
                    <div class="profile_pic_form" style="float:left"><img src="../profile_img/<?=$profile_pic[0]?>" style="width:40px; height:auto"></div>
                    <span style="position:relative; top:15px; left:10px"><?=$account_name[0]?></span></a>
                </div>

                <div class="wrapper"><div id="<?=$pid?>"></div>
                <?php
                foreach($pic as $pics){
                ?>
                   <div style="background-image: url('../post_img/<?=$pics["photo"]?>');" class="post_pic_form"></div><br>
                   
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
                print'../likes.php';
            }else{
                print'../cancel_likes.php';
            }
            ?>
            
            " method="POST" enctype="multipart/form-data" style="position:relative; bottom:7px" id=<?=$pid?> name=""frm1>
                <input type="hidden" name="pid" value="<?=$pid?>">
                <input type="hidden" name="account" value="<?=$id?>">
                <input type="hidden" name="details" value=0>
                
                <input type="image" onclick=frm1.submit() src="../source/<?php
            if(!$chk[0]){
                print'like.png';
            }else{
                print'like1.png';
            }
            ?>" style="width: 20px;height: 20px;position:relative;left:5px;top: 4px;">
            </form>&nbsp&nbsp<?=$likesNum[0]?>人說讚</div>
            <div class="comment_zone">
            <?php
                print('<strong>  ');?> <a href="../personal.php?page=<?=$aid?>&user=<?=$id?>&invite=0">
                <?php
                print $account_name[0].'  </strong></a>';
                print('<div class="word-format">'.$p_description.'</div>');
                
                $hold=$row['pId'];
                $tmp4 ="SELECT comment, aId FROM comments WHERE pId=$hold";
                $tmp4=mysqli_query($con, $tmp4);
                
    
                foreach($tmp4 as $com){
                    $hold2=$com["aId"];
                    $tmp5 = "SELECT account FROM account WHERE aId=$hold2";
                    $sth5=mysqli_query($con, $tmp5);
                    $com_name=mysqli_fetch_array($sth5);
                    // $sth5 = $db->prepare($tmp5);
                    // $sth5->execute();
                    // $com_name = $sth5->fetch();

                    print '<br><strong>';?><a href="../personal.php?page=<?=$com["aId"]?>&user=<?=$id?>&invite=0">
                    <?php
                    print $com_name[0].' </strong></a>';
                    print $com["comment"];
                    
                    
                }

                ?>
                </div>     
                <br>
                <form action="../comment.php" name="<?=$row["pId"]?>" method="POST" id="<?=$row["pId"]?>">
                    <input type="hidden" name="pId_comment" value="<?=$row["pId"]?>">
                    <input type="hidden" name="account" value="<?=$id?>">
                    <input type="text" placeholder="leave a comment..." name="comments"  required class="comment"> 
                    <input type="image" onclick=<?=$row["pId"]?>.submit() src="../source/send-message.png" style="width: 20px;height: 20px;position:relative;left:500px;bottom: 28px;">
                </form>
            <?php
                print '</div><br><br>';
                
            }
            $tmp7 = "SELECT profile_photo FROM account WHERE aId=$id";
            $sth7=mysqli_query($con, $tmp7);
            $your_own_pic=mysqli_fetch_array($sth7);
            // $sth7 = $db->prepare($tmp7);
            // $sth7->execute();
            // $your_own_pic = $sth7->fetch();
            
            ?>
            
            <div style="text-align:center; width:540px;padding:40px">沒有更多貼文了...</div>
            <br><br><br><br>
            <div class="navbar1">
                <button onclick="location.href='../mainpage.php?account=<?=$id?>'" style="border:none; background-color:white"><img src="../source/home.png" style="width:20px;height:20px"></button>
                <button onclick="location.href='<?php print($path1);?>'" style="border:none; background-color:white"><img src="../source/search.png" style="width:20px;height:20px"></button>
                <button onclick="location.href='<?php print($path);?>'" style="border:none; background-color:white"><img src="../source/more.png" style="width:20px;height:20px"></button>
                <button onclick="location.href='../login.php'" style="border:none; background-color:white"><img src="../source/logout.png" style="width:20px;height:20px"></button>
                <div><div class="your_own_photo">
                    <a href="personal.php?page=<?=$id?>&user=<?=$id?>&invite=0">
                        <div class="profile_pic_form"><img src="../profile_img/<?=$your_own_pic[0]?>" style="width:40px; height:auto"></div>
                    </a>
                </div></div>
            </div></div>
        </div>
    <script>
        window.onpageshow = function(event) {
        if (event.persisted) {
            console.log('re')
            window.history.go(0)
        }}
    </script>
    </body>
</html>