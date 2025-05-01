<?php
    $account=$_GET["user"];
    $pid=$_GET["pid"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $tmp = "DELETE FROM posts WHERE pId = $pid";
    $db->exec($tmp);

    $tmp1="DELETE FROM comments WHERE pId=$pid";
    $db->exec($tmp1);

    $tmp3 = "SELECT SUM(postNum) FROM account WHERE aId=$account";
    $sth3 = $db->prepare($tmp3);
    $sth3->execute();
    $postNum = $sth3->fetch();
    $hold = $postNum[0]-1;
    $sql = "UPDATE `account` SET `postNum`='$hold' WHERE aId =$account";
    $db->exec($sql);



    $path='location:details.php?user='.$account.'&page='.$account;
    header($path);


?>