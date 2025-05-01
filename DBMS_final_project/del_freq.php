<?php
    $aid=$_POST["aid"];
    $aid2=$_POST["aid2"];
    $page=$_POST["page"];
    $account=$_POST["account"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $aid=$db->quote($aid);
    $aid2=$db->quote($aid2);
    $page=$db->quote($page);
    $account=$db->quote($account);
    
    $aid=str_replace("'", "", $aid);
    $aid2=str_replace("'", "", $aid2);
    $page=str_replace("'", "", $page);
    $account=str_replace("'", "", $account);

    $tmp = "SELECT f_amount FROM account WHERE aId=$aid";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $aid_f_amount = $sth->fetch();
    $aid_f_amount=$aid_f_amount[0]-1;

    $tmp2 = "SELECT f_amount FROM account WHERE aId=$aid2";
    $sth2 = $db->prepare($tmp2);
    $sth2->execute();
    $aid_f_amount2 = $sth2->fetch();
    $aid_f_amount2=$aid_f_amount2[0]-1;


    $sql = "UPDATE `account` SET `f_amount`='$aid_f_amount' WHERE aId =$aid";
    $db->exec($sql);
    $sql2 = "UPDATE `account` SET `f_amount`='$aid_f_amount2' WHERE aId =$aid2";
    $db->exec($sql2);

    $sql3 = "DELETE FROM friend_lists WHERE aId=$aid AND aId2=$aid2";
    $db->exec($sql3);

    $path='location:show_f_list.php?page='.$page.'&user='.$account.'&invite=0';
    header($path);

?>