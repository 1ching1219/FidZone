<?php
    $pid=$_POST["pid"];
    $details=$_POST["details"];
    $account=$_POST["account"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $pid=$db->quote($pid);
    $details=$db->quote($details);
    $account=$db->quote($account);
    $pid=str_replace("'","", $pid);
    $account=str_replace("'", "", $account);
    $details=str_replace("'", "", $details);
    
    $sql = "DELETE FROM likes WHERE aId=$account AND pId=$pid";
    $db->exec($sql);

    $tmp="SELECT aId FROM posts WHERE pId=$pid";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $page = $sth->fetch();

    if($details == 0){
        $path="location:mainpage.php?account=$account#$pid";
    }else{
        $path="location:details.php?user=$account&page=$page[0]#$pid";
    }
    print $details;
    // header($path);
?>
<script>
   
   window.history.back();

</script>