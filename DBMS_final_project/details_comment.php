<?php
$db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $pId_comment=$_POST["pId_comment"];
    $account=$_POST["account"];
    $comments=$_POST["comments"];
    $comments=$db->quote($comments);
   
    $pId_comment=$db->quote($pId_comment);
    $pId_comment=str_replace("'", "", $pId_comment);

    $account=$db->quote($account);
    $account=str_replace("'", "", $account);
    $comments=str_replace("'", "", $comments);
    $comments="N'".$comments."'";

    print($account);
    print($comments);
    print($pId_comment);
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    // mysql_query('set names utf8');
    $sql="INSERT INTO comments(pId, comment, aId) VALUES ($pId_comment, $comments, $account)";
    // mysql_select_db("$sql",$con);
    $con->query($sql);
    // if($db->exec($sql))print('success!');

    // $path="location:mainpage.php?account=$account#$pId_comment";
    // header($path);


?>
<script>
   
    window.history.back();

</script>