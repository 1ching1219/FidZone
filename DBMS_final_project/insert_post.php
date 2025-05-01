<?php

    $account=$_GET["account"];
    $p_description=$_POST["p_description"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $p_description=$db->quote($p_description);

    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    $p_description=str_replace("'", "", $p_description);
    $p_description="N'".$p_description."'";
    $sql="INSERT INTO posts(p_description, aId) VALUES ($p_description, $account)";
    $con->query($sql);

    $sql2 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'dbms_final' AND TABLE_NAME = 'posts'";
    $sth = $db->prepare($sql2);
    $sth->execute();
    $row = $sth->fetch();

    $tmp4 = "SELECT postNum FROM account WHERE aId=$account";
    $sth4 = $db->prepare($tmp4);
    $sth4->execute();
    $postNum = $sth4->fetch();
    $hold = $postNum[0]+1;
    $sql3 = "UPDATE `account` SET `postNum`='$hold' WHERE aId =$account";
    $db->exec($sql3);

    
    $extension = array('png', 'jpg','PNG', 'JPG');
    $con = mysqli_connect("localhost", "root", "", "dbms_final");
    foreach($_FILES['photo']['tmp_name'] as $key=>$value){
        $filename=$_FILES['photo']['name'][$key];
        $filename_tmp=$_FILES['photo']['tmp_name'][$key];
        $ext=pathinfo($filename, PATHINFO_EXTENSION);
        $finalimg='';
        if(in_array($ext, $extension)){
            if(!file_exists('post_img/'.$filename)){
                move_uploaded_file($filename_tmp, 'post_img/'.$filename);
                $finalimg=$filename;
            }else{
                $filename=str_replace('.', '-', basename($filename, $ext));
                $newfilename=$filename.time().".".$ext;
                move_uploaded_file($filename_tmp, 'post_img/'.$newfilename);
                $finalimg=$newfilename;
            }
            $finalimg = "N'".$finalimg."'";
            $sql1="INSERT INTO photos(pId, photo) VALUES ($row[0]-1, $finalimg)";
            mysqli_query($con, $sql1);

        }
    }

    $path='location:mainpage.php?account='.$account;
    header($path);

?>