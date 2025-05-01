<head>
<link rel="stylesheet" href="whole.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<div class="main">
<?php
    $to_id=$_GET["to"];
    $from_id=$_GET["from"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
    
    $del="DELETE FROM messag_news WHERE from_id=$to_id and to_id=$from_id";
    $db->exec($del);

    $pic="SELECT profile_photo, a_Name FROM account WHERE aId=$to_id";
    $pic=mysqli_query($con, $pic);
    $pic=mysqli_fetch_array($pic);
    // $pic=$db->prepare($pic);
    // $pic->execute();
    // $pic=$pic->fetch();
?>  
<div><?php include("phone_check.php"); ?></div>
<div class="top" style="line-height:50px;text-align:center;height:70px">
<div>
    <span style="position:fixed;left:540px;top:12px"><div style="widht:48px;height:48px;border-radius:50%;overflow:hidden"><img src="profile_img/<?=$pic["profile_photo"]?>" style='widht:48px;height:48px'></div></span>
    <span style="position:fixed;left:600px;top:13px"><?=$pic["a_Name"]?></span>
</div>
<a href="m_list.php?account=<?=$from_id?>" style="position:fixed;top:23px;left:490px">
<img src="source/back.png" style="width:30px; height:auto;">
</a>
<a href="video/index.php?to=<?=$to_id?>&from=<?=$from_id?>&already=0" style="position:relative;top:25px;left:240px">
<img src="source/phone.png" style="width:25px; height:auto;">
</a>
</div>

<div id="ccc" style="height:615px;width:540px;overflow-x:auto; overflow-y:none; position:relative;top:60px">
    <?php include('chatroom.php');?>
   
</div>

<div style='position:fixed;bottom:0px;'>
    
    <form action="send_comment.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event); " id="this_" style="position:relative;top:60px">
        <input type="hidden" name="from_id" value="<?=$from_id?>">
        <input type="hidden" name="to_id" value="<?=$to_id?>">
        <input type="text" name="comment" class="comment" style="width:480px;min-height:30px;height:fit-content;position:relative;left:27px;">
        <input type="image" onclick=this_.submit() src="source/send-message.png" style="width: 20px;height: 20px;position:relative;right:10px;top:7px">        
    </form>
    <form action="post_m_pic.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" style="position:relative;top:28px" id="this2_">
    <input type="file" accept="image/*" name="message_photo[]" multiple class="message_photo" id="filee" style="display:none"><br>
        <input type="hidden" name="from_id" value="<?=$from_id?>">
        <input type="hidden" name="to_id" value="<?=$to_id?>">
    <label for="filee" style="position:relative;bottom:27px">    
        <img src="source/pic_fo_m.png" style="height:20px;width:20px;">
        <div id="outer">
            <img src="source/close.png" style="height:6px;width:6px;position:relative;left:225px;bottom: 127px;" onclick="location.reload()">
        <img src="" style="width:200px; height:auto;position:relative;left:5px" id="mes">
        <input type="image" onclick=this2_.submit() src="source/upload.png" style="width: 20px;height: 20px;position:relative;left:35px;bottom:5px">
        </div>
    </label> 
    
    </form>
</div>
</div>
<script>
    
    //在input file內容改變的時候觸發事件
    $('#filee').change(function(){
    //獲取input file的files檔案陣列;
    //$('#filed')獲取的是jQuery物件，.get(0)轉為原生物件;
    //這邊預設只能選一個，但是存放形式仍然是陣列，所以取第一個元素使用[0];
    var file = $('#filee').get(0).files[0];
    //建立用來讀取此檔案的物件
    var reader = new FileReader();
    //使用該物件讀取file檔案
    reader.readAsDataURL(file);
    //讀取檔案成功後執行的方法函式
    reader.onload=function(e){
    //讀取成功後返回的一個引數e，整個的一個進度事件
    console.log(e);
    //選擇所要顯示圖片的img，要賦值給img的src就是e中target下result裡面
    //的base64編碼格式的地址
    $('#mes').get(0).src = e.target.result;
    var outer=document.getElementById("outer");
    outer.style="display:block";
    

    }
    })
</script>