<!DOCTYPE html>
<?php
    // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

    $account=$_GET["user"];
    $page_owner=$_GET["page"];
    $invite=$_GET["invite"];
    

    $tmpp = "SELECT COUNT(*) FROM friend_news WHERE to_id=$page_owner AND from_id=$account";
    $tmpp=mysqli_query($con, $tmpp);
    $var=mysqli_fetch_array($tmpp);
    // $sthp = $db->prepare($tmpp);
    // $sthp->execute();
    // $var = $sthp->fetch();

    $tmpa = "SELECT COUNT(*) FROM friend_lists WHERE aId=$page_owner AND aId2=$account";
    $tmpa=mysqli_query($con, $tmpa);
    $is_friend_a=mysqli_fetch_array($tmpa);
    // $stha = $db->prepare($tmpa);
    // $stha->execute();
    // $is_friend_a = $stha->fetch();

    $tmpb = "SELECT COUNT(*) FROM friend_lists WHERE aId=$account AND aId2=$page_owner";
    $tmpb=mysqli_query($con, $tmpb);
    $is_friend_b=mysqli_fetch_array($tmpb);
    // $sthb = $db->prepare($tmpb);
    // $sthb->execute();
    // $is_friend_b = $sthb->fetch();

    $public = "SELECT a_Type FROM account WHERE aId=$page_owner";
    $public=mysqli_query($con, $public);
    $public=mysqli_fetch_array($public);
    // $public = $db->prepare($public);
    // $public->execute();
    // $public = $public->fetch();

    if($is_friend_a[0] or $is_friend_b[0]){
        $var="✓ friend";
    }else{
        if($var[0]==1){
            $var="取消邀請";
        }else{
            $var="加好友";
        }
    }

    
    
    $tmp="SELECT profile_photo FROM account WHERE aId=$page_owner";
    $tmp=mysqli_query($con, $tmp);
    $profile_pic=mysqli_fetch_array($tmp);
    // $sth = $db->prepare($tmp);
    // $sth->execute();
    // $profile_pic = $sth->fetch();

    $tmp1 = "SELECT account FROM account WHERE aId=$page_owner";
    $tmp1=mysqli_query($con, $tmp1);
    $account_name=mysqli_fetch_array($tmp1);
    // $sth1 = $db->prepare($tmp1);
    // $sth1->execute();
    // $account_name = $sth1->fetch();

    $tmp2 = "SELECT a_Name FROM account WHERE aId=$page_owner";
    $tmp2=mysqli_query($con, $tmp2);
    $account_nickname=mysqli_fetch_array($tmp2);
    // $sth2 = $db->prepare($tmp2);
    // $sth2->execute();
    // $account_nickname = $sth2->fetch();

    $tmp3 = "SELECT SUM(postNum) FROM account WHERE aId=$page_owner";
    $tmp3=mysqli_query($con, $tmp3);
    $postNum=mysqli_fetch_array($tmp3);
    // $sth3 = $db->prepare($tmp3);
    // $sth3->execute();
    // $postNum = $sth3->fetch();

    $tmp8 = "SELECT SUM(f_amount) FROM account WHERE aId=$page_owner";
    $tmp8=mysqli_query($con, $tmp8);
    $f_amount=mysqli_fetch_array($tmp8);
    // $sth8 = $db->prepare($tmp8);
    // $sth8->execute();
    // $f_amount = $sth8->fetch();   

    $tmp7 = "SELECT profile_photo FROM account WHERE aId=$account";
    $tmp7=mysqli_query($con, $tmp7);
    $your_own_pic=mysqli_fetch_array($tmp7);
    // $sth7 = $db->prepare($tmp7);
    // $sth7->execute();
    // $your_own_pic = $sth7->fetch();

    $path="post.php?account=".$account;
    $path1="all_public.php?account=".$account;

