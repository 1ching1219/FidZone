<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | PERSONAL POSTS</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
        <!-- HTTP 1.1 -->
        <meta http-equiv="Cache-Control" content="no-cache"/>
        <!-- HTTP 1.0 -->
        <meta http-equiv="Pragma" content="no-cache"/>
        <!-- Cache Expires -->
        <meta http-equiv="Expires" content="0"/>
    </head>
    <body>
    <div class="main" style="position:relative;left:482px;width: 540px;">
    
<?php
    // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
    $account=$_GET["user"];
    $page_owner=$_GET["page"];

    $tmp="SELECT profile_photo FROM account WHERE aId=$page_owner";
    $tmp=mysqli_query($con, $tmp);
    $profile_pic=mysqli_fetch_array($tmp);
    // $sth = $db->prepare($tmp);
    // $sth->execute();
    // $profile_pic = $sth->fetch();

    $tmp1 = "SELECT account FROM account WHERE aId=$page_owner";
    $tmp1=mysqli_query($con, $tmp1);
    $account_name=mysqli_fetch_array($tmp1);

    $tmp2 = "SELECT a_Name FROM account WHERE aId=$page_owner";
    $tmp2=mysqli_query($con, $tmp2);
    $account_nickname=mysqli_fetch_array($tmp2);
?>

<div class="top" style="line-height:50px;text-align:center;height:70px">
    <div>
        <span style="position:fixed;left:730px;top:5px"><?=$account_nickname[0]?></span>
        <span style="color:gray;position:fixed;top:25px;left:730px">POSTS</span>
    </div>
    <a href="personal.php?page=<?=$page_owner?>&user=<?=$account?>&invite=0" style="position:fixed;top:23px;left:490px">
    <img src="source/back.png" style="width:30px; height:auto;">
    </a>
</div>

