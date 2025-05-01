<?php
$to_id=$_POST["to"];
$from_id=$_POST["from"];
$hash=$_POST["hash"];
$db= new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

$to_id=$db->quote($to_id);
$from_id=$db->quote($from_id);
$hash=$db->quote($hash);
$to_id=str_replace("'", "", $to_id);
$from_id=str_replace("'", "", $from_id);
$hash=str_replace("'", "", $hash);


$check_exit="SELECT COUNT(*) FROM video WHERE `hash`= '$hash'";
$check_exit=$db->prepare($check_exit);
$check_exit->execute();
$check_exit=$check_exit->fetch();

if($check_exit[0]>0){
    $sql="UPDATE `video` SET `answer`=1 WHERE `hash`='$hash'";
    $db->exec($sql);
}else{

    $sql="INSERT INTO `video` (`hash`, `from_id`, `to_id`, `time_start`, `time_end`, `answer`) VALUES ('$hash', '$from_id', '$to_id', current_timestamp(), current_timestamp(), '0')"; 
    $db->exec($sql);
}

$path="location:index.php?to=".$to_id."&from=".$from_id."&already=1".$hash;
header($path);

?>