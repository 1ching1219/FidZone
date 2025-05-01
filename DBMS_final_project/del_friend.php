<?php
    $aid=$_GET["aid"];
    $aid2=$_GET["aid2"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $tmpa = "SELECT COUNT(*) FROM friend_lists WHERE aId=$aid AND aId2=$aid2";
    $stha = $db->prepare($tmpa);
    $stha->execute();
    $is_friend_a = $stha->fetch();

    $tmpb = "SELECT COUNT(*) FROM friend_lists WHERE aId=$aid2 AND aId2=$aid";
    $sthb = $db->prepare($tmpb);
    $sthb->execute();
    $is_friend_b = $sthb->fetch();

    if($is_friend_a[0]){

        $sql = "DELETE FROM friend_lists WHERE aId = $aid AND aId2=$aid2";
        $db->exec($sql);      
    }else{
        $sql1 = "DELETE FROM friend_lists WHERE aId = $aid2 AND aId2=$aid";
        $db->exec($sql1);   
    }
    $tmp2 = "SELECT f_amount FROM `account` WHERE aId=$aid2";
    $sth2 = $db->prepare($tmp2);
    $sth2->execute();
    $f_amount = $sth2->fetch();

    $hold = $f_amount[0] - 1;   
    $sql2 = "UPDATE `account` SET `f_amount`='$hold' WHERE aId =$aid2";
    $db->exec($sql2);

    $tmp3 = "SELECT f_amount FROM `account` WHERE aId=$aid";
    $sth3 = $db->prepare($tmp3);
    $sth3->execute();
    $f_amount1 = $sth3->fetch();

    $hold1 = $f_amount1[0] - 1;   
    $sql3 = "UPDATE `account` SET `f_amount`='$hold1' WHERE aId =$aid";
    $db->exec($sql3);

    header("location:personal.php?page=".$aid2.'&user='.$aid.'&invite=0');

?>