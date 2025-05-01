<?php
    $pid=$_POST["pId"];
    $p_description=$_POST["p_description"];
    $account=$_POST["account"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $pid=$db->quote($pid);
    $p_description=$db->quote($p_description);
    $account=$db->quote($account);
    $p_description=str_replace("'", "", $p_description);
    $p_description="N'".$p_description."'";

    $pid=str_replace("'", "", $pid);
    $account=str_replace("'", "", $account);

    $tmp = "SELECT aId FROM posts WHERE pId=$pid";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $page = $sth->fetch();

    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    $sql="UPDATE posts SET p_description=$p_description WHERE pId=$pid";
    $con->query($sql);

    $path='location:details.php?pId='.$pid.'&user='.$page[0].'&page='.$page[0].'#'.$pid;
    header($path);
    
?>