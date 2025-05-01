<?php
    $to_id=$_GET["to"];
    $from_id=$_GET["from"];
    $db=new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");

    $first="SELECT MAX(time_start) FROM `video` WHERE (to_id=$to_id AND from_id=$from_id) OR (to_id=$from_id AND from_id=$to_id)";
    $first=$db->prepare($first);
    $first->execute();
    $first=$first->fetch();
    $first=$first[0];

    $newt="UPDATE `video` SET `time_end`=current_timestamp() WHERE (`to_id`=$to_id AND `from_id`=$from_id AND `time_start`='$first') OR (`to_id`='$from_id' AND from_id=$to_id AND `time_start`='$first')";
    $db->exec($newt);

    $lasting="SELECT COUNT(*) AS exist, time_end, time_start, to_id, from_id FROM `video` WHERE (to_id=$to_id AND from_id=$from_id AND `time_start`='$first') OR (to_id=$from_id AND from_id=$to_id AND `time_start`='$first')";
    $lasting=$db->prepare($lasting);
    $lasting->execute();
    $lasting=$lasting->fetch();

    if($lasting["exist"] != 0){
        $time_take=(strtotime($lasting['time_end']) - strtotime($lasting['time_start']));
        $time_take='viedo call<br>'.$time_take;
        $toto=$lasting['to_id'];
        $fromm=$lasting['from_id'];
        $timee=$lasting['time_start'];


        $checkthere="SELECT COUNT(*) FROM `message` WHERE `to_id`=$toto AND `from_id`=$fromm AND `date_time`='$timee'";
        $checkthere=$db->prepare($checkthere);
        $checkthere->execute();
        $checkthere=$checkthere->fetch();

        
        if($checkthere[0]== 0){
            $add_call_into_m="INSERT INTO `message` (`to_id`, `from_id`, `comment`, `date_time`) VALUES('$toto', '$fromm', '$time_take', '$timee') ";
            $db->exec($add_call_into_m);
        }
    }

    

    $path="location:send.php?to=".$to_id."&from=".$from_id."#here";
    header($path);

?>