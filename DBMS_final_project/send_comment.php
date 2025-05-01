<?php
    $from_id=$_POST["from_id"];
    $to_id=$_POST["to_id"];
    $comment=$_POST["comment"];
    
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    $from_id=$db->quote($from_id);
    $to_id=$db->quote($to_id);
    $comment=$db->quote($comment);
    $to_id=str_replace("'", "", $to_id);
    $from_id=str_replace("'", "", $from_id);

    $sql="INSERT INTO messag_news(to_id, from_id) VALUES ($to_id, $from_id)";
    $db->exec($sql);

    $comment = str_replace("'", "", $comment);
    $comment = "N'".$comment."'";
    $sql2="INSERT INTO `message`(to_id, from_id, comment) VALUES ($to_id, $from_id, $comment)";
    $con->query($sql2);


    // print $sql;
    // if($db->exec($sql) and $db->exec($sql2))print'success';

    $path='location:send.php?to='.$to_id.'&from='.$from_id.'#here';
    header($path);

?>