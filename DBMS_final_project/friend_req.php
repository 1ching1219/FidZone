<?php
    $account=$_GET["user"];
    $invited_one=$_GET["page"];
    
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $tmp = "SELECT req_amount FROM `friends` WHERE aId=$invited_one";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $amount = $sth->fetch();

    $tmp2 = "SELECT SUM(req_amount) FROM friends WHERE aId=$account";
    $sth2 = $db->prepare($tmp2);
    $sth2->execute();
    $postNum = $sth2->fetch();


    $tmp3="INSERT INTO friend_news(to_id, from_id) VALUES ($invited_one, $account)";

    $tmp4 = "SELECT to_id, from_id FROM `friend_news` WHERE to_id=$invited_one AND from_id=$account";
    $sth4 = $db->prepare($tmp4);
    $sth4->execute();
    $check = $sth4->fetch();
    
    if(!$check){
        $db->exec($tmp3);
        $hold1 = $amount[0] + 1;   
        $sql = "UPDATE `friends` SET `req_amount`='$hold1' WHERE aId =$invited_one";
        $db->exec($sql);
        $var=1;
        

    }else{

        $hold1 = $amount[0] - 1;   
        $sql = "UPDATE `friends` SET `req_amount`='$hold1' WHERE aId =$invited_one";
        $db->exec($sql);

        $sql2="DELETE FROM friend_news WHERE to_id=$invited_one AND from_id=$account";
        $db->exec($sql2);
        $var=0;
    }
    $path='location:personal.php?page='.$invited_one.'&user='.$account.'&invite='.$var;
    header($path);

?>