<?php

    $tmp7 = "SELECT profile_photo FROM account WHERE aId=$account";
    $tmp7=mysqli_query($con, $tmp7);
    $your_own_pic=mysqli_fetch_array($tmp7);

    $path="post.php?account=".$account;
    $path1="all_public.php?account=".$account;

    $rows = "SELECT * FROM posts WHERE aId=$page_owner ORDER BY pId DESC";
    $rows=mysqli_query($con, $rows);
    foreach($rows as $row){

        $pid_each = $row["pId"];
        $pic = "SELECT photo FROM photos WHERE pId=$pid_each";
        $pic=mysqli_query($con, $pic);
        $p_description = $row["p_description"];

        $tmp3 = "SELECT profile_photo FROM account WHERE aId=$page_owner";
        $tmp3=mysqli_query($con, $tmp3);
        $profile_pic=mysqli_fetch_array($tmp3);

        // $sth3 = $db->prepare($tmp3);
        // $sth3->execute();
        // $profile_pic = $sth3->fetch();

        $tmp4 = "SELECT account FROM account WHERE aId=$page_owner";
        $tmp4=mysqli_query($con, $tmp4);
        $account_name=mysqli_fetch_array($tmp4);

        // $sth4 = $db->prepare($tmp4);
        // $sth4->execute();
        // $account_name = $sth4->fetch();

        $tmp5 = "SELECT COUNT(*) FROM friend_news WHERE to_id=$page_owner AND from_id=$account";
        $tmp5=mysqli_query($con, $tmp5);
        $var=mysqli_fetch_array($tmp5);

        // $sth5 = $db->prepare($tmp5);
        // $sth5->execute();
        // $var = $sth5->fetch();

?>

<div class="a_whole_set" id="<?=$pid_each?>" style="position:relative;top:70px">

<div class="account_name" ><a href="personal.php?page=<?=$page_owner?>&user=<?=$account?>&invite=<?=$var[0]?>">
    <div class="profile_pic_form" style="float:left"><img src="profile_img/<?=$profile_pic[0]?>" style="width:40px; height:auto"></div>
    <span style="position:relative; top:15px; left:10px"><?=$account_name[0]?></span></a>
    <?php
        if($account==$page_owner){
    ?>
    <button onclick="location.href='edit_post.php?user=<?=$account?>&pid=<?=$pid_each?>'" style="border:none; background-color:white;position:relative;top:20px;left:365px;z-index:9"><img src="source/pencil.png" style="width:20px;height:20px"></button>
    <button onclick="confirm_button(<?=$account?>, <?=$pid_each?>)" style="border:none; background-color:white;position:relative;top:20px;left:365px;z-index:9"><img src="source/trash.png" style="width:20px;height:20px"></button>
    <?php } 

    $a = "SELECT COUNT(*) FROM likes WHERE pId=$pid_each";
    $a=mysqli_query($con, $a);
    $likesNum=mysqli_fetch_array($a);

    // $a = $db->prepare($a);
    // $a->execute();
    // $likesNum = $a->fetch();

    $chk = "SELECT COUNT(*) FROM likes WHERE pId=$pid_each AND aId=$account";
    $chk=mysqli_query($con, $chk);
    $chk=mysqli_fetch_array($chk);

    // $chk = $db->prepare($chk);
    // $chk->execute();
    // $chk= $chk->fetch(); 

    ?>
</div>

<div class="wrapper"><div id="<?=$row["pId"]?>"></div>
<?php
foreach($pic as $pics){
?>
   <div style="background-image: url('post_img/<?=$pics["photo"]?>');" class="post_pic_form"></div><br>
   
<?php }?>
</div>
<div style="display:flex">
    <form action="<?php
    if(!$chk[0]){
        print'likes.php';
    }else{
        print'cancel_likes.php';
    }
    ?>
    
    " method="POST" enctype="multipart/form-data" style="position:relative; bottom:7px" id=<?=$pid_each?> name="frm1">
        <input type="hidden" name="pid" value="<?=$pid_each?>">
        <input type="hidden" name="account" value="<?=$account?>">
        <input type="hidden" name="details" value=1>
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
print('<strong>  ');?> <a href="personal.php?page=<?=$page_owner?>&user=<?=$account?>&invite=<?=$var[0]?>">
<?php
print $account_name[0].'  </strong></a>';
print('<div class="word-format">'.$p_description.'</div>');

$hold=$row['pId'];
$tmp5 ="SELECT comment, aId FROM comments WHERE pId=$hold";
$tmp5=mysqli_query($con, $tmp5);


foreach($tmp5 as $com){
    $hold2=$com["aId"];
    $tmp6 = "SELECT account FROM account WHERE aId=$hold2";
    $tmp6=mysqli_query($con, $tmp6);
    $com_name=mysqli_fetch_array($tmp6);

    // $sth6 = $db->prepare($tmp6);
    // $sth6->execute();
    // $com_name = $sth6->fetch();

    print '<br><strong>';?><a href="personal.php?page=<?=$hold2?>&user=<?=$account?>&invite=<?=$var[0]?>">
    <?php
    print $com_name[0].' </strong></a>';
    print $com["comment"];
    
    
}

?> </div>       
<br>
<form action="details_comment.php" name="<?=$row["pId"]?>" method="POST" id="<?=$row["pId"]?>">
    <input type="hidden" name="pId_comment" value="<?=$row["pId"]?>">
    <input type="hidden" name="account" value="<?=$account?>">
    <input type="text" name="comments"  required class="comment"> 
    <input type="image" onclick=<?=$row["pId"]?>.submit() src="source/send-message.png" style="width: 20px;height: 20px;position:relative;left:500px;bottom: 28px;">
</form>
<?php
print '</div><br><br>';

}?>
<script type="text/javascript">
    function confirm_button(account, pid){
        if(confirm('確定要刪除貼文嗎？')){
                var path='del_post.php?user=';
                path=path+account+'&pid='+pid;
                console.log(path);
                window.location.assign(path);
        }
    }
    window.onpageshow = function(event) {
    if (event.persisted) {
        console.log('re')
        window.history.go(0)
    }
    };
</script>
<br><br><br><br>

<div class="navbar1" style="z-index:20">
    <button onclick="location.href='mainpage.php?account=<?=$account?>'" style="border:none; background-color:white"><img src="source/home.png" style="width:20px;height:20px"></button>
    <button onclick="location.href='<?php print($path1);?>'" style="border:none; background-color:white"><img src="source/search.png" style="width:20px;height:20px"></button>
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