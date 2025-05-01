<?php
    $aid=$_POST["from_id"];
    $aid2=$_POST["to_id"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $aid=$db->quote($aid);
    $aid2=$db->quote($aid2);
    
    $aid=str_replace("'", "", $aid);
    $aid2=str_replace("'", "", $aid2);

    $sql="INSERT INTO friend_lists(aId, aId2) VALUES ($aid, $aid2)";
    $db->exec($sql);

    $tmp = "SELECT req_amount FROM `friends` WHERE aId=$aid2";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $amount = $sth->fetch();

    $hold = $amount[0] - 1;   
    $sql = "UPDATE `friends` SET `req_amount`='$hold' WHERE aId =$aid2";
    $db->exec($sql);

    $sql2="DELETE FROM friend_news WHERE to_id=$aid2 AND from_id=$aid";
    $db->exec($sql2);

    $tmp1 = "SELECT f_amount FROM `account` WHERE aId=$aid2";
    $sth1 = $db->prepare($tmp1);
    $sth1->execute();
    $f_amount = $sth1->fetch();

    $hold1 = $f_amount[0] + 1;   
    $sql4 = "UPDATE `account` SET `f_amount`='$hold1' WHERE aId =$aid2";
    $db->exec($sql4);

    $tmp5 = "SELECT f_amount FROM `account` WHERE aId=$aid";
    $sth5 = $db->prepare($tmp5);
    $sth5->execute();
    $f_amount1 = $sth5->fetch();

    $hold2 = $f_amount1[0] + 1;   
    $sql5 = "UPDATE `account` SET `f_amount`='$hold2' WHERE aId =$aid";
    $db->exec($sql5);
   
    $path='location:mainpage.php?account='.$aid2;
    header($path);

?>