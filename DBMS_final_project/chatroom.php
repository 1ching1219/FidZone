<!DOCTYPE html>
<html>
    <head>
        <title>fidZone | Chatroom</title>
        <link rel="stylesheet" href="whole.css">
        
    </head>
    <body >
        <?php
            $to_id=$_GET["to"];
            $from_id=$_GET["from"];
            $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

            $chats = "SELECT  * FROM `message` WHERE to_id = $to_id AND from_id=$from_id UNION
            (SELECT * FROM `message` WHERE to_id = $from_id AND from_id=$to_id) ORDER BY date_time";
            $chats=mysqli_query($con, $chats);
            // $rows=mysqli_fetch_array($result);
        ?>
       
        <div id="chatZone" style="width:520px;overflow:hidden">
        <?php
        
            foreach($chats as $chat){
                if( str_contains($chat["comment"], "viedo call<br>")){
                    $seconds=(int)preg_replace('/[^0-9]/', '', $chat["comment"]);
                    $hour = floor($seconds/3600);
                    $minute = floor(($seconds-3600 * $hour)/60);
                    $second = floor((($seconds-3600 * $hour) - 60 * $minute) % 60);
                    if($chat["from_id"] == $to_id){
                        $chat["comment"]="<div style='margin:7px 14px;display:flex'><div style='width:40px;height:40px;border-radius:50%;overflow:hidden;background:gray;text-align:center;'><img src='source/camera-left.png' style='width:15px;height:15px;position:relative;top:12px'></div><div style='position:relative;left:9px;top:4px;margin-right:10px'>vedio call<br>&nbsp&nbsp".$hour.":".$minute.":".$second."</div></div>";
                    }else{
                        $chat["comment"]="<div style='margin:7px 14px;display:flex'><div style='width:40px;height:40px;border-radius:50%;overflow:hidden;background:rgb(209, 219, 248);text-align:center;'><img src='source/camera-right.png' style='width:15px;height:15px;position:relative;top:12px'></div><div style='position:relative;left:9px;top:4px;margin-right:10px'>vedio call<br>&nbsp&nbsp".$hour.":".$minute.":".$second."</div></div>";
                    }
                }
                if(str_contains($chat["comment"], "Missed call")){
                    if($chat["from_id"] == $to_id){
                        $chat["comment"]="<div style='margin:7px;display:flex'><div style='width:40px;height:40px;border-radius:50%;overflow:hidden;background:white;text-align:center;'><img src='source/missed-call.png' style='width:40px;height:40px;position:relative;'></div><div style='position:relative;left:9px;top:11px;margin-right:10px'>Missed call</div></div>";
                    }else{
                        $chat["comment"]="<div style='margin:7px;display:flex'><div style='width:40px;height:40px;border-radius:50%;overflow:hidden;background:white;text-align:center;'><img src='source/missed-call.png' style='width:40px;height:40px;position:relative;'></div><div style='position:relative;left:9px;top:11px;margin-right:10px'>Not answer</div></div>";
                    }
                }
                if(str_contains($chat["comment"], "message_img/")){
                    if($chat["from_id"] == $to_id){
                        $chat["comment"]="<div style='background:white'><img src='".$chat['comment']."' style='width:200px;height:auto'></div>";
                    }else{
                        $chat["comment"]="<div style='background:white'><img src='".$chat['comment']."' style='width:200px;height:auto'></div>";
                    }
                }
                if($chat["comment"]!=""){
                    if($chat["from_id"] == $to_id){
                    print '<div class="left"><div class="others" ><div style="margin:4px">'.$chat["comment"].'</div></div></div>';
                }else{
                    print '<div class="right"><div class="you_own"><div style="margin:4px">'.$chat["comment"].'</div></div></div>';
                }
                }
                
        
            }?>
           
        </div>
<div id="here"></div>
    <script>
        function loadDoc(event){
            
            console.log("not click");
                   
                set = setInterval(function(){
                console.log("running");
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("chatZone").innerHTML = this.responseText;
                    }
                };

                xhttp.open("GET", "chatroom.php?to=<?=$to_id?>&from=<?=$from_id?>", true);
                xhttp.send();
            
            }, 1000);
            
        }
        loadDoc();
    </script>
    </body>
</html>