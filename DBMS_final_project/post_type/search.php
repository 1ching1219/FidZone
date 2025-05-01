<!DOCTYPE html><html lang="zh-TW">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
            $con=mysqli_connect("localhost", "root", "", "DBMS_final");
            if(empty($con)){
                print mysqli_error($con);
                die("資料庫連接失敗");
                exit;
            }
            if(!mysqli_select_db($con, "dbms_final")){
                die("選取資料失敗");
            }
            mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

            if(isset($_GET['s'])){
                $s = mysqli_real_escape_string($con, $_GET['s']);
                $sql="SELECT * FROM `account` WHERE a_Name LIKE '%".$s."%' OR `account` LIKE '%".$s."%'";
                $result=mysqli_query($con, $sql);

                if(!$result){
                    echo("錯誤:".mysqli_error($con));
                    exit();
                }
                if(mysqli_num_rows($result)<=0){
                    echo "查無符合「".$s."」的結果";
                }
                while($row=mysqli_fetch_array($result)){
                    echo '<a href="../personal.php?page='.$row['aId'].'&user='.$_GET['id'].'&invite=0"><div class="searchs">';
                    echo '<div style="height:45px;width:45px;border-radius:50%;overflow:hidden;position:relative;left:5px;top:10px"><img src="../profile_img/'.$row['profile_photo'].'" style="height:45px;width:45px"></div>';
                    echo '<div><div style="position:relative;left:27px">'.$row['account'].'</div>';
                    echo '<div style="font-size:10px;position:relative;bottom:28px;left:30px">'.$row['a_Name'].'</div></div>';
                    echo '</div></a>';
                }
            }
            
            // $_GET['id'];
            
        ?>  
        
    </body>
</html>