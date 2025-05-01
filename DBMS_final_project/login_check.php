<?php
    $account=$_POST['account'];
    $a_password=$_POST['a_password'];

    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    $account=$db->quote($account);
    
    $a_password=$db->quote($a_password);

    
    $tmp1="SELECT account FROM account WHERE account=$account";
    $tmp2="SELECT a_password FROM account WHERE account=$account";
    $tmp3="SELECT aId FROM account WHERE account=$account";

    $sth1 = $db->prepare($tmp1);
    $sth1->execute();
    $row1 = $sth1->fetch();
    $sth2 = $db->prepare($tmp2);
    $sth2->execute();
    $row2 = $sth2->fetch();
    $account=str_replace("'", "", $account);
    $a_password=str_replace("'", "", $a_password);
    
    if($account != $row1[0]){
        echo "<script>alert('此帳號不存在！');
        window.location.href='login.php'</script>";
    }else{
        
        if($a_password != $row2[0]){
            echo "<script>alert('密碼錯誤！');
            window.location.href='login.php'</script>";
        }else{
            
            $sth3 = $db->prepare($tmp3);
            $sth3->execute();
            $row3 = $sth3->fetch();
            
            $path="location:mainpage.php?account=".$row3[0];
            header($path);
        }
    }


?>