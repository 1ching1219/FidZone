<!DOCTYPE html>
<html>
    <head>
        <title>notification</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
    </head>
    <body>
    <?php
        $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
        $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");
        $id = $_GET["account"];
        
        $tmp = "SELECT req_amount FROM friends WHERE aId=$id";
        $sth = $db->prepare($tmp);
        $sth->execute();
        $notification = $sth->fetch();
        $rows = $db->query("SELECT * FROM friend_news WHERE to_id=$id");

        $sqll="SELECT COUNT(DISTINCT from_id) FROM messag_news WHERE to_id=$id AND check_view=0";
        // 新增一個欄位進去messag_news
        $sqll = $db->prepare($sqll);
        $sqll->execute();
        $s_amount = $sqll->fetch();

       
    ?>

    
    <div class="btn-group dropleft">
        <div style="position:fixed; left:925px;top:10px">
        <button class="border-0 bg-transparent"type="button" data-toggle="dropdown" onclick="clearInterval(stop() );"><img  src="source/bell-ring.png" style="width:20px;height:20px;position:relative;left:25px;top:3px;z-index:2"></button>
    <span class="caret">
        <div id="noti_number">
        <?php
        $rows = $db->query("SELECT * FROM friend_news WHERE to_id=$id");
        
        if($notification[0] > 0){?>
            <div class="noti" >
            <?=$notification[0]?>
        </div>
        <?php 
        } ?>
        </div>
        
    </span>

    </button>
        <ul class="dropdown-menu">

        <?php
        if($notification[0] == 0){?>
        
            <li><a href="#">沒有交友邀請...</a></li>
        <?php }else{
            foreach($rows as $row){
                $hold=$row["from_id"];
                $tmp1 = "SELECT *FROM account WHERE aId = $hold";
                $tmp1=mysqli_query($con, $tmp1);
                $who  = mysqli_fetch_array($tmp1);
                // $sth1 = $db->prepare($tmp1);
                // $sth1->execute();
                // $who = $sth1->fetch();
        ?>
            <li ><a href="#"><div style="display:flex; justify-content:space-between"><span><div style="width:40px;height:40px;border-radius:50%;overflow:hidden"><img src="profile_img/<?=$who["profile_photo"]?>" style="width:40px;height:40px"></div></span><span style="position:relative;top:10px">&nbsp&nbsp&nbsp<?=$who["a_Name"]?> 發送了交友邀請&nbsp&nbsp&nbsp</span><span>
                <form action="accept_freq.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" style="display:inline-block;text-align: right">
                    <input type="hidden" name="from_id" value="<?=$hold?>">
                    <input type="hidden" name="to_id" value="<?=$id?>">
                    <input type="submit" class="f_re" value="確認">
                </form></span><span>&nbsp
                <form action="reject_freq.php" method="POST" enctype="multipart/form-data" onsubmit="return check(event);" style="display:inline-block;text-align: right">
                    <input type="hidden" name="from_id" value="<?=$hold?>">
                    <input type="hidden" name="to_id" value="<?=$id?>">
                    <input type="submit" class="f_re" value="取消">
                </form></span>            
            </div>
            </a>

            </li>
            <?php
            }}
            ?>
            
        
        </ul>
        </div>
    </div>
    <div>
        <button class="border-0 bg-transparent" onclick="location.href='m_list.php?account=<?=$id?>'"  type="button" ><img  src="source/messenger.png" style="position:fixed;left:990px;top:13px;width:20px;height:20px"></button>
       
        <div id="s_amount">
        <?php if($s_amount[0] > 0){?>
            <div class="noti" style="position:fixed;top: 24px;;left:1000px;">
            <?=$s_amount[0]?>
        </div>
        <?php 
        } ?>
        </div>


    </div> 
    <script>
        
        var set;
        function loadDoc(event){
            
                console.log("not click");
                       
                    set = setInterval(function(){
                    console.log("running");
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("noti_number").innerHTML = this.responseText;
                        document.getElementsByClassName("dropdown-menu").innerHTML = this.responseText;
                        document.getElementById("s_amount").innerHTML = this.responseText;
                        }
                    };

                    xhttp.open("GET", "notification.php?account=<?=$id?>", true);
                    xhttp.send();
                
                }, 1000);
                
        }
             
        function stop(){
            console.log("click");
            clearInterval(set);

            window.addEventListener('click', function(e) {
                console.log("start again");
                window.location.reload();
            })  
        }
        
        loadDoc();

                
        
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>