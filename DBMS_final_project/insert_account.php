<?php
    $a_Name=$_POST["a_Name"];
    $account=$_POST["account"];
    $a_password=$_POST["a_password"];
    $a_Type=$_POST["a_Type"];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $con=mysqli_connect("localhost", "root", "", "DBMS_final");
    mysqli_query($con, "SET NAMES utf8 COLLATE utf8_unicode_ci");

    $a_Name=$db->quote($a_Name);
    $account=$db->quote($account);
    $a_password=$db->quote($a_password);
    $a_Type=$db->quote($a_Type);

    $a_Name=str_replace("'", "", $a_Name);
    $a_Name="N'".$a_Name."'";

    foreach($_FILES['profile_photo']['name'] as $key=>$val){
        $rand=rand('11111111', '99999999');
        $file=$rand.'_'.$val;
        move_uploaded_file($_FILES['profile_photo']['tmp_name'][$key], 'profile_img/'.$file);
    }
    
    $tmp="SELECT a_Name FROM account WHERE a_Name=$a_Name";
    $tmp=mysqli_query($con, $tmp);
    $check_aName=mysqli_fetch_array($tmp);
    // $sth = $db->prepare($tmp);
    // $sth->execute();
    // $check_aName = $sth->fetch();

    $tmp2="SELECT account FROM account WHERE account=$account";
    $sth2 = $db->prepare($tmp2);
    $sth2->execute();
    $check_account = $sth2->fetch();

    if($check_account[0]){
        echo "<script>alert('此帳號已存在！');
        window.location.href='create_account.php'</script>";
    }
    else if($check_aName[0]){
        echo "<script>alert('此暱稱已存在！');
        window.location.href='create_account.php'</script>";
    }
    
    $sql1 = "SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'DBMS_final' AND TABLE_NAME = 'account'";
    $sth1 = $db->prepare($sql1);
    $sth1->execute();
    $row = $sth1->fetch();
    $sql1="INSERT INTO friends(aId) VALUES ($row[0])";
    $db->exec($sql1);

    $file = "N'".$file."'";
    $sql="INSERT INTO account(a_Name, account, a_password, a_Type, profile_photo) VALUES ($a_Name, $account, $a_password, $a_Type, $file)";
    $con->query($sql);
    
    header('location:login.php');
    

?>