<?php
$from_id=$_POST["from_id"];
$to_id=$_POST["to_id"];
$db=new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
$con=mysqli_connect("localhost", "root", "", "DBMS_final");
$con=mysqli_connect("localhost", "root", "", "DBMS_final");
$from_id=$db->quote($from_id);
$to_id=$db->quote($to_id);
$from_id=str_replace("'", "", $from_id);
$to_id=str_replace("'", "", $to_id);

print $to_id;


foreach($_FILES['message_photo']['name'] as $key=>$val){
    $rand=rand('11111111', '99999999');
    $file=$rand.'_'.$val;
    move_uploaded_file($_FILES['message_photo']['tmp_name'][$key], 'message_img/'.$file);
}

$comment="message_img/".$file;
print $comment;

$comment = "N'".$comment."'";

$sql="INSERT INTO messag_news(to_id, from_id) VALUES ($to_id, $from_id)";
$db->exec($sql);

$sql2="INSERT INTO `message`(to_id, from_id, comment) VALUES ($to_id, $from_id, $comment)";
$con->query($sql2);

$path='location:send.php?to='.$to_id.'&from='.$from_id.'#here';
header($path);

?>