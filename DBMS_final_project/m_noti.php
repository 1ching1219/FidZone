<!DOCTYPE html><html>
    <head>
        <link rel="stylesheet" href="whole.css">
        <!-- <meta http-equiv="refresh" content="1"> -->
    </head>
    <body>
    <?php
        $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
        $sqll="SELECT COUNT(to_id) FROM messag_news WHERE to_id=$id";
        $sqll = $db->prepare($sqll);
        $sqll->execute();
        $s_amount = $sqll->fetch();
        if($s_amount[0] > 0){
        ?>
        <div class="noti" id="s_amount">
        <?=$s_amount[0]?></div>
       <?php }?>
        <script>
            function loadDoc(event){
            
            console.log("not click");
                   
                set = setInterval(function(){
                console.log("running");
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("s_amount").innerHTML = this.responseText;
                    }
                };

                xhttp.open("GET", "notification.php?account=<?=$id?>", true);
                xhttp.send();
            
            }, 1000);
            
        }
        loadDoc();
        </script>
    
    </body>
</html>