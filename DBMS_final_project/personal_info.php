<?php
    $aId=$_POST["aId"];
    $account=$_POST["account"];
    $a_Name=$_POST["a_Name"];
    $email=$_POST["email"];
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $aId=$db->quote($aId);
    $account=$db->quote($account);
    $a_Name=$db->quote($a_Name);
    $email=$db->quote($email);

    $check="SELECT email FROM personal_info WHERE aId=$aId";
    $check=$db->prepare($check);
    $check->execute();
    $check=$check->fetch();
    
    $a_Name = str_replace("'", "", $a_Name);
    $a_Name="N'".$a_Name."'";
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    $up="UPDATE account SET a_Name=$a_Name,account=$account WHERE aId=$aId";
    $con->query($up);

    $aId=str_replace("'", "", $aId);

    if(isset($check[0])){
        $up="UPDATE personal_info SET email=$email WHERE aId=$aId";
        $db->exec($up);
    }else{
        $add="INSERT INTO personal_info(aId, email) VALUES ($aId, $email)";
        $db->exec($add);
    }
    $path="location:personal.php?page=".$aId."&user=".$aId."&invite=0";
    header($path);
?>