<?php
    $details=$_POST["details"];
    $pid=$_POST["pid"];
    $account=$_POST["account"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $pid=$db->quote($pid);
    $account=$db->quote($account);
    $details=$db->quote($details);
    $pid=str_replace("'","", $pid);
    $account=str_replace("'", "", $account);
    $details=str_replace("'", "", $details);

    $tmp="SELECT aId FROM posts WHERE pId=$pid";
    $sth = $db->prepare($tmp);
    $sth->execute();
    $page = $sth->fetch();

    
    $sql="INSERT INTO likes(pId, aId) VALUES ($pid, $account)";
    $db->exec($sql);

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