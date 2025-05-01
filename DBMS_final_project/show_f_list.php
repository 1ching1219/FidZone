<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | Friend List</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
    </head>
    <body>
        <?php
        $page=$_GET["page"];
        $account=$_GET["user"];
        $invite=$_GET["invite"];
        // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
        $con=mysqli_connect("localhost", "root", "", "DBMS_final");
        mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
        $rows ="SELECT * FROM friend_lists WHERE aId=$page OR aId2=$page";
        $rows=mysqli_query($con, $rows);
        
        ?>
        <div class="main" >
        <div class="top" style="line-height:50px;text-align:center;height:70px">
        
        <a href="personal.php?page=<?=$page?>&user=<?=$account?>&invite=<?=$invite?>" style="position:fixed;top:23px;left:490px">
        <img src="source/back.png" style="width:30px; height:auto;">
        </a>
        </div>
        <div class="a_whole_set" style="text-align:center;position:relative;top:80px"><div style="width:fit-content;position:relative;left:40px">
    <?php
        
        foreach($rows as $row){
            
            if($row["aId"]==$page){
                
                $hold=$row["aId2"];
                $tmp = "SELECT a_Name FROM account WHERE aId = $hold";
                $tmp=mysqli_query($con, $tmp);
                $friends=mysqli_fetch_array($tmp);
                // $sth = $db->prepare($tmp);
                // $sth->execute();
                // $friends = $sth->fetch();
                $tmp1 = "SELECT profile_photo FROM account WHERE aId=$hold";
                $tmp1=mysqli_query($con, $tmp1);
                $profile_pic=mysqli_fetch_array($tmp1);
                // $sth1 = $db->prepare($tmp1);
                // $sth1->execute();
                // $profile_pic = $sth1->fetch();
            ?>

        
            <div style="width:fit-content;display:flex;justify-content:space-between; height:50px" ><a href="personal.php?page=<?=$row["aId2"]?>&user=<?=$account?>&invite=1">
                <div class="profile_pic_form" style="float:left;height:60px;width:60px"><img src="profile_img/<?=$profile_pic[0]?>" style="width:70px; height:auto"></div>
                <span style="position:relative; top:18px; left:15px;"><?=$friends[0]?></span></a>
            <span>&nbsp&nbsp&nbsp
                <form action="del_freq.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm_button()" style="position:relative;left: 60px;">
                    <input type="hidden" name="aid" value="<?=$row["aId"]?>">
                    <input type="hidden" name="aid2" value="<?=$row["aId2"]?>">
                    <input type="hidden" name="page" value="<?=$page?>">
                    <input type="hidden" name="account" value="<?=$account?>">
                    <?php
                        if($row["aId2"]!=$account && $page==$account){
                        ?>
                        <input type="submit" class="del_f_btn" value="刪除好友">
                        <?php
                        }
                        ?>
                </form>
            </span>
        </div><br>
            <?php    
            }else{
                $hold=$row["aId"];
                $tmp = "SELECT a_Name FROM account WHERE aId = $hold";
                $tmp=mysqli_query($con, $tmp);
                $friends=mysqli_fetch_array($tmp);
                // $sth = $db->prepare($tmp);
                // $sth->execute();
                // $friends = $sth->fetch();
                $tmp1 = "SELECT profile_photo FROM account WHERE aId=$hold";
                $tmp1=mysqli_query($con, $tmp1);
                $profile_pic=mysqli_fetch_array($tmp1);
                // $sth1 = $db->prepare($tmp1);
                // $sth1->execute();
                // $profile_pic = $sth1->fetch();
            ?>
            <div style="width:fit-content;display:flex;justify-content:space-between; height:50px" ><a href="personal.php?page=<?=$row["aId"]?>&user=<?=$account?>&invite=1">
                <div class="profile_pic_form" style="float:left;height:60px;width:60px"><img src="profile_img/<?=$profile_pic[0]?>" style="width:70px; height:auto"></div>
                <span style="position:relative; top:18px; left:15px;"><?=$friends[0]?></span></a>
                <span style='width: 50px;'>&nbsp&nbsp&nbsp
                    <form action="del_freq.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm_button()" style="position:relative;left: 70px;">
                        <input type="hidden" name="aid" value="<?=$row["aId"]?>">
                        <input type="hidden" name="aid2" value="<?=$row["aId2"]?>">
                        <input type="hidden" name="page" value="<?=$page?>">
                        <input type="hidden" name="account" value="<?=$account?>">
                        
                        <?php
                        if($row["aId"]!=$account && $page==$account){
                        ?>
                        <input type="submit" class="del_f_btn" value="刪除好友"  >
                        <?php
                        }
                        ?>
                    </form>
                </span>
            </div><br>
            <?php

            }
        }

    ?>
    <script type="text/javascript">
        function confirm_button(){
            if(confirm('確定要刪除該好友嗎？')==true){
                return true;
            }
            return false;
        }
        
    </script>
    </div>
    </div>
    </div>
    </body>
</html>
