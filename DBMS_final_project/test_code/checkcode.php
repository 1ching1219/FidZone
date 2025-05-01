<?php
    $db = new PDO("mysql:dbname=dbms_final; host=localhost", "root", "");
    if(!isset($_SESSION)){
        session_start();
    }  //判斷session是否已啟動

    if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))){  //判斷此兩個變數是否為空
        
        if($_SESSION['check_word'] == $_POST['checkword']){
            $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
            $correct=1;
            $account=$_POST["account"];
            $sql="SELECT COUNT(aId), aId, a_password FROM account WHERE account='$account'";
            $sql=$db->prepare($sql);
            $sql->execute();
            $sql=$sql->fetch();
            $aId=$sql["aId"];
            if($sql[0]){
                $sql1="SELECT COUNT(aId), email FROM personal_info WHERE aId=$aId";
                $sql1=$db->prepare($sql1);
                $sql1->execute();
                $sql1=$sql1->fetch();
                print 'test';
                if($sql1[0]){
                    // send email1
                    $correct=1;
                    $receiver = $sql1['email'];
                    $subject = "fidZone: Forgot password";
                    $body = "Hi, there...This is your password: ".$sql['a_password'];
                    $sender = "From:fidzone.official@gmail.com";
                    if(mail($receiver, $subject, $body, $sender)){
                        echo "Email sent successfully to $receiver";
                    }else{
                        echo "Sorry, failed while sending mail!";
                    }

                }else{
                    // 該帳號沒有新增電子信箱-1
                    $correct=-1;
                }
            }else{
                // 該帳號不存在-2
                $correct=-2;
            }

        }else{
            // 驗證碼錯誤0
            $correct=0;
        }
        
    }
    // print $correct;
    $path='location:captcha_index.php?correct='.$correct;
    header($path);
?>