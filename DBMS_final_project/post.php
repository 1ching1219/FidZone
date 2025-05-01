<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | Post</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="whole.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body>
      
        <div class="body"style="position:relative;left:780px;top:210px">
        <div style="position:fixed;top:0px;left:490px;width:540px;height:50px;line-height:50px;border-bottom:1px solid rgb(209, 207, 207)">NEW POST</div> 
        <?php
            $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
            $account=$_GET['account'];
            $tmp7 = "SELECT profile_photo FROM account WHERE aId=$account";
            $sth7 = $db->prepare($tmp7);
            $sth7->execute();
            $your_own_pic = $sth7->fetch();
            $path="post.php?account=".$account;
            $path1="all_public.php?account=".$account;
        ?>
        <form action="insert_post.php?account=<?php print($account);?>" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" >
        <!-- <div style="color:rgb(104, 104, 104);position:relative;right:200px;bottom:30px;font: size 20px;">Select Pictures</div> -->
            <label for="file" style="position:relative;right:200px;bottom:10px;width:80px;height:80px" >
            <img src="source/more.png" class="imgimg" alt="" id="this_one">
            </label> 
            <div id="preview_progressbarTW_imgs" style="width: 520px; height: 120px; overflow-x:auto; display:flex;position:relative;top:10px;left:10px;line-height:60px;">
            <p style="position:relative;left:130px">No picture has been selected yet...</p>
            </div>

            <input type="file" accept="image/*" name="photo[]" id="file" multiple style="display:none"><br>

            <textarea name="p_description" class="textarea" placeholder="write down your story..." required></textarea>
            <input type="submit" value="POST" class="P_sub">
        </form>
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
        </div>
        <script>
            $("#file").change(function(){
            $("#preview_progressbarTW_imgs").html(""); // 清除預覽
            readURL(this);
            });

            function readURL(input){
            if (input.files && input.files.length >= 0) {
                for(var i = 0; i < input.files.length; i ++){
                var reader = new FileReader();
                reader.onload = function (e) {
                    var img = $("<img width='200px' height='100px' style='margin:0px 5px; border:1px solid gray;border-radius:10px'>").attr('src', e.target.result);
                    $("#preview_progressbarTW_imgs").append(img);
                }
                reader.readAsDataURL(input.files[i]);
                }
            }else{
                var noPictures = $("<p>目前沒有圖片</p>");
                $("#preview_progressbarTW_imgs").append(noPictures);
            }
            }
        </script>
        
    </body>
</html>