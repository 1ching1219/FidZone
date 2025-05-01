<?php
    if(isset($_GET['account'])){
        $id = $_GET["account"];
    }else{
        $id = $_GET["from"];
    }
    
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

    $call="SELECT COUNT(*) AS calls,`hash`,to_id, from_id  FROM video WHERE to_id=$id AND answer=0";
    $call=$db->prepare($call);
    $call->execute();
    $call=$call->fetch();
   
    $re_hash=str_replace("#", "", $call['hash']);

    if($call['calls'] > 0){
        $person=$call['from_id'];
    
        $call_pic="SELECT `profile_photo`, `a_Name` FROM `account` WHERE `aId`=$person";
        $call_pic=mysqli_query($con, $call_pic);
        $call_pic=mysqli_fetch_array($call_pic);
        // $call_pic=$db->prepare($call_pic);
        // $call_pic->execute();
        // $call_pic = $call_pic->fetch();
        $thestye = 'display:block;z-index:200;background:white;border:1px solid gray;color:gray;position:fixed;left:560px;top:230px;border-radius:1em;text-align:center;';
    }if($call['calls']==0){
        $thestye= 'display:none;';
    }
?>
<style>
    .call_btn{
        width: 200px;
        border: none;
        height:50px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
        background-color: white;
        font-size: 15.5px;
        font-weight: 530;
        outline: none;
        line-height: 0px;
    }
    .call_form{
        width:80px;
        height:80px;
        border-radius:50%;
        overflow:hidden;
        position:relative;
        top:60px;
        left:60px
    }
    
</style>

<div id="call">
<div style="<?=$thestye?>">
    <div style="width:400px;height:200px;border-bottom:1px solid gray">
    <div class="call_form"><img src="profile_img/<?=$call_pic['profile_photo']?>" style="width:80px;height:80px;"></div><div style="position:relative;top:15px;left:30px"><strong><?=$call_pic['a_Name']?></strong> &nbsp&nbsp的來電</div>
    </div>
    <div style="display:flex;height:fit-content;width: 400px;justify-content:space-around ">
    <button onclick="location.href='video/index.php?to=<?=$call['from_id']?>&from=<?=$call['to_id']?>&already=0<?=$call['hash']?>'" class="call_btn">answer</button>
    <button class="call_btn" onclick="location.href='del_call.php?hash=<?=$re_hash?>'" style="border-left:1px solid gray">cancel</button>
    </span>
</div>
</div>




<script>    
    var call=document.getElementById("call").value;

    function loadDoc(event){
            
        set = setInterval(function(){
            
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById("call").innerHTML = this.responseText;
                console.log(this.responseText);
                }
            };
            xhttp.open("GET", "phone_check.php?account=<?=$id?>", true);
            xhttp.send();
            
        }, 1000);
            
    }
    loadDoc();
</script>