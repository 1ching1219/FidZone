<?php
    $hash=$_GET["hash"];
    $hash='#'.$hash;
    $db=new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $up="UPDATE `video` SET `answer`=-1 WHERE `hash`='$hash'";
    $db->exec($up);

    $tmphold="SELECT to_id, from_id, time_start FROM `video` WHERE `hash`='$hash'";
    $tmphold=$db->prepare($tmphold);
    $tmphold->execute();
    $tmphold=$tmphold->fetch();

    $toto=$tmphold["to_id"];
    $fromm=$tmphold["from_id"];
    $timee=$tmphold["time_start"];
    $situ="Missed call";

    $not_answer="INSERT INTO `message` (`to_id`, `from_id`, `comment`, `date_time`) VALUES('$toto', '$fromm', '$situ', '$timee') ";
    $db->exec($not_answer);

    $not_answer="SELECT COUNT(*) FROM `message` WHERE `to_id`=$toto AND `from_id`=$fromm AND `date_time`='$timee'";
    $not_answer=$db->prepare($not_answer);
    $not_answer->execute();
    $not_answer=$not_answer->fetch();

    $sql="DELETE FROM `video` WHERE `hash`='$hash'";
    // $db->exec($sql);  
?>
<script>
    self.location=document.referrer;
</script>