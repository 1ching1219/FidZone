<!DOCTYPE html><html>
<head>
    <title></title>
    <link rel="stylesheet" href="whole.css">
</head>
<body>
<?php
    $to_id=$_GET["account"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
    $sth="SELECT DISTINCT from_id,to_id, a_Name, profile_photo FROM `message`, account WHERE to_id=$to_id AND from_id=aId ORDER BY date_time DESC";
    $who_send=mysqli_query($con, $sth);
    // $rows=mysqli_fetch_array($result);
    // $who_send = $db->query($sth);

    $set_check="UPDATE messag_news SET check_view=1";
    $db->exec($set_check);

    $sth1="SELECT COUNT(to_id) FROM `message` WHERE to_id=$to_id";
    $sth1=$db->prepare($sth1);
    $sth1->execute();
    $check_exist=$sth1->fetch();?>

    <div class='main' style='text-align:center'>
        <div class="top" style="line-height:50px;text-align:center;height:70px">
        <div>
            <span style="position:fixed;left:715px;top:10px">CHATROOM</span>
            
        </div>
        <a href="mainpage.php?account=<?=$to_id?>" style="position:fixed;top:23px;left:490px">
        <img src="source/back.png" style="width:30px; height:auto;">
        </a>
        </div>

    <?php
    if($check_exist[0]==0){?>

    <div style="position:relative;top:300px;font-size:20px;color:rgb(74, 71, 71)">chat with others！</div>

    <?php
    }else{ ?>

    <div class="all_m">

    <?php
    foreach($who_send as $who){
        $from_id=$who["from_id"];
        $a_Name=$who["a_Name"];
        $to_id=$who["to_id"];
        $profile_photo=$who["profile_photo"];

        $sqll="SELECT COUNT(DISTINCT from_id) FROM messag_news WHERE to_id=$to_id and from_id=$from_id";
        $sqll = $db->prepare($sqll);
        $sqll->execute();
        $s_amount = $sqll->fetch();

        $sth1="SELECT * FROM `message` WHERE from_id=$from_id AND to_id=$to_id 
                AND date_time = (SELECT MAX(date_time) FROM `message` WHERE from_id=$from_id AND to_id=$to_id GROUP BY to_id, from_id) 
                ORDER BY date_time DESC";
        $sth1=mysqli_query($con, $sth1);
        $newest=mysqli_fetch_array($sth1);
        // $sth1=$db->prepare($sth1);
        // $sth1->execute();
        // $newest=$sth1->fetch();
?>

    <div class="each_room"><a href="send.php?to=<?=$from_id?>&from=<?=$to_id?>#here">
        <div class="chat_profile_form"><img src="profile_img/<?=$profile_photo?>" style="width:80px;height:80px"></div>
        <span class="chat_show" style="color:<?php
            if($s_amount[0]>0){
                print 'black';
            }else{
                print 'rgb(174,174,174)';
            }

        ?>"><?php
        if(str_contains($newest["comment"], "viedo call<br>")){
            $newest["comment"]="video call";
        }
        print $newest["comment"];
        ?></span>
    </a></div>
    


<?php }?>
    </div>
<?php } ?>

</div>

</body>
</html>
