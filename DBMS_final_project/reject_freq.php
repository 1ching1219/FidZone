<?php
    $from_id=$_POST["from_id"];
    $to_id=$_POST["to_id"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $from_id=$db->quote($from_id);
    $to_id=$db->quote($to_id);
    $from_id=str_replace("'", "", $from_id);
    $to_id=str_replace("'", "", $to_id);;
    
    $sql = "DELETE FROM friend_news WHERE to_id = $to_id AND from_id=$from_id";
    $db->exec($sql);

    $tmp = "SELECT req_amount FROM `friends` WHERE aId=$to_id";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $amount = $sth->fetch();

    $hold = $amount[0] - 1;
    $sql = "UPDATE `friends` SET `req_amount`='$hold' WHERE aId =$to_id";
    $db->exec($sql);

    $path='location:mainpage.php?account='.$to_id;
    header($path);

?>