?>
<html>
    <head>
        <title>fidZone | <?=$account_name[0]?></title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
        
    </head>
    <body>
        <div class="main">
        <div class="top" style="line-height:50px;text-align:center;font-size:20px"><strong><?=$account_name[0]?></strong></div>
        <div style="position:relative;top:50px">
        <div class="personal_account_name">
            <!-- <div style=" font-size:30px"><strong><?=$account_name[0]?></strong></div><br> -->
            <div class="personal_profile_pic_form" ><img src="profile_img/<?=$profile_pic[0]?>" style="width:100px; height:auto"></div><br>
            <div style=" font-size:18px"><?=$account_nickname[0]?></div>
        </div>
        <div class="personal_infobox">
            <div style=" font-size:25px; position:relative;bottom:40px;left:20px" ><?=$postNum[0]?><br><span style="font-size:15px;position:relative;right:10px">Post</span></div>
            <div style=" font-size:25px; position:relative;bottom:40px;left:20px">
            <?php
                 if($is_friend_a[0] or $is_friend_b[0] or ($page_owner==$account) and $f_amount[0]>0){
                    print '<a href="show_f_list.php?page='.$page_owner.'&user='.$account.'&invite='.$invite.'">';}
            ?>
                <?=$f_amount[0]?>
            <?php
            if($is_friend_a[0] or $is_friend_b[0] or ($page_owner==$account)){
                print'</a>';}
            ?>
            <br><span style="font-size:15px;position:relative;right:10px">Friend</span>
        </div>
        </div>
        <?php
        if($account!=$page_owner){
        ?>
        
        <input type="button"  value="<?=$var?>" onclick="<?php
        
        if($var=="✓ friend"){
            print "confirm_button($account, $page_owner)";

        }else{
            print "location.href='friend_req.php?user=$account&page=$page_owner'";
        }
        
        ?>" class="f_sub" >
        <input type="button" value="send message" onclick="location.href='send.php?to=<?=$page_owner?>&from=<?=$account?>#here'" class="f_sub">
            
        <?php
    
        }else{
            $p_tmp="location.href='edit_person_info.php?account=".$account."'";
            print '<input type="button" value="Edit personal info"  class="F_sub" onclick="'.$p_tmp.'" >';
        } 
        
        if($is_friend_a[0] or $is_friend_b[0] or ($page_owner==$account) or ($public[0]=='public')){
        
        ?>

        <div class="personal_all_post" >
        <?php
            $rows = "SELECT * FROM posts WHERE aId=$page_owner ORDER BY pId DESC";
            $rows=mysqli_query($con, $rows);
            foreach($rows as $row){
                $pid = $row["pId"];
                $pic = "SELECT photo FROM photos WHERE pId = $pid ";
                $pic=mysqli_query($con, $pic);
                $pic=mysqli_fetch_array($pic);
                // $pic = $db->prepare($pic);
                // $pic->execute();
                // $pic = $pic->fetch();
                $p_description = $row["p_description"];
        ?>
            <a href="details.php?user=<?=$account?>&page=<?=$page_owner?>#<?=$pid?>"><div style="background-image: url('post_img/<?=$pic[0]?>');" class="personal_post_pic_form"></div></a><br>
        <?php
            }
        ?>
        </div><br><br><br><br><br>
        <?php
            }else{
                print'<div style="margin-top:100px; width:540px;text-align:center">你們尚未成為好友</div>';
            }?>
 

        <script type="text/javascript">
            function confirm_button(account, pageowner){
                if(confirm('確認刪除好友？')){
                        var path='del_friend.php?aid=';
                        path=path+account+'&aid2='+pageowner;
                        console.log(path);
                        window.location.assign(path);
                }
            }
        </script>
        
        </div>
        
        <div class="navbar1">
            <button onclick="location.href='mainpage.php?account=<?=$account?>'" style="border:none; background-color:white"><img src="source/home.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path1);?>'" style="border:none; background-color:white"><img src="source/search.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path);?>'" style="border:none; background-color:white"><img src="source/more.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='login.php'" style="border:none; background-color:white"><img src="source/logout.png" style="width:20px;height:20px"></button>
            <div><div class="your_own_photo">
                <a href="personal.php?page=<?=$account?>&user=<?=$account?>&invite=0">
                    <div class="profile_pic_form"><img src="profile_img/<?=$your_own_pic[0]?>" style="width:40px; height:auto"></div>
                </a>
            </div></div>
        </div></div>
    </body>
</html>