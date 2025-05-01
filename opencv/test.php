<?php 
    $py = exec('python project1.py');
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $py = $py.'.png';
    $py=str_replace("'", "", $py);

    $sql="SELECT aId FROM `account` WHERE faceId='$py'";
    $sql=$db->prepare($sql);
    $sql->execute();
    $sql=$sql->fetch();

    if(isset($sql[0])){
        $path="location:../DBMS_final_project/mainpage.php?account=".$sql[0];
    }else{
        $path="location:../DBMS_final_project/login.php";
    }

    
    header($path);
    
?>