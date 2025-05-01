<?php
    $aid = $_POST['account'];
    $img = $_POST['image'];
    $folderPath = "../../opencv/ImagesAttendance/";
  
    $image_parts = explode(";base64,", $img);
    $image_type_aux = explode("image/", $image_parts[0]);
    $image_type = $image_type_aux[1];
  
    $image_base64 = base64_decode($image_parts[1]);
    $fileName = uniqid() . '.png';
  
    $file = $folderPath . $fileName;
    file_put_contents($file, $image_base64);

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $aid=$db->quote($aid);
    $sql="UPDATE account SET faceId='$fileName' WHERE aId=$aid";
    $db->exec($sql);

    $aid=str_replace("'", "", $aid);
    $path="location:../edit_person_info.php?account=".$aid;
    header($path);
?>