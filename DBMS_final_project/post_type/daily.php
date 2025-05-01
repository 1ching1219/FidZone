<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="../whole.css">
        <meta charset="utf-8">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    </head>
    
    <body>
        <div class="main">
            <div><?php
    include("phone_check.php");
    ?></div>
    <?php

        $id=$_GET["account"];
        $path="../post.php?account=".$id;
        $path1="../all_public.php?account=".$id;
        // $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
        $con=mysqli_connect("localhost", "root", "", "DBMS_final");
        mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

        $tmp = "SELECT profile_photo FROM account WHERE aId=$id";
        $tmp=mysqli_query($con, $tmp);
        $your_own_pic=mysqli_fetch_array($tmp);


        $sql="SELECT * FROM posts as p, account as a where p.aId=a.aId AND a.a_Type='public' ORDER BY RAND()";
        $sql=mysqli_query($con, $sql);
        // $sql=$db->query($sql);
        ?>
            <form action="" method="POST" id="frm1" style="height:40px">
                <input type="text" placeholder="search" class="txt" id="search_text" style="border:1px solid gray;width:500px">
                <input type="image" onclick=frm1.submit() src="../source/search.png" style="width: 20px;height: 20px;position:relative;top: 10px;">
                <div id="search_result" style="position:relative;top: 1px;"></div>
            </form>

            


            <div class="all_cate">
                <button onclick="location.href='../all_public.php?account=<?=$id?>'" class="category">全部</button>
                <button onclick="location.href='../post_type/daily.php?account=<?=$id?>'" class="category">日常</button>
                <button onclick="location.href='../post_type/entertainment.php?account=<?=$id?>'" class="category">娛樂</button>
                <button onclick="location.href='../post_type/music.php?account=<?=$id?>'" class="category">音樂</button>
                <button onclick="location.href='../post_type/food.php?account=<?=$id?>'" class="category">食物</button>
                <button onclick="location.href='../post_type/exercise.php?account=<?=$id?>'" class="category">運動</button>
                <button onclick="location.href='../post_type/literature.php?account=<?=$id?>'" class="category">文學</button>
                <button onclick="location.href='../all_public.php?account=<?=$id?>'" class="category">其他</button>
            </div>
            <div class="personal_all_post" style="position:relative;bottom:50px" >
            <?php
            foreach($sql as $s){
                $temp=$s["pId"];
                $rows = "SELECT * FROM posts WHERE pId=$temp AND p_description LIKE '%#日常%'";
                $rows=mysqli_query($con, $rows);
                foreach($rows as $row){
                    $pid = $row["pId"];
                    $pic = "SELECT photo FROM photos WHERE pId = $pid";
                    $pic=mysqli_query($con, $pic);
                    $pic=mysqli_fetch_array($pic);
                    // $pic = $db->prepare($pic);
                    // $pic->execute();
                    // $pic = $pic->fetch();
                    // $p_description = $row["p_description"];
            ?>
                <a href="public_details.php?account=<?=$id?>&pId=<?=$temp?>&category=日常"><div style="background-image: url('../post_img/<?=$pic[0]?>');" class="personal_post_pic_form"></div></a><br>
            <?php
                }
            ?>
            
    <?php   
        }
    ?></div><br><br><br><br><br>
        <div class="navbar1">
            <button onclick="location.href='../mainpage.php?account=<?=$id?>'" style="border:none; background-color:white"><img src="../source/home.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path1);?>'" style="border:none; background-color:white"><img src="../source/search.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='<?php print($path);?>'" style="border:none; background-color:white"><img src="../source/more.png" style="width:20px;height:20px"></button>
            <button onclick="location.href='../login.php'" style="border:none; background-color:white"><img src="../source/logout.png" style="width:20px;height:20px"></button>
            <div><div class="your_own_photo">
                <a href="../personal.php?page=<?=$id?>&user=<?=$id?>&invite=0">
                    <div class="profile_pic_form"><img src="../profile_img/<?=$your_own_pic[0]?>" style="width:40px; height:auto"></div>
                </a>
            </div></div>
        </div></div>

        <script>
            $(document).ready(function(){
                load_data();
                function load_data(query){
                    $.ajax({
                        url:"search.php",
                        method:"GET", 
                        data:{
                            id:<?=$id?>,
                            s: query
                        },
                        success:function(data){
                            $('#search_result').html(data);
                        }
                    });
                }
                $('#search_text').keyup(function(){
                    var search=$(this).val();
                    if(search != ''){
                        load_data(search);
                    }else{
                        load_data();
                    }
                });
            });

        </script>
    </body>
</html>






                